<?php
/**
 * @var \App\models\Users[] $users
 */
?>

    <h1>Пользователи</h1>
<?php foreach ($users as $user) :?>
    <p>
        <a href="/public/?c=user&a=one&id=<?= $user->id ?>">
            <?= $user->user_login ?>
        </a>
    </p>
<?php endforeach;?>