<?php

namespace istt\bizgod\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'category_id', 'order_status', 'order_type', 'billing_type', 'delivery_type'], 'integer'],
            [['order_name', 'order_description', 'unit', 'rfp_attach', 'product_image', 'order_date', 'due_date', 'delivery_address'], 'safe'],
            [['quantity', 'budget'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'category_id' => $this->category_id,
            'order_status' => $this->order_status,
            'quantity' => $this->quantity,
            'order_type' => $this->order_type,
            'budget' => $this->budget,
            'order_date' => $this->order_date,
            'due_date' => $this->due_date,
            'billing_type' => $this->billing_type,
            'delivery_type' => $this->delivery_type,
        ]);

        $query->andFilterWhere(['like', 'order_name', $this->order_name])
            ->andFilterWhere(['like', 'order_description', $this->order_description])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'rfp_attach', $this->rfp_attach])
            ->andFilterWhere(['like', 'product_image', $this->product_image])
            ->andFilterWhere(['like', 'delivery_address', $this->delivery_address]);

        return $dataProvider;
    }
}
