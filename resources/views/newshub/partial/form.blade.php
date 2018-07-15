<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title">제목</label>
    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" class="form-control" />
    {!!  $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
    <label for="link">본문</label>
    <textarea name="link" id="link" rows="10" class="form-control">{{ old('link', $news->link) }}</textarea>
    {!!  $errors->first('link', '<span class="form-error">:message</span>') !!}
</div>



<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">

    <label for="tags">태그</label>
    <select name="tags[]" id="tags" multiple="multiple" class="form-control" >
        @foreach($allTags as $tag)
            <option value="{{ $tag->id }}" {{ $news->tags->contains($tag->id) ? 'selected="selected"' : '' }}>
                {{ $tag->name }}
            </option>
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
@stop

