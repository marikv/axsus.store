<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href="{{asset('css/static.css')}}" rel="stylesheet">
        <!-- Styles -->

    </head>
    <body>

        @include('partials.top')
        @include('partials.carousel')



        <div class="container text-center">
            <h1>Производители</h1>
            <h3>Только официальная продукция</h3>
            <p>
                Наш интернет-магазин является официальным дилером представленных производителей программного обеспечения.
                Это означает, что все программное обеспечение предлагаемое нами, действительно лицензионное, никакого «контрафакта» и «пиратского контента»,
                на все товары распространяется гарантия производителя, а цены в нашем магазине соответствуют, рекомендованным производителем.
            </p>
            <div class="text-center flex-center justify-content-between">
                <a href="" class="lp-brands__link">
                    <img src="{{ asset('img/logos/ascon.jpg') }}" class="rounded mx-auto d-block lp-brands__img" alt="ascon">
                </a>
                <a href="" class="lp-brands__link">
                    <img src="{{ asset('img/logos/autodesk.jpg') }}" class="rounded mx-auto d-block lp-brands__img" alt="autodesk">
                </a>
                <a href="" class="lp-brands__link">
                    <img src="{{ asset('img/logos/microsoft.jpg') }}" class="rounded mx-auto d-block lp-brands__img" alt="microsoft">
                </a>
                <a href="" class="lp-brands__link">
                    <img src="{{ asset('img/logos/teamviewer.jpg') }}" class="rounded mx-auto d-block lp-brands__img" alt="ascon">
                </a>
            </div>
        </div>


        <div style="background-color: #E8F6F9" class=" text-center">
            <h1>О нас</h1>
            <div class="container" >
                <p>Вас приветствует компания «АКСИС ПРОЕКТЫ»!</p>
                <p>Наша цель - долгосрочное сотрудничество и доверительные отношения с клиентами</p>
                <p style="text-align: justify;">
                    Мы предлагаем широкий спектр продукции и услуг для создания современной, эффективной и надежной IT-инфраструктуры в государственных и частных предприятиях и организациях.

                    <br>Имея 10-летний опыт работы, мы можем заявить о себе, как о сильной, надежной компании, успех которой имеет две главные составляющие: профессионализм наших сотрудников и доверительные отношения с клиентами.

                    <br>За годы развития мы приобрели все необходимые компетенции в области серверных и сетевых решений, системной интеграции, собственной сборки компьютерного и серверного оборудования и многих других услуг в сфере IT-технологий.

                    <br>Нами накоплен огромный опыт в реализации проектов любого уровня сложности – от простых поставок техники и оборудования до оказания полномасштабных услуг «под ключ» в соответствии с потребностями клиентов.

                    <br>Мы разработали наиболее оптимальные алгоритмы взаимодействия с заказчиками, позволяющие нам предоставлять максимально удобный сервис и значительно облегчать работу IT-специалистов и сотрудников отделов закупки.
                </p>
            </div>
        </div>




        @include('partials.products')


        @include('partials.articles')


        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aa4ae3eca4afb357bfbcf96608f2e8502260b3753aaae5978d6739cc598e9b209&amp;source=constructor" width="100%" height="579" frameborder="0"></iframe>


        @include('partials.footer')
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>



    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show show-dropdown-menu";

    $(window).on("load resize", function() {

        $('.carousel').carousel();

        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
</script>
</html>
