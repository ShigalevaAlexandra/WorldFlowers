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
                echo "</div>
            </div>";
        echo "</div>";
        ?>
</div>
