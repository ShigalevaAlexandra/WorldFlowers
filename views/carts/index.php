<?php

use app\models\Carts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Carts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Carts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cart',
            'user_id',
            'product_id',
            'count',
            'order_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Carts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_cart' => $model->id_cart]);
                 }
            ],
        ],
    ]); ?>


</div>
