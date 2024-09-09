<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "municipals".
 *
 * @property int $id
 * @property int $fk_country
 * @property int $fk_province
 * @property int $fk_district
 * @property string|null $mun_nep
 * @property string $mun_eng
 *
 * @property Country $fkCountry
 * @property Districts $fkDistrict
 * @property Province $fkProvince
 * @property Organization[] $organizations
 * @property Suppliers[] $suppliers
 */
class Municipals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_country', 'fk_province', 'fk_district', 'mun_eng'], 'required'],
            [['fk_country', 'fk_province', 'fk_district'], 'integer'],
            [['mun_nep', 'mun_eng'], 'string', 'max' => 255],
            [['mun_eng'],'unique'],
            [['fk_country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_country' => 'id']],
            [['fk_district'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['fk_district' => 'id']],
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
            'fk_district' => Yii::t('app', 'District'),
            'mun_nep' => Yii::t('app', 'Name In Nepali'),
            'mun_eng' => Yii::t('app', 'Name In English'),
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
     * Gets query for [[FkDistrict]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'fk_district']);
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
     * Gets query for [[Organizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['fk_municipal' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['fk_municipal' => 'id']);
    }
}
