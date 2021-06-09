# 기능해야할 것

- 서버 만들기  
  - 네이버, AWS 등 서버에서 apache 또는 nginx 등 설치해서 작동하게
  - 정보 필요  
- 닉네임만 입력해서 로그인 
  - 회원가입(DB 저장)이 아님  
  - 만약 대기방에서 중복된 닉네임 만나면 뒤에 숫자 추가  
  - 아마 세션을 이용해야할 것 같음  
- 로그인하면 오목눈이 사진을 랜덤으로 할당, 로그인 후 언제든 바꾸게 해줄 예정
- 대기방 만들기
- 가능하면 채팅기능 만들기  
  - 정해진 텍스트를 만든 뒤, 이를 선택해서 출력해
- 33, 44, 장목 등 금지 여부를 방마다 있어야함  
  - DB 게임규칙 테이블에 컬럼을 추가해 사용 여부를 저장하고 적용하면 되는듯
- 쌍방향으로 통신하여 오목이 가능하게 만들기  
  - 이에 대한 정보가 너무 부족함. 검색 및 테루님께 여쭤봐야할 듯?
  - 상대가 오목 돌을 놓으면 GET 으로 조회하고, POST로 돌 삽입, PUT 으로 수정, DELETE를 삭제 등
    HTTP메소드 및 Restful Api를 이용해 구현해보라고 말씀하심.  
  - 각 주소값에 대한 php를 매치시키고, 해당 php 에 접속하면 스트링를 추력하도록 만들어보라 하심

  

# 로그인

- 로그인 기능은 어몽어스의 '닉네임' 입력방식을 이용할 것임 -> 닉네임 입력만으로 어떻기 사용자 정보를 유지할까? -> 닉네임 입력과 동시에 회원가입을 시키고, 로그아웃을 하면 db 테이블에서 정보 삭제  

  ```html
  <!-- login.php -->
  <!-- 로그인화면 -->
  <body>
      <h1>로그인</h1>
      <form action="login_process.php" method="post">
          <p>닉네임 입력</p>
          <input type="text" name="nickname" placeholder="nickname input"></br>
  
          <button type="submit">로그인하기</button>
      </form>
      <a href="./signup.php">회원가입</a>
  </body>
  ```

  - 입력을 받고 'submit' 버튼을 누루면 **post** 방식으로 정보 전달, `login_process.php` 로 넘어가게됨  

  ```php
  /* 
  mysqli_connect() 
  resource mysqli_connect([string host], [string username], [string password],
                                  [string dbname], [int port], [string socket])
     - host : MySQL 서버 주소
     - username : 데이터베이스 사용자 계정
     - password : 데이터베이스 사용자 비밀번호
     - dbname : 선택할 데이터베이스 이름
     - port : MySQL 서버 포트 번호
     - socket : 소켓 또는 명명된 파이프
  */
  //사용 예
  $conn = mysqli_connect('localhost', 'root', '비밀번호', 'omock');
  ```

  - 데이터베이스에 접속하는 함수  
  - 데이터베이스에 접속하고 연결이 되면 MySQL 연결 정보를 객체로 되돌려준다.  

  ```php
  /*
  mysqli_query()
  mixed mysqli_query(mysqli link, string query, [int resultmode])
  
  - link : MySQL 연결 객체
  - query : 쿼리
  - resultmode : mysqli_use_result / mysqli_store_result
  */
  //사용 예
  $sql = "SELECT * FROM omock_user WHERE nickname = '{$nickname}'";
  $result = mysqli_query($conn, $sql);
  ```

  - `mysqli_real_query()` 함수를 호출한 후 `mysqli_use_result()` / `mysqli_store_result()` 함수를 호출한것과 같다.
  - 아니면 본인이 사용한 것과 같이 `$sql` 변수에 쿼리문을 담아 보낼 수 도있다.  

  ```php
  /*
  mixed mysqli_fetch_array(mysqli_result result, [int resulttype])
  
  - result : MySQLi 결과 객체
  - resulttype : MYSQLI_ASSOC, MYSQLI_NUM, MYSQLI_BOTH
  */
  //사용 예
  $row = mysqli_fetch_array($result);
  ```

  -  mysqli_query(), mysqli_use_result(), mysqli_store_result() 함수의 결과인 mysqli_result 객체를 입력받아 결과 레코드를 배열로 반환한다.  
  - mysql_fetch_array() 함수와 동일하다.  

  ------------------------------------------------------------------------

  - 이하로는 함수를 실제로 사용해서 회원가입 및 로그인을 동시에 수행  
  - 불필요한 동작이 남아있는 것 같지만, 나중에 수정해볼 예정

  ```php
  	function uuidgen() { //uid를 생성하는 함수
          return sprintf('%08x-%04x-%04x-%04x-%04x%08x',
             mt_rand(0, 0xffffffff),
             mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
             mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
           );
       }
  
      $uid = uuidgen();
      //insert문을 이용해 회원가입 정보를 데이터베이스에 넣어줌
      $sql = " 
          INSERT INTO omock_user
          (nickname, uid)
          VALUES ('{$_POST['nickname']}', '{$uid}')
      ";
  
      echo $sql."<br>";
      
      //sql문과 함께 DB에 전송하고 결과를 받아옴
      $result = mysqli_query($conn, $sql);
  
      if($result == false) //result 결과가 false라면 오류문 출력
      {
          echo "저장에 문제가 생겼습니다. 관리자에게 문의해 주세요.<br>";
          echo mysqli_error($conn);
      }
  ```

  - 임의의 난수인 `uid` 를 생성하고, 닉네임과 함께 테이블의 레코드에 추가하는 코드.  
    만약 실패하면 에러문과 같이 결과를 반환하게됨  

  

  

  - DB의 회원 정보 레코드와 비교해, 닉네임이 일치하면 세션이 시작되고, 메인화면으로 리다이렉션되는 코드.  

    > 생각할 거리 :  
    > 이미 회원가입으로 닉네임이 한번 설정됐으므로, 이걸 그대로 가져다 적으면 되는데, 여기서 한번 더 비교할 필요 있을까?   
    > 개인적으로 필요 없는 부분이라 생각되는데, 만약 정상 동작된다면 코드를 수정해보자.  

  ```php
  <?php
      $nickname = $_POST['nickname'];
  
      $sql = "SELECT * FROM omock_user WHERE nickname = '{$nickname}'";
      $result = mysqli_query($conn, $sql);
  
      $row = mysqli_fetch_array($result);
  
      if($nickname == $row['nickname'])
      {
          //로그인 성공
          //세션에 아이디(닉네임)저장
          session_start();
          $_SESSION['nickname'] = $row['nickname'];
          print_r($_SESSION);
          echo $_SESSION['nickname'];
  ?>
      <script>
          alert("로그인에 성공하였습니다.");
          location.href = "omock_main.php";
      </script>
  <?php
      } else 
      {
          //로그인 실패
  ?>
      <script>
          alert("로그인에 실패하였습니다.");
      </script>
  <?php
      }
  ?>
  ```




# 로그아웃

- 로그아웃시,  DB에서 해당 닉네임이 일치하는 레코드를 삭제하도록 만들었음.  

```php
<?php
    session_start();
    $nickname = $_SESSION['nickname']; //세션 파괴 전, 현재 로그인한 세션을 저장후 삭제
    session_destroy(); //세션 종료

    $conn = mysqli_connect('localhost', 'root', '111111', 'omock'); //데이터베이스 접속
    if (mysqli_connect_errno($conn))
    {
        echo "데이터 베이스 연결 실패 : " . mysqli_connect_error();
    }

    //'omock_user' 테이블의 'nickname' 이 일치하는 레코드를 제거
    $sql = "
        DELETE 
        FROM omock_user 
        WHERE nickname = '{$nickname}'
    ";

    if (!mysqli_query($conn, $sql))
    {
        die("데이터베이스 에러 : ".mysqli_error($conn));
    }
    else
    {
?>
    <script>
        alert("로그아웃 하셨습니다.");
        location.href = "omock_main.php";
    </script>
<?php
    }
?>
```

- 로그아웃에 있는 에러 확인 문구들은 다음과 같은 내용을 참고해서 만들었다.  

  >mysql 쿼리를 실행했을 때 각종 오류를 확인할 수 있는 함수입니다
  >
  >
  >
  >mysqli_connect_errno() 함수를 이용하여 DB 연결이 잘 되었는지 확인할 수 있고, 
  >
  >mysqli_error() 함수를 이용하여 쿼리에 오류가 있는지 확인이 가능합니다.
  >
  >```php
  ><?php
  >$conn = mysqli_connect("localhost","아이디","비밀번호","DB명");
  >// DB 연결이 잘 되었는지 확인
  >if ( mysqli_connect_errno() )
  >{
  >echo "DB 연결에 실패했습니다 " . mysqli_connect_error();
  >}
  >// 쿼리가 제대로 실행되었는지 확인
  >if ( !mysqli_query ($conn," INSERT INTO member (id, name) VALUES ('jackson','마이클잭슨')") )
  >{
  >echo("쿼리오류 발생: " . mysqli_error($conn));
  >}
  >mysqli_close($conn);
  >?>
  >```
  >
  >출처: https://doolyit.tistory.com/118 [동해둘리의 IT Study]



# DB 생성 및 오류 해결

- `omock_user` 테이블을 생성하기 위해 다음과 같은 SQL 문을 작성했다.  

  ```sql
  --테이블을 생성하기 위해 먼저 DB를 생성 및 선택
  CREATE DATABASE omock;
  USE omock;
  
  --omock_user 테이블 생성
  CREATE TABLE omock_user(
  	id int NOT NULL AUTO INCREMENT PRIMARY KEY,
      nickname varchar(10),
      uuid varchar(32)
  );
  
  --테이블 컬럼 속성 확인
  DESC omock_user;
  ```

  하지만 이후 데이터를 삽입할 때, `uuid` 를 집어넣을 수 없다는 오류 메세지를 출력했다.  
  확인해보니, `uuid` 가 담길 컬럼의 크기가 너무 딱 맞아서 안들어갈 수 있다는 생각을 했고, 다음과 같이 컬럼의 속성을 변경해줬다.  
  추가로, `nickname`, `uuid`도 `null` 로 존재해선 안되므로 속성을 `not null`로 바꿔주었다.  

  ```sql
  --컬럼 타입 변경
  --ALTER TABLE 테이블명 MODIFY 컬럼명 변경할컬럼타입
  ALTER TABLE omock_user MODIFY uuid varchar(40) NOT NULL;
  ALTER TABLE omock_user MODIFY nickname varchar(10) NOT NULL;
  ```

  
