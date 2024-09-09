<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FiscalYear;

/**
 * FiscalYearSearch represents the model behind the search form of `backend\models\FiscalYear`.
 */
class FiscalYearSearch extends FiscalYear
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bill_counter', 'is_closed', 'fk_org'], 'integer'],
            [['year_name', 'start_from', 'end_at', 'created_date'], 'safe'],
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
        $query = FiscalYear::find();

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
            'id' => $this->id,
            'bill_counter' => $this->bill_counter,
            'is_closed' => $this->is_closed,
            'fk_org' => $this->fk_org,
        ]);

        $query->andFilterWhere(['like', 'year_name', $this->year_name])
            ->andFilterWhere(['like', 'start_from', $this->start_from])
            ->andFilterWhere(['like', 'end_at', $this->end_at])
            ->andFilterWhere(['like', 'created_date', $this->created_date]);

        return $dataProvider;
    }
}
