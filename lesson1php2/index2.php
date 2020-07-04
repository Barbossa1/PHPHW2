<?php

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

/*
х увеличивается на 1 на кажом шагу, тк $a1 и $a2 это один и тот же класс
*/

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();

/*
х увеличивается на 1 на кажом шагу у уаждого класса, тк А и В это разные классы, хоть и В наследует от А
*/

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo(); 
/*
выдает то же что и на предыдущеи примере, я думаю значит скоюки можно использовать тогда, когда есть что передовать
*/