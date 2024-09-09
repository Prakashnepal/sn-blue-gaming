<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property int $id
 * @property int $fk_country
 * @property string|null $name_nep
 * @property string $name_eng
 *
 * @property Districts[] $districts
 * @property Country $fkCountry
 * @property Municipals[] $municipals
 * @property Organization[] $organizations
 * @property Suppliers[] $suppliers
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_country', 'name_eng'], 'required'],
            [['fk_country'], 'integer'],
            [['name_eng'],'unique'],
            [['name_nep', 'name_eng'], 'string', 'max' => 255],
            [['fk_country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_country' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fk_country' => Yii::t('app', 'Country'),
            'name_nep' => Yii::t('app', 'Name In Nepali'),
            'name_eng' => Yii::t('app', 'Name In English'),
        ];
    }

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(Districts::className(), ['fk_province' => 'id']);
    }

    /**
     * Gets query for [[FkCountry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'fk_country']);
    }

    /**
     * Gets query for [[Municipals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipals()
    {
        return $this->hasMany(Municipals::className(), ['fk_province' => 'id']);
    }

    /**
     * Gets query for [[Organizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['fk_province' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['fk_province' => 'id']);
    }
}
