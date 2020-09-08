<?php
    $conn = mysqli_connect('localhost', 'root', 'apmsetup', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수

    $filtered = array(
        'title' => mysqli_real_escape_string($conn, $_POST['title']),
        'description' => mysqli_real_escape_string($conn, $_POST['description'])
        //mysqli_real_escape_string() : SQL injection 공격을 방어하기 위한 함수. 인자로 들어온 데이터 중에서 sql injection 공격과
        //관련된 여러가지 기호를 문자로 바꿔버리는 함수.
    );

    $sql = "
        INSERT INTO topic(title, description, created)
        VALUES (
            '{$filtered['title']}',
            '{$filtered['description']}',
            NOW()
        )
    ";

    $result = mysqli_query($conn, $sql); //mysqli_query() : 쿼리문을 연결할 주소와 같이 담아 전송, true 또는 false로 반환하는 함수.

    if($result == false){
        echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.";
        error_log(mysqli_error($conn)); 
        /*mysqli_error() : 에러가 있을 경우 에러 정보를 알려주는 함수
        error_log() : 에러 로그를 아파치 error 로그파일에 저장하는 함수.*/
    } else {
        echo "저장에 성공했습니다! <a href=\"index.php\">돌아가기</a>";
    }

    mysqli_close($conn); //mysqli_close() : mysql과 연결을 끊는 함수
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>