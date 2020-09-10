<?php
  $conn = mysqli_connect('localhost', 'root', '111111', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수

  $sql = "SELECT * FROM topic";

  $result = mysqli_query($conn, $sql);
  $list = '';
  while($row = mysqli_fetch_array($result)){ //mysqli_fetch_array() : sql문 결과를 배열형태로 가져옴
    $escaped_title = htmlspecialchars($row['title']); //스크립트 언어가 입력되지 않도록 <,> 등을 문자로 바꿔줌
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
  }

  $sql = "SELECT * FROM author"; //author 테이블에서 저자의 이름을 가져오기 위해 생성
  $result = mysqli_query($conn, $sql);
  $select_form = '<select name="author_id">';
  while ($row = mysqli_fetch_array($result)){
    $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
  }
  $select_form .= '</select>';
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href="index.php">WEB에 어서와요</a></h1>
    <ol>
      <?=$list?>
    </ol>
    <form action="create_process.php" method="post">
        <p><input type="text" name="title" placeholder="title"></p>
        <p><textarea name="description" cols="30" rows="10" placeholder="description"></textarea></p>
        <p><?=$select_form ?></p>
        <p><input type="submit"></p>
    </form>
  </body>
</html>