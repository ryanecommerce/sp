@extends('layouts.app')

@section('content')

	<div class="page-header">
		<h4>포럼<small> 글 목록</small></h4>
	</div>

	<div class="text-right">
		<a href="{{ route('posts.create') }}" class="btn btn-primary">
			<i class="fa fa-plus-circle"></i> 새 글 쓰기
		</a>
	</div>

	<article>
		@forelse($posts as $post)
			@include('posts.partial.post', compact('post'))
		@empty
			<p class="text-center text-danger">글이 없습니다.</p>
		@endforelse
	</article>


	@if($posts->count())
		<div class="text-center">
			{!! $posts->appends(request()->except('page'))->render() !!}
		</div>
	@endif
@stop
