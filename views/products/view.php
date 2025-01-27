<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<br><br><br><div class="products-view">

    <?php
        /* @var $this yii\web\View */
        /* @var $searchModel app\models\ProductsSearch */
        /* @var $dataProvider yii\data\ActiveDataProvider */

        $categories = \app\models\Categories::findOne(['id_category' => $model -> category_id]);

        echo "<div class='d-flex flex-row flex-wrap justify-content-center border-info align-itemsend'>";
    
            echo "<div class='card m-1' style='width: 22%; min-width: 390px;'>
                <a href='/product/view?id_product={$model->id_product}'><img src='https://up-shigaleva.xn--80ahdri7a.site/web/{$model->photo}' class='card-img-top'
                style='max-height: 500px;' alt='image'></a>
                <div class='card-body'>
                    <h5 class='card-title'>{$model->name}</h5><br>
                    <p class='text-secondary'><b>Цена:</b> {$model->price} руб</p>
                    <p class='text-secondary'><b>Страна поставщика:</b> {$model->country_origin}</p>
                    <p class='text-secondary'><b>Категория:</b> {$categories->name}</p>
                    <p class='text-secondary'><b>Цвет:</b> {$model->color}</p>
                    <p class='text-secondary'><b>Кол-во:</b> {$model->count}</p>";
                    echo (Yii::$app->user->isGuest ? "" : "<p onclick='add_product({$model->id_product}, 1)' class='btn btn-secondary mt-3'>Добавить в корзину</p>");
                echo "</div>
            </div>";
        echo "</div>";
        ?>
</div>
<script>
    function add_product(id, items){
        let form=new FormData();
        form.append('product_id', id);
        form.append('count', items);

        let request_options={method: 'POST', body: form};
        fetch('https:///up-shigaleva.xn--80ahdri7a.site/carts/create', request_options)
        .then(response=>response.text())
        .then(result=>{
            console.log(result)
            let title=document.getElementById('staticBackdropLabel');
            let body=document.getElementById('modalBody');
            
            if (result=='false'){
                title.innerText='Ошибка';
                body.innerHTML="<p>Ошибка добавления товара, вероятно, товар уже раскупили</p>"
            } else {
                title.innerText='В корзине новый товар';
                body.innerHTML="<p>Товар успешно добавлен в корзину</p>"
            }

            let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
            myModal.show();
        })
    } 
</script>
