<?php
    $conn = mysqli_connect('localhost', 'root', 'apmsetup', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수

    $sql = "SELECT * FROM topic";

    $result = mysqli_query($conn, $sql);
?>