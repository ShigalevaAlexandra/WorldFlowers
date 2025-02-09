<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */

$this->title = 'Обновить категорию: ' . $model->name;

?>
<div class="categories-update">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <br><?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
