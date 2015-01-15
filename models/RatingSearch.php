<?php

namespace istt\bizgod\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\Rating;

/**
 * RatingSearch represents the model behind the search form about `app\models\Rating`.
 */
class RatingSearch extends Rating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rating_type', 'customer_id', 'supplier_id', 'score'], 'integer'],
            [['comment', 'date'], 'safe'],
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
        $query = Rating::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'rating_type' => $this->rating_type,
            'customer_id' => $this->customer_id,
            'supplier_id' => $this->supplier_id,
            'score' => $this->score,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
