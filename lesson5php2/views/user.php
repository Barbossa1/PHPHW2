<?php

/** @var \App\models\User $user */
?>

<h1>Пользователь</h1>
<p>
    Логин: <?= $user->user_login ?> <br>
    Адресс: <?= $user->user_address ?>
</p>
<a href="/public/?c=user&a=del">Удалить</a>