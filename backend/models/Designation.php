<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "designation".
 *
 * @property int $id
 * @property string $name
 * @property int $fk_org
 */
class Designation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'designation';
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
}
