<article>
    <div class="card-product__horizontal row">
        <div class="col-md-2">
            <img src="{{ $product['photo'] }}" style="height: 150px;" alt="{{ $product['name'] }}">
        </div>
        <div class="col-md-8">
            <h4 class="text-primary">{{ $product['name'] }}</h4>
            <p>{{ $product['mini_description'] }}</p>
            <div>
                @if($product['nds'])
                    <div>
                        <span class="card-product__label card-product__label-body">НДС:</span> {{ $product['nds'] }}
                    </div>
                @endif
                @if($product['delivery_type_id'])
                    <div>
                        <span class="card-product__label card-product__label-body">Тип поставки:</span> {{ \App\Models\Product::$deliveryTypes[$product['delivery_type_id']] }}
                    </div>
                @endif
                @if($product['language_id'])
                    <div>
                        <span class="card-product__label card-product__label-body">Язык (версия):</span> <?php
                        echo implode(', ', array_map(function ($v) {
                            return  \App\Models\Product::$languages[$v];
                        }, explode(',', $product['language_id'])));
                        ?>
                    </div>
                @endif
                @if($product['os'])
                    <div>
                        <span class="card-product__label card-product__label-body">Платформа:</span>
                        <?php
                        echo implode(', ', array_map(function ($v) {
                            return  \App\Models\Product::$platforms[$v];
                        }, explode(',', $product['os'])));
                        ?>
                    </div>
                @endif

                @if($product['delivery_days'])
                    <div>
                        <span class="card-product__label card-product__label-body">Срок поставки лицензионной программы или ключа активации:</span> {{ $product['delivery_days'] }}
                    </div>
                @endif

                @if($product['notes'])
                    <div>
                        <span class="card-product__label card-product__label-body">Примечания:</span> {{ $product['notes'] }}
                    </div>
                @endif

            </div>
        </div>

        <div class="col-md-2">
            <div class="text-right" style="font-weight: normal">
                @if ($product['article'])
                    <div class="card-product__label">Артикул</div>
                    {{ $product['article'] }}
                @endif
            </div>

            <div class="text-right" style="font-weight: bold">
                @if ($product['old_price'])
                    <span class="card-product__old-price"> {{ $product['old_price'] }} руб.</span>
                @endif
                <div  class="card-product__price text-success">{{ $product['price'] }} <span style="font-size: 15px;">руб.</span></div>
            </div>
            <button type="button" onclick="addToCard({{ $product['id'] }})" class="btn btn-rounded btn-primary float-right">
                <img src="/img/icons/cart_white.svg" class="img16">
                В корзину
            </button>
        </div>
    </div>
</article>

<style>
    .card-product__horizontal {
        background-color: white;
        border-radius: 3px;
    }
    .card-product__label {
        color: rgb(113, 113, 113);
        font-size: 13px;
    }

    .card-product__price {
        font-size: 24px;
        margin: 10px 0 10px 0;
    }

    .card-product__horizontal {
        cursor: pointer;
        padding: 15px 0;
        border-color: #e9f5ff;
        box-shadow: 0 15px 35px rgba(95,223,255,.05),0 5px 15px rgba(0,0,0,.03) !important;
    }
    .card-product__horizontal:hover {
        box-shadow: 0 15px 35px rgba(95,223,255,.1),0 5px 15px rgba(0,0,0,.07) !important;
    }
</style>
