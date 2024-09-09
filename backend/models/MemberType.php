<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "member_type".
 *
 * @property int $id
 * @property string $type
 * @property int $fk_org
 *
 * @property Organization $fkOrg
 * @property Members[] $members
 */
class MemberType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'fk_org'], 'required'],
            [['fk_org'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['fk_org' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'fk_org' => Yii::t('app', 'Fk Org'),
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
     * Gets query for [[Members]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Members::className(), ['fk_type' => 'id']);
    }
}
