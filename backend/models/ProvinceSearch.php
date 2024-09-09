<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Province;

/**
 * ProvinceSearch represents the model behind the search form of `backend\models\Province`.
 */
class ProvinceSearch extends Province
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name_nep', 'name_eng','fk_country'], 'safe'],
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
        $query = Province::find();
//          $query->joinWith(['fkCountry']);
        //  $query->joinWith(['fkCountry']);
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
            //'fk_country' => $this->fk_country,
        ]);

        $query->andFilterWhere(['like', 'name_nep', $this->name_nep])
            ->andFilterWhere(['like', 'name_eng', $this->name_eng]);
           // ->andWhere(['like','country.country_name', $this->fk_country]);

        return $dataProvider;
    }
}
