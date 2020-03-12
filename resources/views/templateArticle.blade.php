@extends('layout')

@section('content')

    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">{{ $article['name'] }}</h1>
            <div style="padding-bottom: 150px;">
                {!! $article['description'] !!}
            </div>
        </div>
    </div>

@endsection
