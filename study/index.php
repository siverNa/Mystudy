<!DOCTYPE html>
<?php 
    function print_title(){ //함수는 하나의 기능을 하도록 구성하는게 좋다.
        if(isset($_GET['id'])){ /*isset(값) : 변수의 값이 존재하는지 참, 거짓으로 반환.*/
            echo $_GET['id']; 
        } 
        else{
            echo "Welcome";
        }
    }
    function print_discription(){
        if(isset($_GET['id'])){
            echo file_get_contents("data/".$_GET['id']); 
            /*file_get_contents(파일경로) : 파일경로상의 파일을 읽어 내부의 값을 읽어온다. */
        }
        else{
            echo "Hello, PHP";
        }
    }
    function print_list(){
        $list = scandir('./data');  
                /*scandir('파일경로') : 해당하는 디렉토리의 파일들을 읽어 배열 형태로 저장한다. 
                '.'은 파일이 있는 현재 디렉토리를 의미함.*/
                
        $i = 0;
        while($i < count($list)){ /*count($배열변수) : 배열의 크기를 읽어 정수형으로 반환. */
            if($list[$i] != "."){ /*'.'은 현재 디렉토리, '..'은 부모 디렉토리를 의미함. */
                if($list[$i] != ".."){
                    echo "<li><a href=\"index.php?id=$list[$i]\">$list[$i]</a></li>\n"; 
                    /*php문에서 큰 따옴표를 사용하면 문자열이라고 혼란을 줄 수 있으므로 ' \(역슬래시)" '를 사용해 일반
                    문자열이라는 것을 알려줌. */
                }
            }
            $i += 1;
        }
    }
?>
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
            <form action="delete_process.php" method="post">
                <input type="hidden" name="id" value="<?=$_GET['id'] ?>">
                <input type="submit" value="delete">
            </form>
        <?php } ?>
        <h2>
            <?php
                print_title();
            ?>
        </h2>
        <p>
            <?php 
                print_discription(); //파일의 내용을 읽어서 출력하는 함수
            ?>
        </p>
    </body>
</html>