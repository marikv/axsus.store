<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

Добрый день,<br>
<br>
Благодорим вас за регистрацию на сайте <?=env('APP_URL')?>;
<br><br>

Логин: <?=\Illuminate\Support\Facades\Auth::user()->email?><br>
Пароль: <?=$details['password']?><br>

<br><br>

</body>
</html>
