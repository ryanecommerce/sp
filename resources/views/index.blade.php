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

			@forelse($newshub as $news)

				@php $viewName = 'index'; @endphp

				<div class="col-md-6">
					<div class="card mb-4 box-shadow">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center newhub">
								<p class="card-text"><a href="{{ url($news->link) }}" target="_blank">{{ str_limit($news->title, 100) }}</a></p>
							</div>
							<small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
						</div>
					</div>
				</div>


			@empty

			@endforelse

	</div>

		<div class="row justify-content-md-center index-button">
			<button type="button" class="btn btn-outline-primary" onclick="window.location='{{ url('newshub') }}'">더 보기</button>
		</div>


		<div class="row">

		@forelse($posts as $post)

				@php $viewName = 'index'; @endphp

				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<div class="card-header">

							@if ($viewName === 'posts.show' || $viewName === 'index' )
								@include('tags.partial.list', ['tags' => $post->tags])
							@endif

							<p class="card-text"><a href="{{ route('posts.show', $post->id) }}">{{ str_limit($post->title, 35) }}</a></p>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='{{ route('posts.show', $post->id) }}'">
										{{ trans('forum.posts.view') }}
									</button>

									@php $attachments = $post->attachments; @endphp

									@foreach ($attachments as $attachment)
										<button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='{{ $attachment->url}}'">
											{{ trans('forum.posts.download') }}
										</button>
									@endforeach
								</div>
								<small class="text-muted">{{ $post->user->name }}</small>
							<!-- <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small> -->
							</div>
						</div>
					</div>
				</div>

			@empty

			@endforelse


	</div>

		<div class="row justify-content-md-center index-button">
			<button type="button" class="btn btn-outline-primary" onclick="window.location='{{ url('posts') }}'">더 보기</button>
		</div>

	</div>


@stop
