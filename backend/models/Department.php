<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $name
 * @property int $fk_org
 *
 * @property StaffDetails[] $staffDetails
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'fk_org'], 'required'],
            [['fk_org'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'fk_org' => Yii::t('app', 'Fk Org'),
        ];
    }

    /**
     * Gets query for [[StaffDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaffDetails()
    {
        return $this->hasMany(StaffDetails::className(), ['fk_department' => 'id']);
    }
}
