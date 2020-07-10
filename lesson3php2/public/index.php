<?php
use App\services\Autoloader;
use App\services\DB;
use App\models\Good;
use App\models\Users;

include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([(new Autoloader()), 'loadClass']);

$good = new Good();
$array = $good->getOne(1);
$good = (object)$array;
print_r($good);

$users = new Users();
$users->id = 21;
$users->user_login = 'user3';
$users->user_password = '123';
$users->user_address = 'Лондон';
//$users->save();
?>

<br><? echo $good->id; ?>
<br><? echo $good->goods_name; ?>
<br><? echo $good->goods_price; ?>
<br><? echo $good->goods_description; ?>