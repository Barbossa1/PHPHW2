<?php
/** @var \App\models\Good $good */
?>

<h1>Товар</h1>
<p>
    Название товара:<?= $good->goods_name ?> <br>
    Цена товара:<?= $good->goods_price ?> <br>
    Описание товара: <?= $good->goods_description ?>
</p>
<a href="/public/?c=good&a=del&id=<?= $good->id ?>">Удалить</a>
<button id="myBtn">Изменить</button>
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">×</span>
            <h2>Изменение товара</h2>
        </div>
        <div class="modal-body">
            <form action="/controllers/GoodController.php">
                <input type="text" placeholder="Название товара" name="goods_name"><br>
                <input type="text" placeholder="Цена товара" name="goods_price"><br>
                <input type="text" placeholder="Описание товара" name="goods_description"><br>
                <input type="submit">
            </form>
        </div>
    </div>
</div>

<script>
    let modal = document.getElementById('myModal');
    let btn = document.getElementById("myBtn");
    let span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    };

    span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>