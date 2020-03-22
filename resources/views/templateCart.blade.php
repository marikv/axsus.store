@extends('layout')

@section('content')

    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">Моя корзина</h1>
        </div>

        <div class="container">
            <div class="row">
                <div id="tabCart1" class="tabCart col-sm-12 col-md-12">
                    <h3>Товары в заказе</h3>
                    @if(count($items))
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Кол-во</th>
                                <th class="text-center">Цена</th>
                                <th class="text-center">Сумма</th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $total = 0;
                            @endphp
                            @foreach($items as $k => $item)
                                <tr id="cartTr{{ $item['id'] }}">
                                    <td style="width: 50%;vertical-align: middle;">
                                        <a href="/product/{{ $item['product']['id'] }}">
                                            <img src="{{ $item['product']['photo'] }}"
                                                 style="height: 72px;margin-right: 25px;">
                                            {{ $item['product']['name'] }}
                                        </a>
                                    </td>
                                    <td style="width: 10%;vertical-align: middle;" class="text-right">
                                        <input type="number" class="form-control" style="width: 70px"
                                               value="{{ $item['count'] }}">
                                    </td>
                                    <td style="width: 10%;vertical-align: middle;" class="text-center">
                                        <strong>{{ $item['price'] }}</strong></td>
                                    <td style="width: 15%;vertical-align: middle;" class="text-right">
                                        <strong>{{ round(($item['price'] * $item['count']), 2) }}</strong> руб.
                                    </td>
                                    <td style="width: 5%;vertical-align: middle;" class="text-right">
                                        <i style="cursor: pointer;" onclick="cartDelete({{ $item['id'] }})"
                                           class="fa fa-remove text-danger"></i>
                                    </td>
                                </tr>
                                @php
                                    $total = $total + round(($item['price'] * $item['count']), 2);
                                @endphp
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>Итого:</td>
                                <td class="text-right"><span class="cart-total">{{ $total }}</span> руб.</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <a href="javascript:void(0)" onclick="history.back()" class="btn btn-lg btn-outline-success btn-rounded">
                                        Продолжить покупки
                                    </a>
                                </td>
                                <td colspan="2" class="text-right">
                                    <button type="button" onclick="showCartCheckoutTab(2)"
                                            class="btn btn-lg  btn-success oform  btn-rounded">
                                        Оформить <img src="{{asset('img/icons/play-solid.svg')}}" style="height: 14px">
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <div class="alert alert-danger">Ваша корзина пуста</div>
                    @endif
                </div>

                <div id="tabCart2" style="display: none" class="tabCart col-sm-12 col-md-12">
                    <h3>Покупатель</h3>
                    <form>
                        <div class="text-center btn-cart-type-of-order__wrapper">
                            <div class="btn-group" role="group" aria-label="заказ">
                                <button type="button" onclick="setCartOrderType(1)" id="btn-cart-type-of-order-1" class="btn btn-cart-type-of-order btn-primary btn-rounded">Быстрый заказ</button>
                                <button type="button" onclick="setCartOrderType(2)" id="btn-cart-type-of-order-2" class="btn btn-cart-type-of-order btn-outline-primary btn-rounded">Самостоятельный заказ</button>
                            </div>
                            <input type="hidden" name="orderType" id="orderType" value="1">
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="@if (Auth::check()) {{ Auth::user()->email  }} @endif" id="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Телефон</label>
                                <input type="text" class="form-control phone-mask"
                                       id="phone" name="phone" value="@if (Auth::check()){{ Auth::user()->phone  }}@endif" placeholder="">
                            </div>
                        </div>

                        <div class="form-row" id="cart-type-2" style="display: none;">
                            <div class="form-group col-md-6">
                                <label for="name">Название компании</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="@if (Auth::check()){{ Auth::user()->name  }}@endif"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">ИНН</label>
                                <input type="text" class="form-control" id="inn" name="inn"
                                       value="@if (Auth::check()){{ Auth::user()->inn  }}@endif"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">КПП</label>
                                <input type="text" class="form-control" id="kpp" name="kpp"
                                       value="@if (Auth::check()){{ Auth::user()->kpp  }}@endif"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Контактное лицо</label>
                                <input type="text" class="form-control" id="contactnoe_lico" name="contactnoe_lico"
                                       value="@if (Auth::check()){{ Auth::user()->contactnoe_lico  }}@endif"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Расчетный счет</label>
                                <input type="text" class="form-control" id="raschetnyi_schet" name="raschetnyi_schet"
                                       value="@if (Auth::check()){{ Auth::user()->raschetnyi_schet  }}@endif"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Город</label>
                                <input type="text" class="form-control" id="city" name="city"
                                       value="@if (Auth::check()){{ Auth::user()->city  }}@endif"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name">Адрес</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="@if (Auth::check()){{ Auth::user()->address  }}@endif"
                                       placeholder="">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="comments">Комментарий</label>
                                <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
                            </div>
                        </div>

                        <div class="row mb-5" >

                            <div class="text-left col-md-6" >

                                <button type="button" onclick="showCartCheckoutTab(1)" class="btn btn-lg btn-outline-success  btn-rounded">
                                    Назад
                                </button>

                            </div>
                            <div class="text-right col-md-6" >

                                <button type="button" onclick="checkoutCart()" class="btn btn-lg btn-success  btn-rounded">
                                    Отправить заказ
                                </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div style="padding-bottom: 150px;"></div>
    </div>

@endsection
