@extends('layout')

@section('content')


    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">Результат поиска</h1>
        </div>

        @foreach($products2 as $k => $product)
            <div style="margin: 10px 0 20px 0;width: 100%;">
                @include('partials.productCard')
            </div>
        @endforeach

        @foreach($products as $k => $product)
            <div style="margin: 10px 0 20px 0;width: 100%;">
                @include('partials.productCard')
            </div>
        @endforeach

        @foreach($products3 as $k => $product)
            <div style="margin: 10px 0 20px 0;width: 100%;">
                @include('partials.productCard')
            </div>
        @endforeach

    </div>

@endsection
