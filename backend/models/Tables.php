<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property float $value
 * @property int $fk_counter
 * @property int $fk_user
 * @property int $fk_org
 * @property int $status
 * @property string $remarks
 *
 * @property Counter $fkCounter
 * @property Organization $fkOrg
 * @property User $fkUser
 */
class Tables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'value', 'fk_counter', 'fk_user', 'fk_org', 'status', 'remarks'], 'required'],
            [['value'], 'number'],
            [['fk_counter', 'fk_user', 'fk_org', 'status'], 'integer'],
            [['remarks'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 100],
            [['fk_counter'], 'exist', 'skipOnError' => true, 'targetClass' => Counter::class, 'targetAttribute' => ['fk_counter' => 'id']],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::class, 'targetAttribute' => ['fk_org' => 'id']],
            [['fk_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['fk_user' => 'id']],
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
            'value' => Yii::t('app', 'Value'),
            'fk_counter' => Yii::t('app', 'Fk Counter'),
            'fk_user' => Yii::t('app', 'Fk User'),
            'fk_org' => Yii::t('app', 'Fk Org'),
            'status' => Yii::t('app', 'Status'),
            'remarks' => Yii::t('app', 'Remarks'),
        ];
    }

    /**
     * Gets query for [[FkCounter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCounter()
    {
        return $this->hasOne(Counter::class, ['id' => 'fk_counter']);
    }

    /**
     * Gets query for [[FkOrg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkOrg()
    {
        return $this->hasOne(Organization::class, ['id' => 'fk_org']);
    }

    /**
     * Gets query for [[FkUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(User::class, ['id' => 'fk_user']);
    }
}
