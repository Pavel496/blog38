<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
        protected $fillable = [
            'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id'
        ];

        // protected $guarded = [];

        protected $dates = ['published_at'];

        protected static function boot()
        {
          parent::boot();

          static::deleting(function($post){
            // Storage::disk('public')->delete($photo->url);
            $post->tags()->detach();
            $post->photos->each->delete();
          });
        }

        public function getRouteKeyName()
        {

            return 'url';

        }

        public function category()
        {

            return $this->belongsTo(Category::class);

        }

        public function tags()
        {

            return $this->belongsToMany(Tag::class);

        }

        public function photos()
        {

            return $this->hasMany(Photo::class);

        }

        public function owner()
        {
          return $this->belongsTo(User::class, 'user_id');
        }

        public function scopePublished($query)
        {
          $query->whereNotNull('published_at')
                ->where('published_at', '<=', Carbon::now())
                ->latest('published_at');

        }

        public function scopeAllowed($query)
        {
          if (auth()->user()->can('view', $this))
          {
            // $posts = Post::all();
            return $query;
          }

          return $query->where('user_id', auth()->id());
        }

        public function isPublished()
        {
          return ! is_null($this->published_at) && $this->published_at < today();
        }

        public static function create(array $attributes = [])
        {
          $attributes['user_id'] = auth()->id();

          $post = static::query()->create($attributes);

          $post->generateUrl();

          // $url = str_slug($attributes['title']);
          //
          // if (static::where('url', $url)->exists())
          // {
          //   $url = "{$url}-{$post->id}";
          // }
          //
          // $post->url = $url;
          //
          // $post->save();

          return $post;
        }

        public function generateUrl()
        {
          $url = str_slug($this->title);

          // if ($this->where('url', $url)->exists())
          if ($this->whereUrl($url)->exists())
          {
            $url = "{$url}-{$this->id}";
          }

          $this->url = $url;

          $this->save();
        }

        // public function setTitleAttribute($title)
        // {
        //   $this->attributes['title'] = $title;
        //
        //   $originalUrl = $url = str_slug($title);
        //   $count = 1;
        //
        //   while( Post::where('url', $url)->exists() )
        //   {
        //     $url = "{$originalUrl}-" . ++$count;
        //   }
        //
        //   $this->attributes['url'] = $url;
        // }

        public function setPublishedAtAttribute($published_at)
        {
          $this->attributes['published_at'] = $published_at
                ? Carbon::parse($published_at)
                : null;
        }

        public function setCategoryIdAttribute($category)
        {
          $this->attributes['category_id'] =Category::find($category)
                              ? $category
                              : Category::create(['name' => $category])->id;
        }

        public function syncTags($tags)
        {
          $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
          });

          $this->tags()->sync($tagIds);

        }

        public function viewType($home = '')
        {
          if ($this->photos->count() === 1):
            return 'posts.photo';

          elseif ($this->photos->count() > 1):
            return $home === 'home' ? 'posts.carousel-preview' : 'posts.carousel';

          elseif ($this->iframe):
            return 'posts.iframe';
          else:
            return 'posts.text';
          endif;
        }

}
