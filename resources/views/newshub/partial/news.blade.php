@forelse($newshub as $news)

    @php $viewName = 'index'; @endphp

    <div class="col-md-6">
        <div class="card mb-4 box-shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center newhub">
                    <p class="card-text"><a href="{{ url($news->link) }}" target="_blank">{{ str_limit($news->title, 100) }}</a></p>
                </div>
                <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>


@empty

@endforelse