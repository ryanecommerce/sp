@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h4>{{ $post->title }}</h4>
    </div>

    <article>
        @include('posts.partial.post', compact('post'))

        <p>{!! $post->content !!}</p>
    </article>

    <div class="text-center action__article">
        @can('update', $post)
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">
            <i class="fa fa-pencil"></i>{{ trans('forum.posts.edit') }}
        </a>
        @endcan

        @can('delete', $post)
        <a href="#" class="btn btn-danger button__delete">
            <i class="fa fa-trash-o"></i> {{ trans('forum.posts.destroy') }}
        </a>
        @endcan

        <a href="{{ route('/') }}" class="btn btn-dark">
            <i class="fa fa-list"></i>{{ trans('forum.posts.index') }}
        </a>
    </div>
@stop

@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.button__delete').on('click', function (e) {
            var postId = '{{ $post->id }}';

            if (confirm('{{ trans('forum.posts.deleting') }}')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/posts/' + postId
                }).then(function () {
                    window.location.href = '/';
                });
            }
        });

    });
</script>
@stop