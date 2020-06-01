
<div class="container">
    <div class="row">
        <div class="col-lg-3 flex-center">
            <table style="border-collapse: collapse;" border="0">
                <tbody>
                <tr>
                    <td rowspan="2"  style="vertical-align: middle;" >
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('img/logo.png') }}" class="header__logo-img">
                        </a>
                    </td>
                    <td style="vertical-align: bottom;"  >

                        @if(App\Models\Setting::getValue('facebook'))
                            <a href="mailto:{{ App\Models\Setting::getValue('facebook') }}" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;" >
                        @if(App\Models\Setting::getValue('instagram'))
                            <a href="mailto:{{ App\Models\Setting::getValue('instagram') }}" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-2 flex-center" style="flex-wrap: wrap;">
            @if(App\Models\Setting::getValue('phone1'))
            <a href="callto:{{ preg_replace('/[^0-9]/', '', App\Models\Setting::getValue('phone1')) }}">
                {{ App\Models\Setting::getValue('phone1') }}
            </a>
            @endif
            @if(App\Models\Setting::getValue('phone2'))
            <a href="callto:{{ preg_replace('/[^0-9]/', '', App\Models\Setting::getValue('phone2')) }}">
                {{ App\Models\Setting::getValue('phone2') }}
            </a>
            @endif

        </div>
        <div class="col-lg-4 flex-center">

            @include('partials.search-box')

        </div>
        <div class="col-lg-3 flex-center justify-content-between">
            <div class="float-left">
                @if (Route::has('login'))
                    @auth
                        <div class="dropdown">
                        <a class="nav-link dropdown" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('img/icons/ui-user.svg') }}" class="img20">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item"  href="{{ url('/orders') }}">Мои заказы</a>
                            <a class="dropdown-item"  href="{{ url('/profile') }}">Мои реквизиты</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Выход
                            </a>
                            @if (!Auth::guest() && Auth::user()->role_id == 1)
                                <a class="dropdown-item"  href="{{ url('/adm') }}">Админ-панель</a>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        </div>
                    @else
                        <div class="dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('img/icons/login.svg') }}" class="img20">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
{{--                                <a class="dropdown-item" href="{{ route('login') }}">Вход</a>--}}
                                <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#loginModal">Вход</a>

                                @if (Route::has('register'))
{{--                                    <a class="dropdown-item" href="{{ route('register') }}">Регистрация</a>--}}
                                    <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#registerModal">Регистрация</a>
                                @endif
                            </div>
                        </div>
                    @endauth
                @endif
            </div>
            <div class="float-right text-right">
                <a href="/cart-checkout">
                    <img src="{{ asset('img/icons/cart-alt.svg') }}" class="img20 mr-2"/>
                    <span class="cart-count">0</span> шт. - <span class="cart-total">0</span> р.
                </a>
            </div>
        </div>
    </div>
</div>




<nav class="navbar navbar-top navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">О нас <span class="sr-only">(current)</span></a>
                </li>
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
{{--                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        Магазин--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">--}}
{{--                        <div class="row">--}}
{{--                            @foreach($allBrands as $k => $brand)--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <a href="/brand/{{$brand['id']}}">--}}
{{--                                        <strong class="sub-menu-heading">--}}
{{--                                            <i class="fa fa-angle-double-right"></i>--}}
{{--                                            {{$brand['name']}}--}}
{{--                                        </strong>--}}
{{--                                    </a>--}}
{{--                                    @foreach($allProducts as $kk => $productIt)--}}
{{--                                        @if ($productIt['brand_id'] == $brand['id'])--}}
{{--                                            <div><a href="/product/{{$productIt['id']}}">- {{$productIt['name']}}</a></div>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a class="nav-link" href="/magazin">Магазин</a>
                </li>

                @foreach($allBrands as $k => $brand)
                    <li class="nav-item">
                        <a class="nav-link" href="/brand/{{$brand['id']}}">{{$brand['name']}}</a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link" href="/articles">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart-checkout">Корзина</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#contacts">Контакты</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Вход</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="loginForm" action="{{ route('login') }}" action-new="/auth/login">
                    @csrf

                    <div class="form-group row">
                        <label for="loginForm_email" class="col-md-4 col-form-label text-md-right">Email:</label>

                        <div class="col-md-8">
                            <input id="loginForm_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="loginForm_password" class="col-md-4 col-form-label text-md-right">Пароль:</label>

                        <div class="col-md-8">
                            <input id="loginForm_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Запомнить
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="loginFormAlert" class="alert alert-danger hidden"></div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Вход
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Забыли пароль?
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-12 text-center">
                            <a class="btn btn-link mb-0 pb-0" href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">
                                Зарегистрироваться
                            </a>
                            <small style="width: 100%;display: block;">Если вы впервые на сайте, заполните, пожалуйста, регистрационную форму.</small>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="registerForm" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="registerForm_name" class="col-md-4 col-form-label text-md-right">ФИО</label>

                        <div class="col-md-8">
                            <input id="registerForm_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="registerForm_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                        <div class="col-md-8">
                            <input id="registerForm_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="registerForm_password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                        <div class="col-md-8">
                            <input id="registerForm_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="registerForm_password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердите Пароль</label>

                        <div class="col-md-8">
                            <input id="registerForm_password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Зарегистрироваться
                            </button>
                        </div>
                    </div>

                    <div id="registerFormAlert" class="alert alert-danger hidden"></div>

                    <div class="form-group row mb-0">
                        <div class="col-12 text-center">
                            уже есть аккаунт?
                            <a class="btn btn-link mb-0 pb-0" href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">
                                Войти
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

