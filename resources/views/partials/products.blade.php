<div class="text-center">
    <h1>Продукты</h1>
</div>

<div class="container row row-cols-1 row-cols-md-4 m-auto" >
    @foreach($productGroups as $k => $product)
        <div class="col mb-3 mt-1">
            @include('partials.productGroupCard')
        </div>
    @endforeach
</div>
