<?php

namespace istt\bizgod\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\CategoryRegister;

/**
 * CategoryRegisterSearch represents the model behind the search form about `app\models\CategoryRegister`.
 */
class CategoryRegisterSearch extends CategoryRegister
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'category_id'], 'integer'],
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
        $query = CategoryRegister::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'supplier_id' => $this->supplier_id,
            'category_id' => $this->category_id,
        ]);

        return $dataProvider;
    }
}
