<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */

$this->title = 'Обновить заказ: ' . $model->id_order;

?>
<div class="orders-update">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
