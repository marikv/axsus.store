@extends('layout')

@section('content')

    <div >

        <div class="container row m-auto">
            <div class="col-12 ">
                <h1 class="text-center">{{ $brand['name'] }}</h1>
                <div >
                    <img src="{{$brand['photo']}}" class="img-fluid brand-image" />
                    {!! $brand['description'] !!}
                </div>
            </div>
        </div>

    </div>

    <div style="background-color: rgba(95,223,255,0.06)">

        <hr/>

        <div class="container row row-cols-1 row-cols-md-4 m-auto" >
            @foreach($productGroups['data'] as $k => $product)
                <div class="col mb-3 mt-1">
                    @include('partials.productGroupCard')
                </div>
            @endforeach
        </div>
    </div>

@endsection
