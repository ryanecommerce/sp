@extends('layouts.app')

@section('content')
    @php $viewName = 'newshub.show'; @endphp

    <div class="page-header">
        <h4>{{ $newshub->title }}</h4>
    </div>

    <article>
        <p>{!! $newshub->link !!}</p>
    </article>

    <div class="text-center action__article">
        @can('update', $newshub)
            <a href="{{ route('newshub.edit', $newshub->id) }}" class="btn btn-info">
                <i class="fa fa-pencil"></i> {{ trans('forum.posts.edit') }}
            </a>
        @endcan

        @can('delete', $newshub)
            <a href="#" class="btn btn-danger button__delete">
                <i class="fa fa-trash-o"></i> {{ trans('forum.posts.destroy') }}
            </a>
        @endcan

        <a href="/newshub" class="btn btn-dark">
            <i class="fa fa-list"></i> {{ trans('forum.posts.index') }}
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
                var newsId = '{{ $newshub->id }}';

                if (confirm('{{ trans('forum.posts.deleting') }}')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/newshub/' + newsId
                    }).then(function () {
                        window.location.href = '/';
                    });
                }
            });

        });
    </script>
@stop