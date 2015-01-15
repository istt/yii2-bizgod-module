<?php

namespace istt\bizgod\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\Invite;

/**
 * InviteSearch represents the model behind the search form about `app\models\Invite`.
 */
class InviteSearch extends Invite
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'invite_type', 'supplier_id', 'status'], 'integer'],
            [['date', 'data_msg'], 'safe'],
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
        $query = Invite::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'invite_type' => $this->invite_type,
            'supplier_id' => $this->supplier_id,
            'date' => $this->date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'data_msg', $this->data_msg]);

        return $dataProvider;
    }
}
