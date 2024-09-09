<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property int $id
 * @property int $fk_country
 * @property int $fk_province
 * @property string|null $district_nep
 * @property string $district_eng
 *
 * @property Country $fkCountry
 * @property Province $fkProvince
 * @property Municipals[] $municipals
 * @property Organization[] $organizations
 * @property Suppliers[] $suppliers
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_country', 'fk_province', 'district_eng'], 'required'],
            [['fk_country', 'fk_province'], 'integer'],
            [['district_nep', 'district_eng'], 'string', 'max' => 255],
            [['district_eng'],'unique'],
            [['fk_country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_country' => 'id']],
            [['fk_province'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['fk_province' => 'id']],
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
            'fk_province' => Yii::t('app', 'Province/State'),
            'district_nep' => Yii::t('app', 'Name In Nepali'),
            'district_eng' => Yii::t('app', 'Name In English'),
        ];
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
     * Gets query for [[FkProvince]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'fk_province']);
    }

    /**
     * Gets query for [[Municipals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipals()
    {
        return $this->hasMany(Municipals::className(), ['fk_district' => 'id']);
    }

    /**
     * Gets query for [[Organizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['fk_district' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['fk_district' => 'id']);
    }
}
