<?php
use App\services\Autoloader;
use App\services\RendererTmplServices;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/views');
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate(dirname(__DIR__) . '/views/layouts/main.php');
$title = "Shop";
echo $template->render(array(
    'title' => $title
));

$controller = 'user';
if ($_GET['c']) {
    $controller = $_GET['c'];
}

$controller = 'good';
if ($_GET['c']) {
    $controller = $_GET['c'];
}

$action = '';
if (!empty($_GET['a'])) {
    $action = $_GET['a'];
}

$controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';

if (class_exists($controllerName)) {
    /** @var \App\controllers\UserController $realController */
    $realController = new $controllerName(new RendererTmplServices());
    $content = $realController->run($action);
    if (!empty($content)) {
        echo $content;
    }
}