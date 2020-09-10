<?php
  $conn = mysqli_connect('localhost', 'root', '111111', 'opentutorials'); //mysqli_connect() : mysql과 php를 연결하는 함수
  
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href="index.php">WEB에 어서와요</a></h1>
    <p><a href="index.php">topic</a></p>
    <table border="1">
        <tr> <!-- table 에서 tr은 행, td는 열을 나타냄, 하나의 tr은 하나의 행, 하나의 td는 하나의 열임. -->
            <td>id</td><td>name</td><td>profile</td>
            <?php
                $sql = "SELECT * FROM author";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_array($result)) {
                    $filtered = array(
                        'id' => htmlspecialchars($row['id']),
                        'name' => htmlspecialchars($row['name']),
                        'profile' => htmlspecialchars($row['profile'])
                    )
                    ?>
                    <tr>
                        <td><?=$filtered['id']?></td>
                        <td><?=$filtered['name']?></td>
                        <td><?=$filtered['profile']?></td>
                    </tr>
                    <?php
                }
            ?>
        </tr>
    </table>
  </body>
</html>