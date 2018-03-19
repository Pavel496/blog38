<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
  public function index()
  {
    // if (auth()->user()->hasRole('Admin')) {
    //   $posts = Post::all();
    // } else {
    //   $posts = auth()->user()->posts;
    // }

    $posts = Post::allowed()->get();

    // $posts = Post::all();
    // $posts = Post::where('user_id', auth()->id())->get();

    return view('admin.posts.index', compact('posts'));
  }

  // public function create()
  // {
  //   $categories = Category::all();
  //   $tags = Tag::all();
  //
  //   return view('admin.posts.create', compact('categories', 'tags'));
  // }

  public function store(Request $request)
  {
    $this->authorize('create', new Post);

    $this->validate($request, [
      'title' => 'required|min:3'
    ]);

    // $post = Post::create( $request->only('title') );
    $post = Post::create( $request->all() );
    // $post = Post::create([
    //     'title' => $request->get('title'),
    //     'user_id' => auth()->id()
    //   ]);



    return redirect()->route('admin.posts.edit', $post);

  }

  public function edit(Post $post)
  {
    // auth()->id() === $post->user_id;
    $this->authorize('update', $post);

    // $categories = Category::all();
    // $tags = Tag::all();

    return view('admin.posts.edit', [
          'post' => $post,
          'tags' => Tag::all(),
          'categories' => Category::all()
        ]);

  }

  public function update(Post $post, StorePostRequest $request)
  {
    $this->authorize('update', $post);
    // $post->title = $request->get('title');
    // $post->body = $request->get('body');
    // $post->iframe = $request->get('iframe');
    // $post->excerpt = $request->get('excerpt');
    // $post->published_at = $request->get('published_at');
    // $post->category_id = $request->get('category_id');
    // $post->save();

    // $post->update($request->except('tags'));

    $post->update($request->all());

    $post->syncTags($request->get('tags'));

    // $tags = collect($request->get('tags'))->map(function($tag){
    //   return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
    // });

    // $tags = [];
    //
    // foreach ($request->get('tags') as $tag) {
    //   $tags[] = Tag::find($tag)
    //             ? $tag
    //             : Tag::create(['name' => $tag])->id;
    // }

    // $post->tags()->sync($tags);

    return redirect()->route('admin.posts.edit', $post)->with('flash', 'Публикация сохранена');


  }

  public function destroy(Post $post)
  {
    // $post->tags()->detach();
    // $post->photos->each->delete();
    $this->authorize('delete', $post);

    $post->delete();

    return redirect()
      ->route('admin.posts.index', $post)
      ->with('flash', 'Публикация удалена');

  }


}
