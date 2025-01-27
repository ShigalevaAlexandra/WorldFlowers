<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Users $model */

$this->title = 'Регистрация';
?>
<div class="users-create">

    <br><br><h1><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
