<?php
    $conn = mysqli_connect('localhost', 'root', '111111', 'omock'); //mysqli_connect() : mysql과 php를 연결하는 함수

    $nickname = $_POST['nickname'];

    $sql = "SELECT * FROM omock_user WHERE nickname = '{$nickname}'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    //$row['nickname'];

    if($nickname == $row['nickname'])
    {
        //로그인 성공
        //세션에 아이디(닉네임)저장
        session_start();
        $_SESSION['nickname'] = $row['nickname'];
        print_r($_SESSION);
        echo $_SESSION['nickname'];
?>
    <script>
        alert("로그인에 성공하였습니다.");
        location.href = "main.php";
    </script>
<?php
    } else 
    {
        //로그인 실패
?>
    <script>
        alert("로그인에 실패하였습니다.");
    </script>
<?php
    }
?>