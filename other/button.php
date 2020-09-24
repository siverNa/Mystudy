<?php
    header("Content-type: image/png"); //헤더는 가장 위에 위치해야함.

    $string = $_GET['text'];
    $im = imagecreatefrompng("button.png"); //imagecreatefrompng() : png로부터 이미지 생성, 이미지의 식별자 생성
    $blue = imagecolorallocate($im, 60, 87, 156); // imagecolorallocate() : 이미지의 색 할당, 색깔에 대한 식별자

    // imagesx() : 이미지 식별자의 폭(x축 길이)을 계산, 한 글자의 길이를 7.5로 대략적으로 줬음
    // strlen() : 문자열의 길이 계산
    $px = (imagesx($im) - 7.5 * strlen($string)) / 2;

    imagestring($im, 4, $px, 9, $string, $blue); //imagestring() : 이미지에 글씨를 적음
    imagepng($im); //전송
    imagedestroy($im); // imagedestroy() : 지금까지 사용했던 이미지 자원을 해제함.
?>