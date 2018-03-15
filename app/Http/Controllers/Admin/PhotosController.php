<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
      $this->validate(request(), [
        'photo' => 'required|image|max:2048'

      ]);

      // $photo = request()->file('photo')->store('posts', 'public');
      // $photoUrl = $photo->store('public');
      //
      // return Storage::url($photoUrl);

      Photo::create([
        'url' => Storage::url(request()->file('photo')->store('posts', 'public')),
        'post_id' => $post->id
      ]);

    }

    public function destroy(Photo $photo)
    {
      $photo->delete();

      return back()->with('flash', 'Фото удалено');
    }

}
