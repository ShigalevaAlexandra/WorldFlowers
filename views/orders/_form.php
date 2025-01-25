<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Новый' => 'Новый', 'Подтвержден' => 'Подтвержден', 'Отменен' => 'Отменен', ], ['prompt' => '']) ?>

    <?= $form->field($model, ' reason_cancellation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
