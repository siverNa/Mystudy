<?php
    class MyFileObject{ //클래스 선언
        function __construct($fname) //생성자(인스턴스 초기화)
        {
            $this->filename = $fname;
        }
        function isFile()
        {
            return is_file($this->filename); //인스턴스 변수, $file, $file2에서 선언된 filename을 사용하기위해 $this 사용
        }
    }

    $file = new MyFileObject('data.txt');
    var_dump($file->isFile());
    var_dump($file->filename);

    /* 
    MyfileObject : Class
    $file, $file2 : Instance
    isFile : method, behavior
    $this->filename : 
        Instance Variable, Instance field, Instance property,
        status 
    */
?>