<?php
    $conn = mysqli_connect('localhost', 'root', '111111', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수
    $sql = "INSERT INTO topic(title, description, created)
    VALUES ('MySQL', 'MySQL is...', NOW())";

    $result = mysqli_query($conn, $sql); //mysqli_query() : 쿼리문을 연결할 주소와 같이 담아 전송, true 또는 false로 반환하는 함수.

    if($result == false){
        echo mysqli_error($conn); //mysqli_error() : 에러가 있을 경우 에러 정보를 알려주는 함수.
    }
?>