<?php

namespace istt\bizgod\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\Po;

/**
 * PoSearch represents the model behind the search form about `app\models\Po`.
 */
class PoSearch extends Po
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'customer_id', 'supplier_id', 'po_status', 'billing_type', 'delivery_type', 'invite_id'], 'integer'],
            [['unit', 'delivery_date'], 'safe'],
            [['quantity', 'price'], 'number'],
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
        $query = Po::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'customer_id' => $this->customer_id,
            'supplier_id' => $this->supplier_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'po_status' => $this->po_status,
            'billing_type' => $this->billing_type,
            'delivery_type' => $this->delivery_type,
            'invite_id' => $this->invite_id,
            'delivery_date' => $this->delivery_date,
        ]);

        $query->andFilterWhere(['like', 'unit', $this->unit]);

        return $dataProvider;
    }
}
