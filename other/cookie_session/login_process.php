<?php
    session_start();

    $id = 'egoing';
    $pwd = 'coding';

    if(!empty($_POST['id']) && !empty($_POST['pwd'])){
        if($_POST['id'] == $id && $_POST['pwd'] == $pwd){
            $_SESSION['is_login'] = true;
            $_SESSION['nickname'] = '이고잉';
            header("Location: ./session_start.php");
            exit;
        }
    }
    echo "로그인하지 못했습니다.";
?>