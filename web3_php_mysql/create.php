<?php
  $conn = mysqli_connect('localhost', 'root', 'apmsetup', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수

  $sql = "SELECT * FROM topic";

  $result = mysqli_query($conn, $sql);
  $list = '';
  while($row = mysqli_fetch_array($result)){ //mysqli_fetch_array() : sql문 결과를 배열형태로 가져옴
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array( //배열은 배열인데 문자를 이용한 배열은 '연관배열'
    'title' => 'Welcome',
    'description' => 'Hello, WEB'
  );

  if(isset($_GET['id'])){
    $sql = "SELECT * FROM topic WHERE id={$_GET['id']}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
      $article['title'] = $row['title'];
      $article['description'] = $row['description'];
    
  }
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
        <p><input type="submit"></p>
    </form>
  </body>
</html>