@if ($tags->count())
 <ul class="tags__article">
    @foreach ($tags as $tag)
        <li><a href="{{ route('tags.posts.index', $tag->slug) }}">{{ $tag->name }}</a></li>
    @endforeach
 </ul>
@endif