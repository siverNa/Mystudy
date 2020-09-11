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
            <td>id</td><td>name</td><td>profile</td><td></td><td></td>
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
                        <td><a href="author.php?id=<?=$filtered['id'] ?>">update</a></td>
                        <td>
                            <form action="delete_process_author.php" method="post" 
                            onsubmit="if(!confirm('정말 지우시겠어요?')){return false; }">
                            <!-- onsubmit : 전송행위가 일어났을 때, onsubmit의 속성값을 자바스크립트로써 실행하라는 뜻 -->
                            <!-- confirm : submit 버튼을 누르면 팝업이 뜨면서 OK, Cancel 버튼 창이 나옴. cancel을 누르면 false를 반환 -->
                            <!-- action으로 데이터를 전송한다는 기본 동작을 중지시킴 -->
                            <!-- 아를 통해 사용자에게 한번 더 확인을 구하는 효과를 만들 수 있음. -->
                                <input type="hidden" name="id" value="<?=$filtered['id']?>">
                                <input type="submit" value="delete">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tr>
    </table>
    <?php
        $escaped = array( //id 값이 없는 경우에는 기본 텍스트가 표시되도록 설정
            'name' => '',
            'profile' => ''
        );

        $lable_submit = 'Create Author'; //update 버튼을 누르기 전엔 생성 버튼 텍스트를 표시함
        $form_action = 'create_process_author.php'; //update 버튼을 누르기 전엔 생성프로세스를 수행
        $form_id = ''; //update_process_author.php 에 id 값을 넘겨주기 위한 변수, update 버튼을 누르기 전엔 아무 값도 없음

        if(isset($_GET['id'])){ //update 버튼을 눌렀을 경우 
            $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
            settype($filtered_id, 'integer');
            $sql = "SELECT * FROM author WHERE id={$filtered_id} ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $escaped['name'] = htmlspecialchars($row['name']);
            $escaped['profile'] = htmlspecialchars($row['profile']);

            $lable_submit = 'Update Author';
            $form_action = 'update_process_author.php';
            $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'" ';
        }       
    ?>
    <form action="<?=$form_action?>" method="post">
        <?=$form_id?>
        <p><input type="text" name="name" placeholder="name" value="<?=$escaped['name'] ?>"></p>
        <p><textarea name="profile" cols="30" rows="10" placeholder="profile"><?=$escaped['profile']?></textarea></p>
        <p><input type="submit" value="<?=$lable_submit?>"></p>
    </form>
  </body>
</html>