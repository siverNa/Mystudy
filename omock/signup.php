<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h1>어서오세요!</h1>
    <h3>수많은 도전자가 당신을 기다립니다!</h3>
    <form action="signup_process.php" method="post">
        <div>
            <label for="id">아이디</label>
            <input type="text" name="user_id" id="user_id" placeholder="아이디를 입력해주세요.">
        </div>
        <div>
            <label for="nickname">닉네임</label>
            <input type="text" name="nickname" id="nickname" placeholder="닉네임을 입력해주세요.">
        </div>
        <button type="submit">회원가입하기</button>
    </form>
</body>
</html>