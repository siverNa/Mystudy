<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
    <body>
        <h3><a href="index.php">WEB</a></h3>
        <ol>
            <?php
                $list = scandir('./data');
                
                $i = 0;
                while($i < count($list)){
                    if($list[$i] != "."){
                        if($list[$i] != ".."){
                            echo "<li><a href=\"index.php?id=$list[$i]\">$list[$i]</a></li>\n";
                        }
                    }
                    $i += 1;
                }
                
            ?>
        </ol>
        <h2>
            <?php
                if(isset($_GET['id'])){
                    echo $_GET['id']; 
                } 
                else{
                    echo "Welcome";
                }
            ?>
        </h2>
        <p>
            <?php 
                if(isset($_GET['id'])){
                    echo file_get_contents("data/".$_GET['id']); 
                }
                else{
                    echo "Hello, PHP";
                }
            ?>
        </p>
    </body>
</html>