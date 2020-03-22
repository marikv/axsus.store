<div class="card card-product  h-100">
    <img src="{{ $product['photo'] }}" class="card-img-top" alt="{{ $product['name'] }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product['name'] }}</h5>
        <p class="card-text">{{ $product['mini_description'] }}</p>
    </div>
    <div class="card-footer flex-center justify-content-between">
        <div class="float-left" style="font-weight: bold">
            @if ($product['article'])
                Артикул {{ $product['article'] }}
            @endif<br>
            @if ($product['old_price'])
                    <span class="card-product__old-price"> {{ $product['old_price'] }} руб.</span>
            @endif
            {{ $product['price'] }} руб.
        </div>
        <button type="button" onclick="addToCard({{ $product['id'] }})" class="btn btn-rounded btn-primary float-right">
            <img src="/img/icons/cart_white.svg" class="img16">
            В корзину
        </button>
    </div>
</div>
