<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property int $fk_org
 * @property int $fk_member
 * @property string $date
 * @property string $time
 * @property int $status
 * @property int $created_by
 * @property string|null $purpose
 * @property string|null $remarks
 *
 * @property User $createdBy
 * @property Members $fkMember
 * @property Organization $fkOrg
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public $card_no;
    public function rules()
    {
        return [
            [['fk_org', 'fk_member', 'date', 'time', 'status', 'created_by'], 'required'],
            [['fk_org', 'fk_member', 'status', 'created_by'], 'integer'],
            [['purpose', 'remarks'], 'string'],
            [['date', 'time','card_no'], 'string', 'max' => 255],
            [['fk_member'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['fk_member' => 'id']],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['fk_org' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fk_org' => Yii::t('app', 'Organization Name'),
            'fk_member' => Yii::t('app', 'Member Name'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'purpose' => Yii::t('app', 'Purpose'),
            'remarks' => Yii::t('app', 'Remarks'),
            'card_no'=>Yii::t('app','Card No')
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[FkMember]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkMember()
    {
        return $this->hasOne(Members::className(), ['id' => 'fk_member']);
    }

    /**
     * Gets query for [[FkOrg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkOrg()
    {
        return $this->hasOne(Organization::className(), ['id' => 'fk_org']);
    }
}
