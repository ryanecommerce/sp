@forelse($posts as $post)

    @php $viewName = 'index'; @endphp

    <div class="col-md-4">
        <div class="card mb-4 box-shadow">
            <div class="card-header">

                @if ($viewName === 'posts.show' || $viewName === 'index' )
                    @include('tags.partial.list', ['tags' => $post->tags])
                @endif

                <p class="card-text"><a href="{{ route('posts.show', $post->id) }}">{{ str_limit($post->title, 35) }}</a></p>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='{{ route('posts.show', $post->id) }}'">
                            {{ trans('forum.posts.view') }}
                        </button>

                        @php $attachments = $post->attachments; @endphp

                        @foreach ($attachments as $attachment)
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='{{ $attachment->url}}'">
                            {{ trans('forum.posts.download') }}
                        </button>
                        @endforeach
                    </div>
                    <small class="text-muted">{{ $post->user->name }}</small>
                    <!-- <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small> -->
                </div>
            </div>
        </div>
    </div>

    @if ($viewName === 'posts.show')
        @include('attachments.partial.list', ['attachments' => $post->attachments])
    @endif


@empty

@endforelse