@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h4>포럼<small> / {{ $post->title }}</small></h4>
    </div>

    <article>
        @include('posts.partial.post', compact('post'))

        <p>{!! $post->content !!}</p>
    </article>

    <div class="text-center action__article">
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">
            <i class="fa fa-pencil"></i>글 수정
        </a>
        <button class="btn btn-danger button__delete">
            <i class="fa fa-trash-o"></i>글 삭제
        </button>
        <a href="{{ route('/') }}" class="btn btn-dark">
            <i class="fa fa-list"></i>목록
        </a>
    </div>
@stop

@section('script')
    <script>
        $.ajaxSetup({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.button__delete').on('click', function(e) {
            var postId = $('post').data('id');

            if (confirm('글을 삭제합니다.')) {
                $.ajax({
                    type:'DELETE',
                    url: '/posts/' + postId
                }).then(function() {
                    window.location.href = '/posts';
                });
            }
        });
    </script>
@stop;