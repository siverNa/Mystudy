<?php
    session_start();
    session_destroy(); //세션 종료

    $conn = mysqli_connect('localhost', 'root', '111111', 'omock'); //데이터베이스 접속
    if (mysqli_connect_errno($conn))
    {
        echo "데이터 베이스 연결 실패 : " . mysqli_connect_errno();
    }
    
    $nickname = $_POST['nickname'];

    //'omock_user' 테이블의 'nickname' 이 일치하는 레코드를 제거
    $sql = "
        DELETE 
        FROM omock_use 
        WHERE nickname = '{$nickname}'
    ";

    if (!mysqli_query($conn, $sql))
    {
        die("데이터베이스 에러 : ".mysqli_error());
    }
    else
    {
?>
    <script>
        alert("로그아웃 하셨습니다.");
        header("Location: ./omock_main.php"); //로그아웃되면 main으로 돌아가도록 설정
    </script>
<?php
    }
?>