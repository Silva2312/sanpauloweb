<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$asunto}}</title>
</head>
<body>
    <h4>From: {{$from_cuenta}}</h4>
    <h4>Reply-to: {{$reply_cuenta}}</h4>
    <br>
    <h3>{{$asunto}}</h3>
    <br>
    <p>Tu nueva contraseña es: <strong>' {{ $contrasena }} '</strong></p>
</body>
</html>