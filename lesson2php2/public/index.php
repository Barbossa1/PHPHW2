<?php
include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([(new Autoloader()), 'loadClass']);

$user = new User();
var_dump($user);

$good = new Good();
var_dump($goods);