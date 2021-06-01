<?php
    session_start();
    session_destroy(); //세션 종료
    header("Location: ./main.php"); //로그아웃되면 main으로 돌아가도록 설정
?>