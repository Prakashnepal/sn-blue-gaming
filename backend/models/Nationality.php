<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nationality".
 *
 * @property int $id
 * @property string $nationality
 * @property int $fk_org
 */
class Nationality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nationality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nationality', 'fk_org'], 'required'],
            [['fk_org'], 'integer'],
            [['nationality'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nationality' => Yii::t('app', 'Nationality'),
            'fk_org' => Yii::t('app', 'Onganization Name'),
        ];
    }
}
