<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $manage_sign
 * @property string $manager
 * @property int $fk_type
 * @property int $fk_org
 * @property int $fk_user
 * @property string $created_date
 * @property string|null $remarks
 * @property int $status
 *
 * @property Organization $fkOrg
 * @property CounterType $fkType
 * @property User $fkUser
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'fk_type', 'fk_org', 'fk_user', 'created_date', 'status'], 'required'],
            [['fk_type', 'fk_org', 'fk_user', 'status'], 'integer'],
            [['remarks'], 'string'],
            [['name', 'created_date','manager','manager_sign'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 222],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['fk_org' => 'id']],
            [['fk_type'], 'exist', 'skipOnError' => true, 'targetClass' => CounterType::className(), 'targetAttribute' => ['fk_type' => 'id']],
            [['fk_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'fk_type' => Yii::t('app', 'Type'),
            'fk_org' => Yii::t('app', 'Organization'),
            'fk_user' => Yii::t('app', 'User'),
            'created_date' => Yii::t('app', 'Created Date'),
            'remarks' => Yii::t('app', 'Remarks'),
            'status' => Yii::t('app', 'Status'),
            'manager' => Yii::t('app', 'manager'),
            'manager_sign' => Yii::t('app', 'Supervisor'),
        ];
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

    /**
     * Gets query for [[FkType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkType()
    {
        return $this->hasOne(CounterType::className(), ['id' => 'fk_type']);
    }

    /**
     * Gets query for [[FkUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_user']);
    }
    // $id is counter ID
 
}
