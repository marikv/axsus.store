@extends('layout')

@section('content')


    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">Мои реквизиты</h1>
        </div>

        <div class="container">
            <div class="row">
                <form>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="@if (Auth::check()) {{ Auth::user()->email  }} @endif" id="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Телефон</label>
                            <input type="text" class="form-control phone-mask"
                                   id="phone" name="phone" value="@if (Auth::check()){{ Auth::user()->phone  }}@endif"
                                   placeholder="">
                        </div>

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

                        <div class="text-right col-md-12">

                            <button type="button" onclick="saveProfile()" class="btn btn-lg btn-success  btn-rounded">
                                Сохранить
                            </button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">Изменить пароль</h1>
        </div>

        <div class="container">
            <form>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" name="password" value="" id="password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Подтвердите пароль</label>
                            <input type="password" class="form-control" name="password_confirmation" value=""
                                   id="password_confirmation">
                        </div>
                        <div class="form-group col-md-12 alert alert-danger" id="passwordErrors" style="display: none"></div>


                        <div class="text-right col-md-12">

                            <button type="button" onclick="saveProfilePassword()" class="btn btn-lg btn-success  btn-rounded">
                                Сохранить
                            </button>

                        </div>
                    </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

@endsection
