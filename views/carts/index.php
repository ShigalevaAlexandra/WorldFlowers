<?php

use app\models\Carts;
use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';

?>
<div class="carts-index">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <script>
        function add_product(id, items) {
            let form=new FormData();
            form.append('product_id', id);
            form.append('count', items);

            let request_options={method: 'POST', body: form};
            fetch('https://up-shigaleva.xn--80ahdri7a.site/carts/create', request_options)
            .then(response=>response.text())
            .then(result=>{
                console.log(result)
                let title=document.getElementById('staticBackdropLabel');
                let body=document.getElementById('modalBody');
            
                if (result.includes('false')){
                    title.innerText='Ошибка добавления товара';
                    body.innerHTML="<p>Товара нет в наличии</p>"
                } else {
                    title.innerText='В корзине новый товар';
                    body.innerHTML="<p>Товар успешно добавлен в корзину</p>"
                }

                let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                myModal.show();
            })
        }

        function remove_product(id) {
            let form = new FormData();
            form.append('select_id', id);

            let request_options={method: 'POST', body: form};
            fetch('https://up-shigaleva.xn--80ahdri7a.site/carts/remove', request_options)
            .then(response => response.text())
            .then(result => {
                console.log(result)
                let title = document.getElementById('staticBackdropLabel');
                let body = document.getElementById('modalBody');

                if (result.includes('false')){
                    title.innerText = 'Ошибка';
                    body.innerHTML = "<p>Ошибка удаления товара</p>"
                } else {
                    title.innerText = 'Корзина уменьшилась';
                    body.innerHTML = "<p>Товар успешно удален из корзины</p>"
                }

                let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                myModal.show();
            })
        }

        /*function order() {
            let request_options = {
                method: 'POST'
            };

            fetch('https://up-shigaleva.xn--80ahdri7a.site/orders/create', request_options)
                .then(response => response.text())
                .then(result => {
                    let title = document.getElementById('staticBackdropLabel');
                    let body = document.getElementById('modalBody');
                    if (result == false) {
                        title.innerText = 'Ошибка';
                        body.innerHTML = "<p>Ошибка удаления товара</p>"
                    } else {
                        title.innerText = 'Информационное сообщение';
                        body.innerHTML = "<p>Товар успешно удален</p>"
                    }
                    let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                    myModal.show();
                })
        }*/

        function onSubmit() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        }
    </script>

    <?php
        $carts = Carts::find()->where(['user_id' => Yii::$app->user->id, 'order_id' => null])->all();
        $products = [];

        foreach ($carts as $cart) {
            $cart_prod = Products::findOne($cart->product_id)->toArray();
            $cart_prod['count'] = $cart->count;
            array_push($products, $cart_prod);
        }

        echo "<br><div class='d-flex flex-row flex-wrap justify-content-start align-itemsend'>";
        foreach ($products as $product) {
            echo "<div class='card m-1' style='width: 22%; min-width: 390px;'>
                <a href='/product/view?id_product={$product['id_product']}' style='height: 300px; width: 388px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url(https://up-shigaleva.xn--80ahdri7a.site/web/{$product['photo']})'></a>
                <div class='card-body'>
                <h5 class='card-title'>{$product['name']}</h5>";

                $price = $product['price'] * $product['count'];

            echo "<p class='text-danger'><b>{$price} руб</b></p>";
            echo "<div class='d-flex w-100 justify-content-between align-items-center'>
                <button onclick='remove_product({$product['id_product']})' class='btn btn-secondary'>-</button>
                <p class='card-text m-0'>{$product['count']}</p>
                <button onclick='add_product({$product['id_product']}, 1)' class='btn btn-secondary'>+</button>
            </div>";
        echo "</div>
        </div>";
    }

    echo "</div>";

    ?>

    <?php
        if ($products) {
            echo '<br><button type="button" class="btn btn-outline-secondary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Оформить заказ</button>';
        } else {
            echo "<p class='mt-3'>В корзине ничего нет</p>";
        }
    ?>

</div>
