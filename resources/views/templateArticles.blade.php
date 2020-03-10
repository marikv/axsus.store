@extends('layout')

@section('content')

    @foreach($articles['data'] as $k => $article)

        <div class="container row m-auto position-relative">
            <div class="article-for-img__circle"></div>
                <div class="col-6 m-0 wrapper-article-mini" >
                    <h2>{{ $article['name'] }}</h2>
                    <p>
                        {!! $article['mini_description'] !!}
                    </p>
                    <a href="/article/{{ $article['id'] }}" class="btn btn-rounded btn-primary">Подробнее</a>
                </div>
                <div class="col-6 m-0 wrapper-article-for-img p-0">
                    <div class="article-for-img"
                         style="background-image: url('/uploads/{{ $article['photo'] }}')">

                    </div>
                </div>
        </div>
    @endforeach

@endsection
