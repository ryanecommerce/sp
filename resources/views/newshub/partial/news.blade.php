@forelse($newshub as $news)

    @php $viewName = 'index'; @endphp

    <div class="col-md-6">
        <div class="card mb-4 box-shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center newhub">
                    @php $attachments_news = $news->attachments_news; @endphp

                    @foreach ($attachments_news as $attachment)

                        <div class="card-text">
                            <div class="h_left">
                                <p><a href="{{ url($news->link) }}" target="_blank">{{ str_limit($news->title, 100) }}</a></p>
                                <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="h_right"><img src="images/{{ $attachment->filename }}" width="50px"/></div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>


@empty

@endforelse