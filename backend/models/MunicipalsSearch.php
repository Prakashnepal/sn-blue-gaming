<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Municipals;

/**
 * MunicipalsSearch represents the model behind the search form of `backend\models\Municipals`.
 */
class MunicipalsSearch extends Municipals
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_country', 'fk_province', 'fk_district'], 'integer'],
            [['mun_nep', 'mun_eng'], 'safe'],
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
        $query = Municipals::find();

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
            'fk_district' => $this->fk_district,
        ]);

        $query->andFilterWhere(['like', 'mun_nep', $this->mun_nep])
            ->andFilterWhere(['like', 'mun_eng', $this->mun_eng]);

        return $dataProvider;
    }
}
