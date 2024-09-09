<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ccchips".
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property int $fk_user
 * @property int $fk_org
 * @property string $remarks
 * @property int $qty
 *
 * @property Organization $fkOrg
 * @property User $fkUser
 */
class Ccchips extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ccchips';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value', 'fk_user', 'fk_org', 'remarks', 'qty'], 'required'],
            [['value'], 'number'],
            [['fk_user', 'fk_org', 'qty'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['remarks'], 'string', 'max' => 255],
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
            'value' => Yii::t('app', 'Value'),
            'fk_user' => Yii::t('app', 'User'),
            'fk_org' => Yii::t('app', 'Organization'),
            'remarks' => Yii::t('app', 'Remarks'),
            'qty' => Yii::t('app', 'Quantity'),
        ];
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
