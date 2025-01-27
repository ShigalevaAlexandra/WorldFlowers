<?php

use app\models\Orders;
use app\models\Carts;
use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';

?>
<div class="orders-index">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <script>
        function remove_orders(id) {
            let form = new FormData();
            form.append('select_id', id);

            let request_options={method: 'POST', body: form};
            fetch('https://up-shigaleva.xn--80ahdri7a.site/orders/remove', request_options)
            .then(response => response.text())
            .then(result => {
                console.log(result)
                let title = document.getElementById('staticBackdropLabel');
                let body = document.getElementById('modalBody');

                if (result.includes('false')){
                    title.innerText = 'Ошибка удаления заказа';
                    body.innerHTML = "<p>Попробуйте обновить страницу...</p>"
                } else {
                    title.innerText = 'Заказов стало меньше';
                    body.innerHTML = "<p>Зака успешно удален</p>"
                }

                let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                myModal.show();
            })
        }
    </script>

    <?php
        $orders = Orders::find()->all();
        $products = [];

        foreach ($orders as $order) {
            $carts = Carts::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['order_id' => $order->id_order])->all();


            foreach ($carts as $cart) {
                $cart_prod = Products::findOne($cart->product_id)->toArray();
                $cart_prod['count'] = $cart->count;
                $cart_prod['status'] = $order->status;
                $cart_prod['number_order'] = $order->id_order;
                array_push($products, $cart_prod);
            }
        }

        echo "<br><div class='d-flex flex-row flex-wrap justify-content-start align-itemsend'>";
        foreach (array_reverse($products) as $product) {
            echo "<div class='card m-1' style='width: 22%; min-width: 390px;'>
                <a href='/product/view?id_product={$product['id_product']}' style='height: 300px; width: 388px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url(https://up-shigaleva.xn--80ahdri7a.site/web/{$product['photo']})'></a>
                <div class='card-body'>
                <h5 class='card-title'>{$product['name']}</h5>";

                $price = $product['price'] * $product['count'];

            echo "<p class='text-success'><b>Оплачено:</b> {$price} руб</b></p>
            <p class='card-text m-0'></b>Кол-во:</b> {$product['count']}</p><br>";
            if($product['status'] == 'Новый') {
                echo"<button class='btn btn-warning disabled text-white'><b>{$product['status']}</b></button>
                <button class='btn btn-danger text-white' onclick='remove_orders({$product['number_order']})'>Удалить</button>";
            } 
            if($product['status'] == 'Подтвержден') {
                echo"<button class='btn btn-success disabled text-white'><b>{$product['status']}</b></button>";
            } 
            if($product['status'] == 'Отменен') {
                echo"<button class='btn btn-danger disabled text-white'><b>{$product['status']}</b></button>";
            } 
            echo "<div class='d-flex w-100 justify-content-between align-items-center'>
            </div>";
        echo "</div>
        </div>";
        }
    echo "</div>";

    ?>

</div>
