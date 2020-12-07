<?php
    class MyFileObject{ //클래스 선언
        private $filename; //외부에서 인스턴스를 건들지 못하도록 만들 수 있음.(사용하려하면 오류 출력)
        //public $filename; //만약 외부에서도 사용할 수 있게 하려면 public 선언
        function __construct($fname) //생성자(인스턴스 초기화)
        {
            $this->filename = $fname;
            if(!file_exists($this->filename))
            {
                die('There is no file '.$this->filename);
            }
        }
        function isFile()
        {
            return is_file($this->filename); //인스턴스 변수, $file, $file2에서 선언된 filename을 사용하기위해 $this 사용
        }
    }

    $file = new MyFileObject('data.txt');
    //$file = new MyFileObject();
    //$file->filename = 'data.txt';
    $file->filename = 'data2.txt'; //외부에서 파일 이름을 바꾸려고 접근함
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