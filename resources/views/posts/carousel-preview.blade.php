<div class="gallery-photos masonry">

  @foreach ($post->photos->take(4) as $photo)
    <figure>
      @if ($loop->iteration === 4)
        <div class="overlay">{{ $post->photos->count() }} Fotos</div>
      @endif
      <img src="{{ url($photo->url) }}" class="img-responsive" alt="">
    </figure>
  @endforeach

</div>
