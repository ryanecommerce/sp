<div class="form-group {{ $errors->has('name_kor') ? 'has-error' : '' }}">
    <label for="name_kor">한글</label>
    <input type="text" name="name_kor" id="name_kor" value="{{ old('name_kor', $glossary->name_kor) }}" class="form-control" />
    {!!  $errors->first('name_kor', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('name_eng') ? 'has-error' : '' }}">
    <label for="name_eng">영문</label>
    <input type="text" name="name_eng" id="name_eng" value="{{ old('name_eng', $glossary->name_eng) }}" class="form-control" />
    {!!  $errors->first('name_eng', '<span class="form-error">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="name_kor">설명</label>
    <input type="text" name="description" id="description" value="{{ old('description', $glossary->description) }}" class="form-control" />
    {!!  $errors->first('description', '<span class="form-error">:message</span>') !!}
</div>



