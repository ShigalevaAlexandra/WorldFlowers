<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carts;

/**
 * CartsSearch represents the model behind the search form of `app\models\Carts`.
 */
class CartsSearch extends Carts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cart', 'user_id', 'product_id', 'count', 'order_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Carts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_cart' => $this->id_cart,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'count' => $this->count,
            'order_id' => $this->order_id,
        ]);

        return $dataProvider;
    }
}