<?php
    $conn = mysqli_connect('localhost', 'root', '111111', 'omock'); //데이터베이스 접속

    function uuidgen() { //uid를 생성하는 함수
        return sprintf('%08x-%04x-%04x-%04x-%04x%08x',
           mt_rand(0, 0xffffffff),
           mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
           mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
         );
     }

    $uuid = uuidgen();
    //insert문을 이용해 회원가입 정보를 데이터베이스에 넣어줌
    $sql = " 
        INSERT INTO omock_user
        (nickname, uuid)
        VALUES ('{$_POST['nickname']}', '{$uuid}')
    ";

    echo $sql."<br>";
    
    //sql문과 함께 DB에 전송하고 결과를 받아옴
    $result = mysqli_query($conn, $sql);

    if($result == false) //result 결과가 false라면 오류문 출력
    {
        echo "저장에 문제가 생겼습니다. 관리자에게 문의해 주세요.<br>";
        echo mysqli_error($conn);
    }
    //여기까지가 회원가입 처리

    //여기서부터 로그인 처리
    $nickname = $_POST['nickname'];

    $sql = "SELECT * FROM omock_user WHERE nickname = '{$nickname}'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

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
        location.href = "omock_main.php";
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