<div class="card card-product  h-100">
    <img src="/uploads/{{ $product['photo'] }}" class="card-img-top" alt="{{ $product['name'] }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product['name'] }}</h5>
        <p class="card-text">{{ $product['mini_description'] }}</p>
    </div>
    <div class="card-footer flex-center justify-content-between">
        <div class="float-left" style="font-weight: bold">
            {{ $product['price'] }} руб.
        </div>
        <button type="button" onclick="addToCard({{ $product['id'] }})" class="btn btn-primary float-right">
            <img src="/img/icons/cart_white.svg" class="img16">
            В корзину
        </button>
    </div>
</div>
