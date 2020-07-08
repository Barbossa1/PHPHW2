<?php
use App\models\Good;
use App\models\User;

class Autoloader
{
    public function foo()
    {
	    new Good();
	    new User();
    }

    public function loadClass()
    {
        foreach (foo() as $dir) {
            $file = dirname(__DIR__) . '/' . $dir . '.php';
            if (is_file($file)) {
                include $file;
                break;
            }
     	}
    }
}
