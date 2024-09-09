<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_chips".
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property string|null $image
 * @property int $status
 * @property int $fk_user
 * @property int $fk_org
 * @property int $fk_table
 * @property int $qty
 * @property string|null $created_date
 * @property string|null $remarks
 *
 * @property Organization $fkOrg
 * @property Tables $fkTable
 * @property User $fkUser
 */
class TableChips extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table_chips';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value', 'status', 'fk_user', 'fk_org', 'fk_table', 'qty'], 'required'],
            [['value'], 'number'],
            [['status', 'fk_user', 'fk_org', 'fk_table', 'qty'], 'integer'],
            [['remarks'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
            [['created_date'], 'string', 'max' => 200],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::class, 'targetAttribute' => ['fk_org' => 'id']],
            [['fk_table'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::class, 'targetAttribute' => ['fk_table' => 'id']],
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
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'fk_user' => Yii::t('app', 'Fk User'),
            'fk_org' => Yii::t('app', 'Fk Org'),
            'fk_table' => Yii::t('app', 'Fk Table'),
            'qty' => Yii::t('app', 'Qty'),
            'created_date' => Yii::t('app', 'Created Date'),
            'remarks' => Yii::t('app', 'Remarks'),
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
     * Gets query for [[FkTable]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTable()
    {
        return $this->hasOne(Tables::class, ['id' => 'fk_table']);
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
