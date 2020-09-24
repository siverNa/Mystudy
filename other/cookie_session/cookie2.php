<?php
    if(isset($_COOKIE['cookie1']) && isset($_COOKIE['cookie2'])){
        echo $_COOKIE['cookie1']."<br>";
        echo time() - $_COOKIE['cookie2'];
    } else {
        echo "활성화된 쿠키가 없습니다.<br>";
    }
    
?>