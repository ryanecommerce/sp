@if ($tags->count())
    @foreach ($tags as $tag)
        <h2><a href="{{ route('posts.show', $post->id ) }}">{{ $tag->name }}</a></h2>
    @endforeach
@endif