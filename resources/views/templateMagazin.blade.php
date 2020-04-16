@extends('layout')

@section('content')

    <div >

        <div class="container row m-auto">
            <div class="col-12 ">
                <h1 class="text-center">{{ $page['name'] }}</h1>
                <div >
                    @if(strlen(trim($page['description'])))
                        @if(strlen(trim($page['photo'])))
                            <img src="{{$page['photo']}}" class="img-fluid brand-image" />
                        @endif
                    {!! $page['description'] !!}
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="container text-center flex-center justify-content-around flex-wrap">
        @foreach($brands as $brand)
            <a href="/brand/{{ $brand['id'] }}" class="lp-brands__link">
                <img src="{{ $brand['photo'] }}" class="rounded mx-auto d-block lp-brands__img" alt="{{ $brand['name'] }}">
            </a>
        @endforeach
    </div>

    <div style="background-color: rgba(95,223,255,0.06)">

        <hr/>

            @foreach($brands as $k => $brand)
                <h1 class="text-center">{{ $brand['name'] }}</h1>

                <div class="container row row-cols-1 row-cols-md-4 m-auto" >
                    @foreach($productGroups as $k => $product)
                        @if($product['brand_id'] === $brand['id'])
                        <div class="col mb-3 mt-1">
                            @include('partials.productGroupCard')
                        </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
    </div>

@endsection
