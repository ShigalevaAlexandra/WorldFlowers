<?php

namespace app\models;

use \yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id_product
 * @property string $photo
 * @property string $name
 * @property int $price
 * @property string $country_origin
 * @property int $category_id
 * @property string $color
 * @property int $count
 *
 * @property Carts[] $carts
 * @property Categories $category
 */
class Products extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo', 'name', 'price', 'country_origin', 'category_id', 'color', 'count'], 'required'],
            [['price', 'category_id', 'count'], 'integer'],
            [['photo', 'name', 'country_origin', 'color'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'photo' => 'Photo',
            'name' => 'Name',
            'price' => 'Price',
            'country_origin' => 'Country Origin',
            'category_id' => 'Category ID',
            'color' => 'Color',
            'count' => 'Count',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Carts::class, ['product_id' => 'id_product']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id_category' => 'category_id']);
    }
}