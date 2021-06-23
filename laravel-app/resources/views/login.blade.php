<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        <!-- Styles -->
        <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <script src="/js/jquery.min.1.11.3.js"></script>
        <script src="/js/bootstrap/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container text-center">
            <p>Login</p>
            <form action="/login" method="post">
                @csrf
                <input type="text" name="email" /><br>
                <input type="password" name="password" /><br>
                <input type="submit" value="submit" />
            </form>
        </div>
    </body>
</html>
