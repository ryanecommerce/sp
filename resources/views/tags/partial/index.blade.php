<p class="lead"><i class="fa fa-tags"></i>태그</p>

<ul class="list-unstyled">
    @foreach($allTags as $tag)
        <li {!! str_contains(request()->path(), $tag->slug) ? 'class="active"' : '' !!}>
                {{ $tag->name }}
                @if ($count = $tag
                ->posts->count())
                    <span class="badge badge-default">{{ $count }}</span>
                @endif
            </a>
        </li>
    @endforeach
</ul>