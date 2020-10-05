<h1>Function Style</h1>
<?php
    $adata = array('a', 'b', 'c'); //배열 선언
    array_push($adata, 'd'); //배열에 'd'를 추가
    foreach($adata as $item){ //배열 adata의 요소들을 item 변수에 저장
      echo $item.'<br>'; //item 변수 내용 출력
    }
    var_dump(count($adata)); //배열의 요소 개수 출력
?>
<h1>Object Style</h1>
<?php
    $odata = new ArrayObject(array('a', 'b', 'c')); //배열 객체 선언
    $odata->append('d'); //객체내 메소드 사용할 땐 '->'기호 사용, odata배열에 d 추가
    foreach($odata as $item){
        echo $item.'<br>';
    }
    var_dump($odata->count()); //배열의 요소 개수 출력
?>