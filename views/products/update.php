<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = 'Обновление продукта: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_product' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

    <br><br><h1><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
