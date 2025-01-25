<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carts $model */

$this->title = 'Update Carts: ' . $model->id_cart;
$this->params['breadcrumbs'][] = ['label' => 'Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cart, 'url' => ['view', 'id_cart' => $model->id_cart]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
