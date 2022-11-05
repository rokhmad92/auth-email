<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form method="post">
        @csrf
        <label for="email">email</label>
        <input type="text" name="email" id="email">
<br>
        <label for="password">password</label>
        <input type="text" name="password" id="password">
<br>
        <a href="/register">Register</a>
<br>
        <button type="submit">Login!</button>
    </form>
</body>
</html>