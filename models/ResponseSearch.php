<?php

namespace istt\bizgod\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\Response;

/**
 * ResponseSearch represents the model behind the search form about `app\models\Response`.
 */
class ResponseSearch extends Response
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'invite_id', 'supplier_id', 'response_type'], 'integer'],
            [['response_date', 'response_data'], 'safe'],
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
        $query = Response::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'invite_id' => $this->invite_id,
            'supplier_id' => $this->supplier_id,
            'response_date' => $this->response_date,
            'response_type' => $this->response_type,
        ]);

        $query->andFilterWhere(['like', 'response_data', $this->response_data]);

        return $dataProvider;
    }
}
