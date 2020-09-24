<?php
    ini_set("display_errors", "1");
    session_start();
    echo $_SESSION['title'];
    echo file_get_contents('C:\Bitnami\wampstack-7.4.9-0\php\tmp\sess_'.session_id());
?>