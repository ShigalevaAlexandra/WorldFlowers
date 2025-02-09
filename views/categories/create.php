<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */

$this->title = 'Добавить категорию';

?>
<div class="categories-create">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <br><?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
