<?php
    file_put_contents("data/".basename($_POST['title']), basename($_POST['description'])); //파일을 만드는 함수, 파일경로및 이름과 내용을 생성함
    header("Location: index.php?id=".$_POST['title']); //리다이렉션(Redirection)을 위한 함수. 파라미터에 리다이렉션할 url을 입력함.
?>