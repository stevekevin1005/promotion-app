<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Promotion App</title>
    <style type="text/css">
    .fail {width:200px; margin: 20px auto; color: red;}
    form {font-size:16px; color:#999; font-weight: bold;}
    form {width:160px; margin:20px auto; padding: 10px; border:1px dotted #ccc;}
    form input[type="text"], form input[type="password"] {margin: 2px 0 20px; color:#999;}
    form input[type="submit"] {width: 100%; height: 30px; color:#666; font-size:16px;}
    </style>
</head>
<body>
    @if ($errors->has('fail'))
        <div class="fail">{{ $errors->first('fail') }}</div>
    @endif
    <form action="/login" method="post">
        {{ csrf_field() }}
        <label>name</label>
        <input type="text" name="name" value="admin" required readonly>
        <label>Password</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>