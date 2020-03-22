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
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

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

<script src="{{asset('js/jquery.mask.js')}}"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.phone-mask').mask("+7(000) 000-00-00", {placeholder: "+7(___) ___-__-__"});
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

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function showCartCheckoutTab(n) {
        $('.tabCart').slideUp({
            complete: function(){
                $('#tabCart' + n).slideDown();
            }
        });
    }
    function randomString(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    function setCartOrderType(n) {
        $('.btn-cart-type-of-order').removeClass('btn-primary').removeClass('btn-outline-primary');
        $('#btn-cart-type-of-order-' + n).addClass('btn-primary');
        $('.btn-cart-type-of-order:not(#btn-cart-type-of-order-' + n + ')').addClass('btn-outline-primary');
        document.getElementById('orderType').value = n;
        if (n === 2) {
            $('#cart-type-2').slideDown();
        } else {
            $('#cart-type-2').slideUp();
        }
    }
    function cartId() {
        var cartId = getCookie('cartId');
        if (!cartId) {
            cartId = randomString(30);
            setCookie('cartId', cartId, 3600);
        }
        return cartId;
    }
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    function validatePhone(phone) {
        return String(phone).replace(/[^0-9]/g,'').length === 11;
    }
    function checkoutCart() {
        var orderType = parseInt(document.getElementById('orderType').value);
        var $email = $('#email');
        var email = $email.val();
        var $phone = $('#phone');
        var phone = $phone.val();
        var hasError = false;
        if (!validateEmail(email)) {
            $email.removeClass('is-valid').addClass('is-invalid');
            hasError = true;
        } else {
            $email.removeClass('is-invalid').addClass('is-valid');
        }
        if (!validatePhone(phone)) {
            $phone.removeClass('is-valid').addClass('is-invalid');
            hasError = true;
        } else {
            $phone.removeClass('is-invalid').addClass('is-valid');
        }

        var data = {
          email: email,
          phone: phone,
          type: orderType
        };
        if (orderType === 2) {
            var $name = $('#name');
            var name = $name.val();
            if (String(name).length <= 1) {
                $name.removeClass('is-valid').addClass('is-invalid');
                hasError = true;
            } else {
                $name.removeClass('is-invalid').addClass('is-valid');
            }
            data.name = name;

            var $inn = $('#inn');
            var inn = $inn.val();
            if (String(inn).length <= 9) {
                $inn.removeClass('is-valid').addClass('is-invalid');
                hasError = true;
            } else {
                $inn.removeClass('is-invalid').addClass('is-valid');
            }
            data.inn = inn;

            var $kpp = $('#kpp');
            var kpp = $kpp.val();
            if (String(kpp).length >= 1) {
                if (String(kpp).length <= 6) {
                    $kpp.removeClass('is-valid').addClass('is-invalid');
                    hasError = true;
                } else {
                    $kpp.removeClass('is-invalid').addClass('is-valid');
                }
            }
            data.kpp = kpp;

            var $raschetnyi_schet = $('#raschetnyi_schet');
            var raschetnyi_schet = $raschetnyi_schet.val();
            if (String(raschetnyi_schet).length >= 1) {
                if (String(raschetnyi_schet).length <= 6) {
                    $raschetnyi_schet.removeClass('is-valid').addClass('is-invalid');
                    hasError = true;
                } else {
                    $raschetnyi_schet.removeClass('is-invalid').addClass('is-valid');
                }
            }
            data.raschetnyi_schet = raschetnyi_schet;

            var $contactnoe_lico = $('#contactnoe_lico');
            var contactnoe_lico = $contactnoe_lico.val();
            if (String(contactnoe_lico).length >= 1) {
                if (String(contactnoe_lico).length <= 2) {
                    $contactnoe_lico.removeClass('is-valid').addClass('is-invalid');
                    hasError = true;
                } else {
                    $contactnoe_lico.removeClass('is-invalid').addClass('is-valid');
                }
            }
            data.contactnoe_lico = contactnoe_lico;

            var $city = $('#city');
            var city = $city.val();
            if (String(city).length >= 1) {
                if (String(city).length <= 2) {
                    $city.removeClass('is-valid').addClass('is-invalid');
                    hasError = true;
                } else {
                    $city.removeClass('is-invalid').addClass('is-valid');
                }
            }
            data.city = city;

            var $address = $('#address');
            var address = $address.val();
            if (String(address).length >= 1) {
                if (String(address).length <= 2) {
                    $address.removeClass('is-valid').addClass('is-invalid');
                    hasError = true;
                } else {
                    $address.removeClass('is-invalid').addClass('is-valid');
                }
            }
            data.address = address;

            var $comment = $('#comment');
            var comment = $comment.val();
            if (String(comment).length >= 1) {
                if (String(comment).length <= 2) {
                    $comment.removeClass('is-valid').addClass('is-invalid');
                    hasError = true;
                } else {
                    $comment.removeClass('is-invalid').addClass('is-valid');
                }
            }
            data.comment = comment;
        }
        if (hasError) {
            return false;
        }

        $.ajax({
            type: "POST",
            url: '/cart/checkout/' + cartId(),
            data: data,
            success: function (data) {
                if (!data.success && data.data === 'userExist') {
                    Swal.fire({
                        title: 'Пожалуйста войдите в систему',
                        text: 'Мы нашли Ваш адрес электронной почты в нашу базу данных!',
                        icon: 'warning',
                        confirmButtonText: 'Открыть форму входа',
                        showCloseButton: true,
                        showCancelButton: true,
                        // cancelButtonColor: '#d33',
                        confirmButtonColor: '#003399',
                        cancelButtonText: 'Отмена',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $('#loginModal').modal('show')
                        }
                    });
                    return;
                }
                if (data.success && data.data) {
                    Swal.fire({
                        title: 'Поздравляем!',
                        text: 'Ваш заказ успешно оформлен и принят к исполнению!',
                        icon: 'success',
                        confirmButtonText: 'ОК',
                        showCloseButton: true,
                        showCancelButton: false,
                        // cancelButtonColor: '#d33',
                        confirmButtonColor: '#003399',
                        cancelButtonText: 'Отмена',
                        reverseButtons: true
                    }).then((result) => {
                        document.location.href = '/';
                    });
                    return;
                }
            }
        });
    }
    function cartDelete(id) {
        $.ajax({
            type: "DELETE",
            url: '/cart/' + cartId(),
            data: {id: id},
            success: function (data) {
                loadCartData();
                $('#cartTr' + id).slideUp();
                document.location.reload();
            }
        });
    }
    function loadCartData() {
        $.ajax({
            type: "GET",
            url: '/cart/' + cartId(),
            data: {},
            success: function (data) {
                if (data.success && data.data) {
                    var total = 0;
                    var count = 0;
                    for(var i=0 ;i<data.data.length; i+=1) {
                        count += parseInt(data.data[i].count);
                        total += parseInt(data.data[i].count) * parseFloat(data.data[i].price);
                    }
                    $('.cart-count').html(count);
                    $('.cart-total').html(total);
                }
            }
        });
    }
    loadCartData();
    function addToCard(id, count) {
        count = count || 1;
        $.ajax({
            type: "POST",
            url: '/cart/' + cartId(),
            data: {id: id, count: count},
            success: function (data) {
                loadCartData();
                Swal.fire({
                    title: 'Товар добавлен в корзину',
                    text: '',
                    icon: 'success',
                    confirmButtonText: 'Оформить Заказ',
                    showCloseButton: true,
                    showCancelButton: true,
                    // cancelButtonColor: '#d33',
                    confirmButtonColor: '#003399',
                    cancelButtonText: 'Продолжить покупки',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        document.location.href = '/cart-checkout';
                    }
                });
            }
        });
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
