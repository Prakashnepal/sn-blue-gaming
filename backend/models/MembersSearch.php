<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Members;

/**
 * MembersSearch represents the model behind the search form of `backend\models\Members`.
 */
class MembersSearch extends Members {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'fk_city', 'status', 'card_print_count', 'fk_org', 'fk_type', 'created_by', 'fk_nationality'], 'integer'],
            [['name', 'phone', 'email', 'idendity_no', 'idendity_doc', 'address', 'card_no', 'created_date', 'update_date', 'image', 'remarks', 'member_year', 'dob', 'fdate', 'ldate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $helper = new \backend\controllers\Helper();
        $query = Members::find()->where(['fk_org' => $helper->getActiveOrganization()]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>50,
            ],
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
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
            'fk_nationality' => $this->fk_nationality,
            'fk_province' => $this->fk_province,
            'fk_district' => $this->fk_district,
            'fk_municipal' => $this->fk_municipal,
            'fk_city' => $this->fk_city,
            'status' => $this->status,
            'card_print_count' => $this->card_print_count,
            'fk_org' => $this->fk_org,
            'fk_type' => $this->fk_type,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'idendity_no', $this->idendity_no])
                ->andFilterWhere(['like', 'idendity_doc', $this->idendity_doc])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'card_no', $this->card_no])
                ->andFilterWhere(['like', 'created_date', $this->created_date])
                ->andFilterWhere(['like', 'update_date', $this->update_date])
                ->andFilterWhere(['like', 'image', $this->image])
                ->andFilterWhere(['like', 'remarks', $this->remarks])
                ->andFilterWhere(['like', 'member_year', $this->member_year])
                ->andFilterWhere(['like', 'dob', $this->dob]);

        return $dataProvider;
    }

}
