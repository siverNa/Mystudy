<?php
    unlink("data/".basename($_POST['id'])); //파일을 삭제함
    header("Location: index.php"); //리다이렉션(Redirection)을 위한 함수. 파라미터에 리다이렉션할 url을 입력함.
?>