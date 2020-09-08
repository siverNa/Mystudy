<?php
  $conn = mysqli_connect('localhost', 'root', 'apmsetup', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수

  $sql = "SELECT * FROM topic";

  $result = mysqli_query($conn, $sql);
  $list = '';
  while($row = mysqli_fetch_array($result)){ //mysqli_fetch_array() : sql문 결과를 배열형태로 가져옴
    $escaped_title = htmlspecialchars($row['title']); //스크립트 언어가 입력되지 않도록 <,> 등을 문자로 바꿔줌
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
  }

  $article = array( //배열은 배열인데 문자를 이용한 배열은 '연관배열'
    'title' => 'Welcome',
    'description' => 'Hello, WEB'
  );

  if(isset($_GET['id'])){
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']); 
    //mysqli_real_escape_string() : SQL injection 공격을 방어하기 위한 함수. 인자로 들어온 데이터 중에서 sql injection 공격과
    //관련된 여러가지 기호를 문자로 바꿔버리는 함수.
    $sql = "SELECT * FROM topic WHERE id={$filtered_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    $article['title'] = htmlspecialchars($row['title']); //sql 결과를 저장한 배열(row)의 값을 article 배열에 저장함.
    $article['description'] = htmlspecialchars($row['description']);   
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