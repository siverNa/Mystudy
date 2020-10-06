<?php
    class MyFileObject{
        function isFile(){
            return is_file($this->filename); //인스턴스 변수, $file, $file2에서 선언된 filename을 사용하기위해 $this 사용
        }
    }

    $file = new MyFileObject();
    $file->filename = 'data.txt';
    var_dump($file->isFile());
    var_dump($file->filename);
 
    $file2 = new MyFileObject();
    $file2->filename = 'data2.txt';
    var_dump($file2->isFile());
    var_dump($file2->filename);

    /* 
    MyfileObject : Class
    $file, $file2 : Instance
    isFile : method, behavior
    $this->filename : 
        Instance Variable, Instance field, Instance property,
        status 
    */
?>