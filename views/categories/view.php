<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */

$this->title = $model->name;

\yii\web\YiiAsset::register($this);
?>
<div class="categories-view">

    <br><br><h1><?= Html::encode($this->title) ?></h1>

    <p>
        <br><?= Html::a('Изменить', ['update', 'id_category' => $model->id_category], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id_category' => $model->id_category], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_category',
            'name',
        ],
    ]) ?>

</div>
