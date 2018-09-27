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
                    @include('newshub.partial.news')
                </div>
            </div>
        </div>
    </div>


    <div class="lds-ring" style="margin:auto; display:none;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="ajax-load col-lg-12 col-centered text-center" style="display:block;">
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
                        $('.lds-ring').show();
                    }
                })

                .done(function(data)
                {
                    if(data.html == "") {

                        $('.lds-ring').remove();
                        $('.ajax-load').html("마지막 포스트입니다.").fadeIn('5000');

                        return;
                    }

                    $('#post-data').append(data.html).show('slow');;
                })

                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('server not responding...');
                });
        }
    </script>

@stop