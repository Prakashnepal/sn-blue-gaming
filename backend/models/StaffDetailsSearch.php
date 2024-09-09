<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StaffDetails;

/**
 * StaffDetailsSearch represents the model behind the search form of `backend\models\StaffDetails`.
 */
class StaffDetailsSearch extends StaffDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_department', 'fk_designation', 'fk_org', 'fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'status', 'ward_no', 'emp_id'], 'integer'],
            [['name', 'image', 'contact_no', 'sign', 'dob', 'citizenship_doc', 'id_card_no', 'blood_group','guardian_name','guardian_contact'], 'safe'],
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
        $query = StaffDetails::find();

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
            'fk_department' => $this->fk_department,
            'fk_designation' => $this->fk_designation,
            'fk_org' => $this->fk_org,
            'fk_country' => $this->fk_country,
            'fk_province' => $this->fk_province,
            'fk_district' => $this->fk_district,
            'fk_municipal' => $this->fk_municipal,
            'blood_group'=>$this->blood_group,
            'guardian_name'=> $this->guardian_name,
            'guardian_contact'=> $this->guardian_contact,
            'status' => $this->status,
            'ward_no' => $this->ward_no,
            'emp_id' => $this->emp_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'sign', $this->sign])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'citizenship_doc', $this->citizenship_doc])
            ->andFilterWhere(['like', 'id_card_no', $this->id_card_no]);

        return $dataProvider;
    }
}
