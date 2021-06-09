<?php
    session_start();
    $nickname = $_SESSION['nickname']; //세션 파괴 전, 현재 로그인한 세션을 저장후 삭제
    session_destroy(); //세션 종료

    $conn = mysqli_connect('localhost', 'root', '111111', 'omock'); //데이터베이스 접속
    if (mysqli_connect_errno($conn))
    {
        echo "데이터 베이스 연결 실패 : " . mysqli_connect_error();
    }

    //'omock_user' 테이블의 'nickname' 이 일치하는 레코드를 제거
    $sql = "
        DELETE 
        FROM omock_user 
        WHERE nickname = '{$nickname}'
    ";

    if (!mysqli_query($conn, $sql))
    {
        die("데이터베이스 에러 : ".mysqli_error($conn));
    }
    else
    {
?>
    <script>
        alert("로그아웃 하셨습니다.");
        location.href = "omock_main.php";
    </script>
<?php
    }
?>