<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property int $id
 *  @property int $member_card_print_count
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $idendity_no
 * @property string|null $idendity_doc
 * @property int|null $fk_country
 * 
 * @property int|null $fk_province
 * @property int|null $fk_district
 * 
 * @property int|null $fk_municipal
 * @property int|null $fk_city
 * @property string|null $address
 * @property string $card_no
 * @property int $status
 * @property string $created_date
 * @property string|null $update_date
 * @property int|null $card_print_count
 * @property int $fk_org
 * @property int $fk_type
 * @property string|null $image
 * @property string|null $remarks
 * @property int|null $created_by
 * @property string|null $member_year
 * @property string $dob
 *
 * @property Cities $fkCity
 * @property Country $fkCountry
 * @property Districts $fkDistrict
 * @property Municipals $fkMunicipal
 * @property Organization $fkOrg
 * @property Province $fkProvince
 * @property MemberType $fkType
 */
class Members extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'members';
    }

    /**
     * {@inheritdoc}
     */
    public $ImageFile;
    public $IdendityDoc;
    public $IdendityDocBack;
    public $photo_from_camera;

    public function rules() {
        return [
            [['ImageFile', 'IdendityDoc','IdendityDocBack'], 'file', 'extensions' => 'jpg,png,jpeg'],
            [['name', 'idendity_no', 'card_no', 'status', 'created_date', 'fk_org', 'fk_type','fk_nationality'], 'required'],
            [['fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'fk_city', 'status', 'card_print_count', 'fk_org', 'fk_type', 'created_by', 'fk_nationality','member_card_print_count'], 'integer'],
            [['address', 'remarks','photo_from_camera'], 'string'],
            [['name', 'phone', 'email', 'idendity_no', 'idendity_doc', 'created_date', 'update_date', 'image', 'member_year', 'dob'], 'string', 'max' => 255],
            [['card_no'], 'string', 'max' => 500],
            [['fk_city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['fk_city' => 'id']],
            [['fk_nationality'], 'exist', 'skipOnError' => true, 'targetClass' => Nationality::className(), 'targetAttribute' => ['fk_nationality' => 'id']],
            [['fk_country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_country' => 'id']],
            [['fk_district'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['fk_district' => 'id']],
            [['fk_municipal'], 'exist', 'skipOnError' => true, 'targetClass' => Municipals::className(), 'targetAttribute' => ['fk_municipal' => 'id']],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['fk_org' => 'id']],
            [['fk_province'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['fk_province' => 'id']],
            [['fk_type'], 'exist', 'skipOnError' => true, 'targetClass' => MemberType::className(), 'targetAttribute' => ['fk_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Ph.No.'),
            'email' => Yii::t('app', 'Email'),
            'idendity_no' => Yii::t('app', 'ID No'),
            'idendity_doc' => Yii::t('app', 'ID FILE'),
            'fk_country' => Yii::t('app', 'Country'),
            'fk_province' => Yii::t('app', 'Province'),
            'fk_district' => Yii::t('app', 'District'),
            'fk_municipal' => Yii::t('app', 'Municipal'),
            'fk_city' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'card_no' => Yii::t('app', 'Card No'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'update_date' => Yii::t('app', 'Update Date'),
            'card_print_count' => Yii::t('app', 'MembershipNo'),
            'fk_org' => Yii::t('app', 'Organization'),
            'fk_type' => Yii::t('app', 'Type'),
            'image' => Yii::t('app', 'Image'),
            'remarks' => Yii::t('app', 'Remarks'),
            'created_by' => Yii::t('app', 'Created By'),
            'member_year' => Yii::t('app', 'member_year'),
            'IdendityDoc' => Yii::t('app', 'ID-Card Front'),
            'IdendityDocBack' => Yii::t('app', 'ID-Card Back'),
            'ImageFile' => Yii::t('app', 'PP-Size Photo'),
            'dob' => Yii::t('app', 'DOB'),
            'member_card_print_count' => Yii::t('app', 'Smart Card print Count'),
        ];
    }

    /**
     * Gets query for [[FkCity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCity() {
        return $this->hasOne(Cities::className(), ['id' => 'fk_city']);
    }

    /**
     * Gets query for [[FkCountry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCountry() {
        return $this->hasOne(Country::className(), ['id' => 'fk_country']);
    }
     public function getFkNationality() {
        return $this->hasOne(Nationality::className(), ['id' => 'fk_nationality']);
    }

    /**
     * Gets query for [[FkDistrict]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDistrict() {
        return $this->hasOne(Districts::className(), ['id' => 'fk_district']);
    }

    /**
     * Gets query for [[FkMunicipal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkMunicipal() {
        return $this->hasOne(Municipals::className(), ['id' => 'fk_municipal']);
    }

    /**
     * Gets query for [[FkOrg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkOrg() {
        return $this->hasOne(Organization::className(), ['id' => 'fk_org']);
    }

    /**
     * Gets query for [[FkProvince]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkProvince() {
        return $this->hasOne(Province::className(), ['id' => 'fk_province']);
    }

    /**
     * Gets query for [[FkType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkType() {
        return $this->hasOne(MemberType::className(), ['id' => 'fk_type']);
    }

    public function uploadImage($path) {

        $file = $path . uniqid() . '.' . $this->ImageFile->extension;
        if ($this->ImageFile->saveAs($file, false)) {
            // var_dump($file);die;
            $this->image = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadIdendityDoc($path1) {
        $file = $path1 . uniqid() . '.' . $this->IdendityDoc->extension;
        if ($this->IdendityDoc->saveAs($file, false)) {
            $this->idendity_doc = $file;
            return true;
        } else {
            return false;
        }
    }
    
    public function uploadIdendityDocBack($path1) {
        $file = $path1 . uniqid() . '.' . $this->IdendityDocBack->extension;
        if ($this->IdendityDocBack->saveAs($file, false)) {
            $this->update_date = $file;
            return true;
        } else {
            return false;
        }
    }

    public function generateCardNo() {
        $helper = new \backend\controllers\Helper();
        $memberNo = null;
        $member = Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->max('card_print_count');
        $nextMemberno = $member + 1;

        $memberData = Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['card_print_count' => $member])->one();
        if (empty($memberData->card_print_count)) {
            $memberNo = str_pad(1, 6, "0", STR_PAD_LEFT);
        } else {
            $memberNo = str_pad($nextMemberno, 6, "0", STR_PAD_LEFT);
        }
        $this->card_print_count = $memberNo;
        $Org_val = str_pad($helper->getActiveOrganization(), 2, "0", STR_PAD_LEFT);
        $cardno = $Org_val . date("y") . $memberNo;
        $this->card_no = $cardno;
    }

}
