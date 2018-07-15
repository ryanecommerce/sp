@if ($attachments->count())
    <ul class="attachment__post">
        @foreach ($attachments as $attachment)
            <li><i class="fa fa-paperclip"></i>
                <a href="{{ $attachment->url }}">
                    다운로드({{ $attachment->bytes }})
                </a>
            </li>
        @endforeach
    </ul>
@endif