<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id_order
 * @property string $status
 * @property string|null $reason_cancellation
 * @property string $created_time
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'reason_cancellation'], 'string'],
            [['created_time'], 'required'],
            [['created_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'status' => 'Status',
            'reason_cancellation' => 'Reason Cancellation',
            'created_time' => 'Created Time',
        ];
    }
}
