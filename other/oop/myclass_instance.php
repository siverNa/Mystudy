<?php
    class Myclass{ //클래스 선언
        function plus($i,$j){ //메소드 선언, 함수를 정의하는 방법과 같다.
            return $i + $j;
        }

        function minus($i, $j){
            return $i - $j;
        }
    }

    $test = new Myclass(); //인스턴스 생성, 생성할땐 new 클래스이름()을 해주면됨.

    var_dump($test -> plus(3, 5)); //메소드 사용, '->' 를 이용해 메소드를 사용한다.
    var_dump($test -> minus(10, 7));

?>