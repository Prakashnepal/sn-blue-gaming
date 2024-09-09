<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Organization;

/**
 * OrganizationSearch represents the model behind the search form of `backend\models\Organization`.
 */
class OrganizationSearch extends Organization
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'fk_city', 'fk_user', 'ward', 'last_updated_by', 'status'], 'integer'],
            [['username', 'password', 'email', 'name', 'weblink', 'landline', 'contact_person_name', 'contact_person_email', 'contact_person_mobile', 'logo', 'pan_vat', 'certificate', 'silver_front', 'silver_back', 'gold_front', 'gold_back', 'created_date', 'updated_date', 'pin', 'black_front', 'black_back'], 'safe'],
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
        $query = Organization::find();

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
            'fk_municipal' => $this->fk_municipal,
            'fk_city' => $this->fk_city,
            'fk_user' => $this->fk_user,
            'ward' => $this->ward,
            'last_updated_by' => $this->last_updated_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'weblink', $this->weblink])
            ->andFilterWhere(['like', 'landline', $this->landline])
            ->andFilterWhere(['like', 'contact_person_name', $this->contact_person_name])
            ->andFilterWhere(['like', 'contact_person_email', $this->contact_person_email])
            ->andFilterWhere(['like', 'contact_person_mobile', $this->contact_person_mobile])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'pan_vat', $this->pan_vat])
            ->andFilterWhere(['like', 'certificate', $this->certificate])
            ->andFilterWhere(['like', 'silver_front', $this->silver_front])
            ->andFilterWhere(['like', 'silver_back', $this->silver_back])
            ->andFilterWhere(['like', 'gold_front', $this->gold_front])
            ->andFilterWhere(['like', 'gold_back', $this->gold_back])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'updated_date', $this->updated_date])
            ->andFilterWhere(['like', 'pin', $this->pin])
            ->andFilterWhere(['like', 'black_front', $this->black_front])
            ->andFilterWhere(['like', 'black_back', $this->black_back]);

        return $dataProvider;
    }
}
