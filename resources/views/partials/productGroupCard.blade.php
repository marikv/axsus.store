<div class="card card-product card-product-group h-100">
    <a href="/product-group/{{ $product['id'] }}" class="card-product-groups__link">
    <img src="{{ $product['photo'] }}" class="card-img-top" alt="{{ $product['name'] }}">
    </a>
    <div class="card-body">
        <a href="/product-group/{{ $product['id'] }}" class="card-product-groups__link">{{ $product['name'] }}</a>
    </div>
</div>

<style>
    a.card-product-groups__link {
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        display: block;
    }

    .card-product-group {
        cursor: pointer;
        border-color: #e9f5ff;
        box-shadow: 0 15px 35px rgba(95,223,255,.05),0 5px 15px rgba(0,0,0,.03) !important;
    }
    .card-product-group:hover {
        box-shadow: 0 15px 35px rgba(95,223,255,.1),0 5px 15px rgba(0,0,0,.07) !important;
    }
</style>
