@extends('layouts.app')

@section('content')
@php $viewName = 'index'; @endphp

	<div class="page-header">
	</div>

	<div class="container">

	<div class="row">

		<!-- <div class="col-md-3">
			<aside>
				@include('tags.partial.index')
			</aside>
		</div> -->

		<div class="container">
			<div class="row">
				@forelse($posts as $post)
					@include('posts.partial.post', compact('post'))
				@empty
					<p class="text-center text-danger"> {{ trans('forum.posts.empty') }}</p>
				@endforelse
			</div>
		</div>
	</div>
	</div>




	@if($posts->count())
		<div class="text-center">
			{!! $posts->appends(request()->except('page'))->render() !!}
		</div>
	@endif
@stop
