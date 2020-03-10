<div id="contacts" style="padding-bottom: 40px; background-color:#E8F6F9;">

    <div >
        <div class="container" >
            <h1 class=" text-center">{{$page4['name']}}</h1>
            {!! $page4['description'] !!}


            <div class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputName">Ф.И.О.</label>
                                <input type="text" class="form-control" id="inputName">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail">Email или Телефон</label>
                                <input type="text" class="form-control"  onkeyup="removeContactError('inputEmail')" id="inputEmail" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Текст</label>
                        <textarea class="form-control" id="inputMessage" rows="5"></textarea>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-6 text-right">
                            {!! captcha_img() !!}
                            <input type="text" name="captcha"  onkeyup="removeContactError('captcha')" id="captcha" class="form-control" style="width: 100px;display: inline;">
                        </div>
                        <div class="col-md-6 text-left">
                            <button type="button" onclick="sendContactForm()" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i> Отправить
                            </button>
                        </div>
                    </div>
            </div>


        </div>
    </div>

</div>
<style>
    .has-error {
        border: 1px solid red;
    }
    .contact-form {
        padding: 30px 0;
        margin: 30px auto;
    }
    .contact-form .form-group {
        margin-bottom: 20px;
    }
    .contact-form .form-control, .contact-form .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .contact-form .form-control {

    }
    .contact-form .form-control:focus {
        box-shadow: 0 0 8px rgba(7, 1, 139, 0.28);
    }
    .contact-form .btn-primary {
        min-width: 250px;
        border: none;
    }
    .contact-form .btn-primary:hover {
        color: #fff;
    }
    .contact-form .btn-primary i {
        margin-right: 5px;
    }
    .contact-form label {
        opacity: 0.9;
    }
    .contact-form textarea {
        resize: vertical;
    }
    .bs-example {
        margin: 20px;
    }
</style>
