@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>용어사전 글쓰기</h1>
        <hr />

        <form action="{{ route('glossary.store') }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}

            @include('glossary.partial.form')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    저장하기
                </button>
            </div>

        </form>
    </div>

@stop