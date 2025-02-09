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
 * 
 * @property Carts[] $carts
 * 
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
            'id_order' => 'Номер',
            'status' => 'Статус',
            'reason_cancellation' => 'Причина отмены',
            'created_time' => 'Время создания',
        ];
    }

      /**
     * Gets query for [[Cart]].
     *
     * @return \yii\db\ActiveQuery
     */

    public static function getTimestamp($id_order)
    {
        $model = Orders::find()->where(['id_order' => $id_order])->one();

        if(!empty($model)) {
            return $model->created_time;
        }
    }

    public static function getStatus($id_order)
    {
        $model = Orders::find()->where(['id_order' => $id_order])->one();

        if(!empty($model)) {
            return $model->status;
        }
    }

    public static function getFIO($id_order)
    {
        $model = Orders::find()->where(['id_order' => $id_order])->one();

        if(!empty($model)) {
            $cart = Carts::find()->where(['order_id' => $id_order])->one();

            if(!empty($cart)) {
                $user = Users::find()->where(['id_user' => $cart->user_id])->one();

                if(!empty($cart)) {
                    $fio = $user['name'].' '.$user['surname'].' '.$user['patronymic'];
                    return $fio;
                }
            }
        }
    }

    public static function getProduct($id_order)
    {
        $model = Orders::find()->where(['id_order' => $id_order])->one();

        if(!empty($model)) {
            $cart = Carts::find()->where(['order_id' => $id_order])->one();

            if(!empty($cart)) {
                $product = Products::find()->where(['id_product' => $cart->product_id])->one();

                if(!empty($cart)) {
                    return $product->name;
                }
            }
        }
    }

    public static function getProductCount($id_order)
    {
        $model = Orders::find()->where(['id_order' => $id_order])->one();

        if(!empty($model)) {
            $cart = Carts::find()->where(['order_id' => $id_order])->one();

            if(!empty($cart)) {
                return $cart->count;
            }
        }
    }
}
