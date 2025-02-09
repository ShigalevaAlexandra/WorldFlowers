<?php

namespace app\models;

use \yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id_category
 * @property string $name
 *
 * @property Products[] $products
 */
class Categories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'ID',
            'name' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['category_id' => 'id_category']);
    }
}
