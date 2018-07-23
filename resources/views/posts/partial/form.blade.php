<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title">제목</label>
    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control" />
    {!!  $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label for="content">본문</label>
    <textarea name="content" id="content" rows="10" class="form-control">{{ old('content', $post->content) }}</textarea>
    {!!  $errors->first('content', '<span class="form-error">:message</span>') !!}
</div>


<div class="form-group" {{ $errors->has('files') ? 'has-error' : '' }}>
    <label for="files">파일</label>
    <input type="file" name="files[]" id="files" class="form-control" multiple="multiple" />
    {!! $errors->first('files.0', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">

    <label for="tags">태그</label>
    <select name="tags[]" id="tags" multiple="multiple" class="form-control" >
        @foreach($allTags as $tag)
            @if($tag->category === 'post')
            <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected="selected"' : '' }}>
                {{ $tag->name}}
            </option>
            @endif
        @endforeach
    </select>
    {!! $errors->first('tags', '<span class="form-error">:message</span>') !!}
</div>



@section('script')
    @parent
    <script src="/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $("#tags").select2({
                placeholder: '태그를 선택하세요 (최대 3개)',
                maximumSelectionLength: 3,
                tags: true
            });

        });
    </script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
@stop

