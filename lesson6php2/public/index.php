<?php
use App\services\Autoloader;
use App\services\NewException;
use App\services\RendererTmplServices;

require_once dirname(__DIR__) . '/vendor/autoload.php';
$request = new App\services\Request();

$controllerName = $request->getControllerName();
if (class_exists($controllerName)) {
    /** @var \App\controllers\Controller $realController */
    $realController = new $controllerName(
        new \App\services\TwigRendererServices(),
        $request
    );
    $content = $realController->run($request->getActionName());
    if (!empty($content)) {
        echo $content;
    }
}