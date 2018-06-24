<div class="media">
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h4>

    <p class="text-muted">
        <i class="fa fa-user"></i> {{ $post->user->name }}
        <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}
    </p>

    @if ($viewName === 'posts.show' || $viewName === 'index' )
        @include('tags.partial.list', ['tags' => $post->tags])
    @endif

    @if ($viewName === 'posts.show')dd
        @include('attachments.partial.list', ['attachments' => $post->attachments])
    @endif
    </div>
</div>