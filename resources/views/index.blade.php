@extends('layouts.app')

@section('content')
@php $viewName = 'index'; @endphp

	<div class="page-header">
		<h4> {{ trans('forum.posts.index') }}</h4>
	</div>

	<div class="text-right">
		<a href="{{ route('posts.create') }}" class="btn btn-primary">
			<i class="fa fa-plus-circle"></i> {{ trans('forum.posts.create') }}
		</a>
	</div>


	<div class="row">
		<div class="col-md-3">
			<aside>
				@include('tags.partial.index')
			</aside>
		</div>
		<div class="col-md-9">
			<article>
				@forelse($posts as $post)
					@include('posts.partial.post', compact('post'))
				@empty
					<p class="text-center text-danger"> {{ trans('forum.posts.empty') }}</p>
				@endforelse
			</article>
		</div>
	</div>




	@if($posts->count())
		<div class="text-center">
			{!! $posts->appends(request()->except('page'))->render() !!}
		</div>
	@endif
@stop
