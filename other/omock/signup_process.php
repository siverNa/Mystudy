<?php
    $conn = mysqli_connect('localhost', 'root', '111111', 'omock'); //데이터베이스 접속

    function uuidgen() { //uid를 생성하는 함수
        return sprintf('%08x-%04x-%04x-%04x-%04x%08x',
           mt_rand(0, 0xffffffff),
           mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
           mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
         );
     }

    $uid = uuidgen();
    //insert문을 이용해 회원가입 정보를 데이터베이스에 넣어줌
    $sql = " 
        INSERT INTO omock_user
        (user_id, nickname, uid)
        VALUES ('{$_POST['user_id']}', '{$_POST['nickname']}', '{$uid}')
    ";

    echo $sql."<br>";
    
    $result = mysqli_query($conn, $sql);

    if($result == false) //result 결과가 false라면 오류문 출력
    {
        echo "저장에 문제가 생겼습니다. 관리자에게 문의해 주세요.<br>";
        echo mysqli_error($conn);
    } else {
?>
    <script>
        alert("회원가입이 완료되었습니다!");
        location.href = "main.php";
    </script>
<?php 
    }
?>