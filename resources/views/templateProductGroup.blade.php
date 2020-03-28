@extends('layout')

@section('content')

    <div >

        <div class="container row m-auto">
            <div class="col-12 ">
                <h1 class="text-center">{{ $productGroup['name'] }}</h1>
                <div >
                    @if(strlen(trim($productGroup['description'])))
{{--                    <img src="{{$productGroup['photo']}}" class="img-fluid brand-image" />--}}
                    {!! $productGroup['description'] !!}
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div style="background-color: rgba(95,223,255,0.06)">

        <hr/>

        <div class="container row row-cols-1 m-auto" >
            @foreach($products['data'] as $k => $product)
                <div class="col mb-3 mt-1">
                    @include('partials.productCard')
                </div>
            @endforeach
        </div>
    </div>

@endsection
