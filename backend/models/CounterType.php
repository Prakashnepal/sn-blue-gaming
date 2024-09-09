<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "counter_type".
 *
 * @property int $id
 * @property string $type
 * @property string|null $remarks
 * @property string $created_at
 * @property int|null $created_by
 * @property int $fk_org
 *
 * @property Counter[] $counters
 */
class CounterType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counter_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'created_at', 'fk_org'], 'required'],
            [['remarks'], 'string'],
            [['created_by', 'fk_org'], 'integer'],
            [['type', 'created_at'], 'string', 'max' => 255],
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
            'remarks' => Yii::t('app', 'Remarks'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'fk_org' => Yii::t('app', 'Fk Org'),
        ];
    }

    /**
     * Gets query for [[Counters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCounters()
    {
        return $this->hasMany(Counter::className(), ['fk_type' => 'id']);
    }
}
