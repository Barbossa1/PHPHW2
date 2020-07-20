<?php
/**
 * @var \App\controllers\GoodController $content
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<ul>
    <li><a href="/public/?c=user&a=all">Пользователи</a></li>
    <li><a href="/public/?c=good&a=all">Товары</a></li>
    <li><a href="/public/?c=good&a=add">Добавить товар</a></li>
</ul>

<?= $content ?>
</body>
</html>