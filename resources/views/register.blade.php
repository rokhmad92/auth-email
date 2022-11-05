<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
</head>
<body>
    <form method="post">
        @csrf
        <label for="email">email</label>
        <input type="email" name="email" id="email">
<br>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
<br>
        <label for="password">password</label>
        <input type="password" name="password" id="password">
<br>
        <a href="/">Login</a>
<br>
        <button type="submit">register!</button>
    </form>
</body>
</html>