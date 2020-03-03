
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" class="header__logo-img">
            </a>
        </div>
        <div class="col-lg-2 flex-center">
            <a href="callto:84992133401">
                8(499)213-34-01
            </a>
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
                            <a class="dropdown-item"  href="{{ url('/home') }}">Личный кабинет</a>
                            @if (!Auth::guest() && Auth::user()->role_id == 1)
                            <a class="dropdown-item"  href="{{ url('/adm') }}">Админ-панель</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Выход
                            </a>
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
                                <a class="dropdown-item" href="{{ route('login') }}">Вход</a>
                                <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#loginModal">Вход модал</a>

                                @if (Route::has('register'))
                                    <a class="dropdown-item" href="{{ route('register') }}">Регистрация</a>
                                @endif
                            </div>
                        </div>
                    @endauth
                @endif
            </div>
            <div class="float-right text-right">
                <img src="{{ asset('img/icons/cart-alt.svg') }}" class="img25">
                0 шт. - 0 р.
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
                    <a class="nav-link" href="#">О нас <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Магазин
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Teamviewer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ascon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Microsoft</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Autodesk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Контакты</a>
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
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Пароль:</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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

                    <div class="form-group row mb-0">
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
                </form>
            </div>
        </div>
    </div>
</div>
