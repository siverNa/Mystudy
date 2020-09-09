<?php
  $conn = mysqli_connect('localhost', 'root', '111111', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수

  $sql = "SELECT * FROM topic";

  $result = mysqli_query($conn, $sql);
  $list = '';
  while($row = mysqli_fetch_array($result)){ //mysqli_fetch_array() : sql문 결과를 배열형태로 가져옴
    $escaped_title = htmlspecialchars($row['title']); //스크립트 언어가 입력되지 않도록 <,> 등을 문자로 바꿔줌
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
  }

  $article = array( //배열은 배열인데 문자를 이용한 배열은 '연관배열'
    'title' => 'Welcome',
    'description' => 'Hello, WEB',
  );

  $update_link = ''; //id(글)를 선택전에는 나타나지 않도록 설정
  $delete_link = '';

  $author='';

  if(isset($_GET['id'])){
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']); 
    //mysqli_real_escape_string() : SQL injection 공격을 방어하기 위한 함수. 인자로 들어온 데이터 중에서 sql injection 공격과
    //관련된 여러가지 기호를 문자로 바꿔버리는 함수.
    $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    $article['title'] = htmlspecialchars($row['title']); //sql 결과를 저장한 배열(row)의 값을 article 배열에 저장함.
    $article['description'] = htmlspecialchars($row['description']);
    $article['name'] = htmlspecialchars($row['name']);

    $update_link = '<a href="update.php?id='.$_GET['id'].' ">update</a>'; //만약 글을 선택하면 그때 update링크가 나타나도록 설정

    //delete의 경우 get방식으로 전달하면 단지 링크를 클릭했을 뿐인데도 데이터가 삭제되는 심각한 문제가 발생함
    //이를 방지하기 위해서는 delete를 수행할땜 form을 사용하면 좋음
    $delete_link = '
      <form action="delete_process.php" method="post">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
        <input type="submit" value="delete">
      </form>
    '; 
    
    $author = "<p>by {$article['name']} </p> "; //글이 선택되었을 때에만 저자가 출력되도록 설정
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
    <a href="create.php">create</a>
    <?=$update_link?>
    <?=$delete_link?>
    <h2><?=$article['title']?></h2>
    <?=$article['description'] ?>
    <p><?=$author ?></p>
  </body>
</html>