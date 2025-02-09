<?php

namespace app\models;

use \yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "carts".
 *
 * @property int $id_cart
 * @property int $user_id
 * @property int $product_id
 * @property int $count
 * @property int $order_id
 *
 * @property Orders $order
 * @property Products $product
 * @property Users $user
 */
class Carts extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'count'], 'required'],
            [['user_id', 'product_id', 'count', 'order_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id_product']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cart' => 'Id Cart',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'count' => 'Count',
            'order_id' => 'Номер'
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id_product' => 'product_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id_user' => 'user_id']);
    }
}
