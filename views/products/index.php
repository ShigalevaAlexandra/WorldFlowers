<?php

use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог';

?>
<div class="products-index">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <p>
        <br><?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_product',
            ['attribute' => 'Категория', 'value' => function($data) { return $data -> getCategory() -> One() -> name; }],
            'name',
            ['attribute' => 'Фото', 'format' => 'html', 'value' => function($data) { return "<img src='web/{$data -> photo}' alt='photo' style='width:70px;'>";}],
            'color',
            'country_origin',
            'price',
            //'category_id',
            'count',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Products $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_product' => $model->id_product]);
                },
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
