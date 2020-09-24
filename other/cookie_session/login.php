<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>로그인</h1>
    <form action="login_process.php" method="post">
        <p><label>아이디</label><input type="text" name="id"></p>
        <p><label>비밀번호</label><input type="password" name="pwd"></p>

        <input type="submit" value="로그인하기">
    </form>
</body>
</html>