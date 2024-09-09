<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "points".
 *
 * @property int $id
 * @property int $fk_org
 * @property int $fk_user
 * @property int $fk_member
 * @property int $fk_counter
 * @property string $date
 * @property string $time
 * @property string $points
 * @property string $points_action
 * @property string|null $remarks
 * @property string|null $net_points
 */
class Points extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'points';
    }

    /**
     * {@inheritdoc}
     */
   
    public function rules()
    {
        return [
            [['fk_org','fk_counter', 'fk_user', 'fk_member', 'date', 'time', 'points', 'points_action','net_points'], 'required'],
            [['fk_org', 'fk_user', 'fk_member','fk_counter'], 'integer'],
            [['remarks','net_points'], 'string'],
            [['date', 'time', 'points_action'], 'string', 'max' => 100],
            [['points'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fk_org' => Yii::t('app', 'Organization'),
            'fk_user' => Yii::t('app', 'User'),
            'fk_member' => Yii::t('app', 'Member'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
            'points' => Yii::t('app', 'Points'),
            'points_action' => Yii::t('app', 'Points Action'),
            'remarks' => Yii::t('app', 'Message'),
            'net_points' => Yii::t('app', 'T.Type'),
             'fk_counter' => Yii::t('app', 'Transaction Counter'),
        ];
    }
}
