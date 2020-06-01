<style>/* Footer */
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    section {
        padding: 60px 0;
    }

    section .section-title {
        text-align: center;
        color: #003399;
        margin-bottom: 50px;
        text-transform: uppercase;
    }
    #footer {
        background: #003399 !important;
    }
    #footer h5{
        padding-left: 10px;
        border-left: 3px solid #eeeeee;
        padding-bottom: 6px;
        margin-bottom: 20px;
        color:#ffffff;
    }
    #footer a {
        color: #ffffff;
        text-decoration: none !important;
        background-color: transparent;
        -webkit-text-decoration-skip: objects;
    }
    #footer ul.social li{
        padding: 3px 0;
    }
    #footer ul.social li a i {
        margin-right: 5px;
        font-size:25px;
        -webkit-transition: .5s all ease;
        -moz-transition: .5s all ease;
        transition: .5s all ease;
    }
    #footer ul.social li:hover a i {
        font-size:30px;
        margin-top:-10px;
    }
    #footer ul.social li a,
    #footer ul.quick-links li a{
        color:#ffffff;
    }
    #footer ul.social li a:hover{
        color:#eeeeee;
    }
    #footer ul.quick-links li{
        padding: 3px 0;
        -webkit-transition: .5s all ease;
        -moz-transition: .5s all ease;
        transition: .5s all ease;
    }
    #footer ul.quick-links li:hover{
        padding: 3px 0;
        margin-left:5px;
        font-weight:700;
    }
    #footer ul.quick-links li a i{
        margin-right: 5px;
    }
    #footer ul.quick-links li:hover a i {
        font-weight: 700;
    }

    @media (max-width:767px){
        #footer h5 {
            padding-left: 0;
            border-left: transparent;
            padding-bottom: 0px;
            margin-bottom: 10px;
        }
    }

</style>
<!-- Footer -->
<section id="footer">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">

            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Страницы</h5>
                <ul class="list-unstyled quick-links">
                    @foreach($allPages as $k => $page)
                        <li><a href="/page/{{$page['id']}}"><i class="fa fa-angle-double-right"></i>{{$page['name']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Бренды</h5>
                <ul class="list-unstyled quick-links">
                    @foreach($allBrands as $k => $page)
                        <li><a href="/brand/{{$page['id']}}"><i class="fa fa-angle-double-right"></i>{{$page['name']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Другие</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="/"><i class="fa fa-angle-double-right"></i>Главная</a></li>
                    <li><a href="/articles"><i class="fa fa-angle-double-right"></i>Новости</a></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <div style="max-width: 300px;margin: auto;width: 100%;">@include('partials.search-box')</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    @if(App\Models\Setting::getValue('facebook'))
                        <li class="list-inline-item">
                            <a href="mailto:{{ App\Models\Setting::getValue('facebook') }}" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    @endif
                    @if(App\Models\Setting::getValue('instagram'))
                        <li class="list-inline-item">
                            <a href="mailto:{{ App\Models\Setting::getValue('instagram') }}" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                    @if(App\Models\Setting::getValue('email1'))
                        <li class="list-inline-item">
                            <a href="mailto:{{ App\Models\Setting::getValue('email1') }}" target="_blank">
                                <i class="fa fa-envelope"></i> {{ App\Models\Setting::getValue('email1') }}
                            </a>
                        </li>
                    @endif
                    @if(App\Models\Setting::getValue('email2'))
                        <li class="list-inline-item">
                            <a href="mailto:{{ App\Models\Setting::getValue('email2') }}" target="_blank">
                                <i class="fa fa-envelope"></i> {{ App\Models\Setting::getValue('email2') }}
                            </a>
                        </li>
                    @endif
                    @if(App\Models\Setting::getValue('phone1'))
                        <li class="list-inline-item">
                            <a href="callto:{{ preg_replace('/[^0-9]/', '', App\Models\Setting::getValue('phone1')) }}" target="_blank">
                                <i class="fa fa-phone"></i> {{ App\Models\Setting::getValue('phone1') }}
                            </a>
                        </li>
                    @endif
                    @if(App\Models\Setting::getValue('phone2'))
                        <li class="list-inline-item">
                            <a href="callto:{{ preg_replace('/[^0-9]/', '', App\Models\Setting::getValue('phone2')) }}" target="_blank">
                                <i class="fa fa-phone"></i> {{ App\Models\Setting::getValue('phone2') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <hr/>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                {!! App\Models\Setting::getValue('footer') !!}
{{--                <p>--}}
{{--                    Внимание! Все права защищены законодательством РФ законом «об авторском праве и смежных правах».--}}
{{--                    Любое копирование и использование текстов, статей, фотографий или иных материалов разрешено только при активной ссылки на первоисточник.--}}
{{--                    Прежде чем принимать какие-либо решения, необходимо проконсультироваться с профессионалом.--}}
{{--                </p>--}}
{{--                <p class="h6">&copy All right Reversed. <a class="text-green ml-2" href="https://www.axsus.ru" target="_blank">AXSUS PROJECTS </a></p>--}}
            </div>
            <hr/>
        </div>
    </div>
</section>
