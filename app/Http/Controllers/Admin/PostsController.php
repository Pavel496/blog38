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
    $posts = Post::all();
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
    $this->validate($request, ['title' => 'required']);

    $post = Post::create( $request->only('title') );

    return redirect()->route('admin.posts.edit', $post);

  }

  public function edit(Post $post)
  {
    //dd($post);
    $categories = Category::all();
    $tags = Tag::all();

    return view('admin.posts.edit', compact('categories', 'tags', 'post'));

  }

  public function update(Post $post, StorePostRequest $request)
  {
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
}
