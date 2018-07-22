@if ($tags->count())
    @foreach ($tags as $tag)
        <h2><a href="{{ route('news.show', $newshub->id ) }}">{{ $tag->name }}</a></h2>
    @endforeach
@endif