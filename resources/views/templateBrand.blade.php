@extends('layout')

@section('content')

    <div class="mb-5 pb-5">

        <div class="container row m-auto">
            <div class="col-12 ">
                <h1 class="text-center">{{ $brand['name'] }}</h1>
                <div style="padding-bottom: 150px;">
                    <img src="/uploads/{{$brand['photo']}}" class="img-fluid" style="height: 250px; float: left;"/>
                    {!! $brand['description'] !!}
                </div>
            </div>
        </div>

        <hr/>

        <div class="container row row-cols-1 row-cols-md-3 m-auto">
            @foreach($products['data'] as $k => $product)
                <div class="col mb-4">
                    @include('partials.productCard')
                </div>
            @endforeach
        </div>


    </div>

@endsection
