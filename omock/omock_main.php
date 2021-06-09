<?php
    session_start(); //로그인 상태이면 세션 시작
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>오목</title>
</head>
<body>
    <h1>어서오세요!</h1>
    <!-- 세션 유무에 따라 출력이 달라짐 -->
    <ul>
        <?php
            if(isset($_SESSION['nickname'])) //세션이 시작되있으면 문구 출력 및 로그아웃 버튼 활성화
            {
                echo "{$_SESSION['nickname']}님 환영합니다!";
        ?>
        <li onclick="logout()"><button>로그아웃</button></li>
        <?php
            } else { //로그인 상태가 아니라면 로그인 버튼 활성화
        ?>
        <li><a href="omock_login.php">로그인</a></li>

        <?php
            }
        ?>
    </ul>
    <!-- ul 태그 끝 -->
    <script>
        function logout() //로그아웃 자바 스크립트?
        {
            console.log("hello");
            const data = confirm("로그아웃 하시겠습니까?");
            if(data)
            {
                location.href = "omock_logout_process.php";
            }
        }
    </script>
</body>
</html>