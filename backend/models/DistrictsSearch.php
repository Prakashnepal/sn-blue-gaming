<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Districts;

/**
 * DistrictsSearch represents the model behind the search form of `backend\models\Districts`.
 */
class DistrictsSearch extends Districts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_country', 'fk_province'], 'integer'],
            [['district_nep', 'district_eng'], 'safe'],
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
        $query = Districts::find();

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
            'fk_country' => $this->fk_country,
            'fk_province' => $this->fk_province,
        ]);

        $query->andFilterWhere(['like', 'district_nep', $this->district_nep])
            ->andFilterWhere(['like', 'district_eng', $this->district_eng]);

        return $dataProvider;
    }
}
