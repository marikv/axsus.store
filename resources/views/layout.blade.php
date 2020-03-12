<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$meta_title}}</title>
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="description" content="{{$meta_description}}"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="{{asset('css/static.css')}}" rel="stylesheet">
    <!-- Styles -->
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script>
        var LaravelShopCartId = '{{ $LaravelShopCartId ?? '' }}';
    </script>

</head>
<body>

@include('partials.top')

@yield('content')

@include('partials.footer')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show show-dropdown-menu";

    $(window).on("load resize", function () {

        $('.carousel').carousel();

        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
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


    var removeContactError = function (n) {
        $('#' + n).removeClass('has-error');
    }
    var sendContactForm = function () {
        var $fio = $('#inputName');
        var $mail = $('#inputEmail');
        var $mess = $('#inputMessage');
        var $captcha = $('#captcha');
        if (!$mail.val()) {
            $mail.addClass('has-error');
            return false;
        }
        if (!$captcha.val()) {
            $captcha.addClass('has-error');
            return false;
        }
        $.ajax({
            url: '/send/addContactFromForm',
            type: 'POST',
            data: {
                fio: $fio.val(),
                mail: $mail.val(),
                mess: $mess.val(),
                captcha: $captcha.val()
            },
            success: function (r) {
                console.log(r);
                if (r.success) {
                    $fio.val('');
                    $mail.val('');
                    $mess.val('');
                    if (typeof Swal !== "undefined") {
                        Swal.fire({
                            title: 'Сообщение было отправлено',
                            text: 'Скоро с вами свяжется наш менеджер!',
                            icon: 'success',
                            confirmButtonText: 'Ок'
                        });
                    } else {
                        alert('Сообщение было отправлено!');
                    }
                } else {
                    if (typeof Swal !== "undefined") {
                        Swal.fire({
                            title: 'Ошибка!',
                            text: r.data,
                            icon: 'error',
                            confirmButtonText: 'Ок'
                        });
                    } else {
                        alert('Ошибка. Что-то пошло не так!');
                    }
                }
            },
            error: function (r) {
                console.log(r);
                if (typeof Swal !== "undefined") {
                    Swal.fire({
                        title: 'Ошибка!',
                        text: 'Что-то пошло не так!',
                        icon: 'error',
                        confirmButtonText: 'Ок'
                    });
                } else {
                    alert('Ошибка. Что-то пошло не так!');
                }
            }
        })
    }



    function addToCard(id) {

    }

    $("#loginForm, #registerForm").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var idForm = $(this).attr('id');
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    document.location.reload();
                } else {
                    $('#'+idForm+'Alert').removeClass('hidden').html(data.data);
                }
            },
            error: function(data) {
                if (data.responseJSON && data.responseJSON.errors) {
                    $('.invalid-feedback-my').remove();
                    for (var property in data.responseJSON.errors) {
                        if (data.responseJSON.errors.hasOwnProperty(property)) {
                            $('#'+idForm+'_'+property).addClass('is-invalid').after('<span class="invalid-feedback invalid-feedback-my" role="alert">\n' +
                                '                                        <strong>'+data.responseJSON.errors[property].join('; ') + '</strong>\n' +
                                '                                    </span>');
                        }
                    }
                }
            },
        });
    });
</script>
</body>
</html>
