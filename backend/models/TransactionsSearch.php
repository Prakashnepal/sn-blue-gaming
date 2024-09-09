<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Transactions;

/**
 * TransactionsSearch represents the model behind the search form of `backend\models\Transactions`.
 */
class TransactionsSearch extends Transactions
{
    /**
     * {@inheritdoc}
     */
    public $card_no;
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'fk_org', 'fk_member', 'status', 'created_by'], 'integer'],
            [['date', 'time', 'purpose', 'remarks','card_no','globalSearch'], 'safe'],
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
        $helper = new \backend\controllers\Helper();
        $query = Transactions::find();
       
        $query ->where(['fk_org'=>$helper->getActiveOrganization()]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'fk_org' => $this->fk_org,
           // 'fk_member' => $this->fk_member,
            'status' => $this->status,
            'created_by' => $this->created_by,
        ]);
         $query->andFilterWhere([
            'or',
            ['like', 'card_no' , $this->globalSearch],
            
        ]); 

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
        ->andFilterWhere(['like', 'fk_member', $this->fk_member]);

        return $dataProvider;
    }
}
