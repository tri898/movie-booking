<html lang="Vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<form action="/login">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
</form>
<div class="row">
    <div class="col-12 text-center">
        <a href="{{ route('social-login.redirect','facebook') }}" class="btn btn-primary">Login with Facebook</a>
        <a href="{{ route('social-login.redirect','github') }}" class="btn btn-success">Login with Github</a>
    </div>

</body>
</html>
