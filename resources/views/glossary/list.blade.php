@extends('layouts.app')

@section('content')

    @php $viewName = 'index'; @endphp

    <div class="page-header">
    </div>

    <div class="container">

        <div class="row">


            <div class="container">
                <div class="row" id="post-data">
                    @include('glossary.partial.glossary')
                </div>
            </div>
        </div>
    </div>

    {{ $glossarys->links() }}

@stop