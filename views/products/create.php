<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = 'Добавить товар';

?>
<br>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1><br><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
