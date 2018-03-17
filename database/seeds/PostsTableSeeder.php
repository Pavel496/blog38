<?php

use App\Post;

use App\Category;

use App\Tag;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        Post::truncate();
        Category::truncate();
        Tag::truncate();

        $post = new Category;
        $post->name = "Категория №1";
        $post->save();

        $post = new Category;
        $post->name = "Категория №2";
        $post->save();

        $post = new Post;
        $post->title = "Мой пост №1";
        $post->url = str_slug("Мой пост №1");
        $post->excerpt = "Краткое описание поста №1";
        $post->body = "<p>Полное описание поста №1</p>";
        $post->published_at = Carbon::now()->subDays(5);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'N1']));

        $post = new Post;
        $post->title = "Мой пост №2";
        $post->url = str_slug("Мой пост №2");
        $post->excerpt = "Краткое описание поста №2";
        $post->body = "<p>Полное описание поста №2</p>";
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'N2']));

        $post = new Post;
        $post->title = "Мой пост №3";
        $post->url = str_slug("Мой пост №3");
        $post->excerpt = "Краткое описание поста №3";
        $post->body = "<p>Полное описание поста №3</p>";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'N3']));

        $post = new Post;
        $post->title = "Мой пост №4";
        $post->url = str_slug("Мой пост №4");
        $post->excerpt = "Краткое описание поста №4";
        $post->body = "<p>Полное описание поста №4</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'N4']));

        $post = new Post;
        $post->title = "Мой пост №5";
        $post->url = str_slug("Мой пост №5");
        $post->excerpt = "Краткое описание поста №5";
        $post->body = "<p>Полное описание поста №5</p>";
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'N5']));


    }
}
