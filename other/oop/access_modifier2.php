<?php
    class Person
    {
        private $name; //private로 선언->데이터 은닉화
        
        public function sayHi()
        {
            print("Hi, I'm {$this->name}.<br>");
        }

        //값을 세팅하는 메소드
        //이런 식으로 만들어 놓음으로써 입력값의 유효성을 확인할 수있음
        /*function setName($_name) 
        {
            if(empty($_name))
            {
                die('I need name.');
            }
            $this->name = $_name;
        }

        //값을 불러오는 메소드
        //private로 선언되어 있으므로 외부에서 name을 읽지 못하기에 메소드로 선언하고 리턴
        function getName()
        {
            return $this->name;
        } 
        */
        public function setName($_name) 
        {
            $this->ifEmptyDie($_name);
            $this->name = $_name;
        }

        public function getName()
        {
            return $this->name;
        } 

        private function ifEmptyDie($value)
        {
            if(empty($value))
            {
                die('i need name.<br>');
            }
        }

    }
    $siver = new Person();
    $siver->setName('siver');
    $siver->sayHi();
    print($siver->getName());
?>