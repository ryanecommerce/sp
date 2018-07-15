@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>뉴스허브 글쓰기</h1>
        <hr />

        <form action="{{ route('newshub.store') }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}

            @include('newshub.partial.form')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    저장하기
                </button>
            </div>

        </form>
    </div>

@stop