@extends('layout')

@section('content')

    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">{{ $page['name'] }}</h1>
            <div style="padding-bottom: 150px;">
                {!! $page['description'] !!}
            </div>
        </div>
    </div>

@endsection
