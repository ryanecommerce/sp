@if ($tags->count())
    @foreach ($tags as $tag)
        <h2><a href="{{ route('tags.posts.index', $tag->slug) }}">{{ $tag->name }}</a></h2>
    @endforeach
@endif