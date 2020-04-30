@extends('layout')

@section('content')

    @include('partials.carousel')
    <div>
        <h1 class=" text-center">{{$page1['name']}}</h1>
        <div class="container" >
            {!! $page1['description'] !!}
        </div>
        <div class="container text-center flex-center justify-content-around flex-wrap">
            @foreach($brands as $brand)
                <a href="/brand/{{ $brand['id'] }}" class="lp-brands__link">
                    <img src="{{ $brand['photo'] }}" class="rounded mx-auto d-block lp-brands__img" alt="{{ $brand['name'] }}">
                </a>
            @endforeach
        </div>
    </div>

    <div style="background-color: #E8F6F9">
        <h1 class=" text-center">{{$page2['name']}}</h1>
        <div class="container" >
            {!! $page2['description'] !!}
        </div>
    </div>

    @include('partials.products')
    @include('partials.articles')
    @include('partials.faq')
    @include('partials.contacts')
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aa4ae3eca4afb357bfbcf96608f2e8502260b3753aaae5978d6739cc598e9b209&amp;source=constructor" width="100%" height="579" frameborder="0"></iframe>

@endsection
