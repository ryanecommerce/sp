@extends('layouts.app')

@section('content')

	<div class="page-header">
		<h4> {{ trans('forum.posts.index') }}</h4>
	</div>

	<div class="text-right">
		<a href="{{ route('posts.create') }}" class="btn btn-primary">
			<i class="fa fa-plus-circle"></i> {{ trans('forum.posts.create') }}
		</a>
	</div>

	<article>
		@forelse($posts as $post)
			@include('posts.partial.post', compact('post'))
		@empty
			<p class="text-center text-danger"> {{ trans('forum.posts.empty') }}</p>
		@endforelse
	</article>


	@if($posts->count())
		<div class="text-center">
			{!! $posts->appends(request()->except('page'))->render() !!}
		</div>
	@endif
@stop
