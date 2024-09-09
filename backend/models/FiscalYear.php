<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fiscal_year".
 *
 * @property int $id
 * @property string $year_name
 * @property string $start_from
 * @property int|null $bill_counter
 * @property string $end_at
 * @property int $is_closed
 * @property int $fk_org
 * @property string $created_date
 *
 * @property Organization $fkOrg
 */
class FiscalYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fiscal_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_name', 'start_from', 'end_at', 'is_closed', 'fk_org', 'created_date'], 'required'],
            [['bill_counter', 'is_closed', 'fk_org'], 'integer'],
            [['year_name', 'start_from', 'end_at', 'created_date'], 'string', 'max' => 255],
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
            'year_name' => Yii::t('app', 'Year Name'),
            'start_from' => Yii::t('app', 'Start From'),
            'bill_counter' => Yii::t('app', 'Bill Counter'),
            'end_at' => Yii::t('app', 'End At'),
            'is_closed' => Yii::t('app', 'Is Closed'),
            'fk_org' => Yii::t('app', 'Fk Org'),
            'created_date' => Yii::t('app', 'Created Date'),
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
}
