<?php

use app\models\Orders;
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

    <br><br><h1><?= Html::encode($this->title) ?></h1><br>

    <div class="sort-buttons">
        <a class="btn btn-warning" href="https://up-shigaleva.xn--80ahdri7a.site/orders?sort=status&OrdersSearch[status]=Новый" type="button" id="button-addon2">Новые</a>
        <a class="btn btn-success" href="https://up-shigaleva.xn--80ahdri7a.site/orders?sort=status&OrdersSearch[status]=Подтвержден" type="button" id="button-addon2">Подтвержденные</a>
        <a class="btn btn-danger" href="https://up-shigaleva.xn--80ahdri7a.site/orders?sort=status&OrdersSearch[status]=Отменен" type="button" id="button-addon2">Отмененные</a>
    </div><br>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
        GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            ['label'=>'Дата создания', 'value'=> function($data){return Orders::getTimestamp($data->id_order);}],
            ['label'=>'ФИО заказчика', 'value'=> function($data){return Orders::getFIO($data->id_order);}],
            ['label'=>'Продукт', 'value'=> function($data){return Orders::getProduct($data->id_order);}],
            ['label'=>'Кол-во', 'value'=> function($data){return Orders::getProductCount($data->id_order);}],
            ['label'=>'Статус', 'value'=> function($data){return Orders::getStatus($data->id_order);}],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_order' => $model->id_order]);
                },
                'template' => '{update}'
            ],
        ],
        ]); 
    ?>

</div>