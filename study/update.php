<?php
    require_once('lib/print.php'); //리팩토링 및 require함수 사용, 파일에 저장한 함수들을 불러올 수 있음.
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
    <?php 
        print_title(); //타이틀을 출력하는 함수
    ?>
    </title>
</head>
    <body>
        <h3><a href="index.php">WEB</a></h3>
        <ol>
            <?php
                print_list(); //파일 리스트를 출력하는 함수
            ?>
        </ol>
        <a href="create.php">create</a>
        <?php if(isset($_GET['id'])){ ?>
            <a href="update.php?id=<?=$_GET['id'] ?>">update</a> 
        <?php } ?>
        <form action="update_process.php" method="POST">
            <input type="hidden" name="old_title" value="<?=$_GET['id'] ?>">
            <p><input type="text" name="title" placeholder="Title" value="<?php print_title(); ?>"></p>
            <p><textarea name="description" cols="100" rows="10" placeholder="Description"><?php print_discription(); ?></textarea></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>