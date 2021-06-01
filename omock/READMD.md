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
  
  

