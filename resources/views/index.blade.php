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
			<div class="row" id="post-data">
					@include('posts.partial.post')
			</div>
		</div>
	</div>
	</div>

	<div class="ajax-load text-center" style="display:none">
		<p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
	</div>

	<script type="text/javascript">

		var page = 1;

        $(window).scroll(function() {

            if($(window).scrollTop() + $(window).height() >= $(document).height()) {

                page++;

                loadMoreData(page);

            }
        });

		function loadMoreData(page){

		    $.ajax(
				{
					url: '?page=' + page,
					type: "get",
					//error:function(request, status, error){alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);},
					beforeSend: function()
					{
					    $('.ajax-load').show();
					}
				})

				.done(function(data)
				{
				    if(data.html == "") {
				        $('.ajax-load').html("No more records found");

				        return;
					}

					$('.ajax-load').hide();
				    $('#post-data').append(data.html);
				})

				.fail(function(jqXHR, ajaxOptions, thrownError)
				{
				    alert('server not responding...');
				});
		}
	</script>

@stop
