@extends('layout')

@section('content')

    <div style="background-color: rgba(193,193,193,0.2);padding: 30px;">

        @foreach($articles['data'] as $k => $article)
            <div class="container pb-5">
                <div class="card argon-shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4" style="">
                                <img src="{{ $article['photo'] }}" style="width: 100%;" />
                            </div>
                            <div class="col-md-8">
                                <h2><a href="/article/{{ $article['id'] }}">{{ $article['name'] }}</a></h2>
                                <div>
                                    {!! $article['mini_description'] !!}
                                </div>
                                <br>
                                <a href="/article/{{ $article['id'] }}" class="btn btn-rounded btn-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
