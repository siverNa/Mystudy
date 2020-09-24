<?php
    session_start();
    $_SESSION['title'] = "생활코딩";

    if(isset($_SESSION['title'])){
        echo "세션 생성에 성공했습니다!";
    }
?>