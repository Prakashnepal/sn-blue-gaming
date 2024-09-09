<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 
 * @property string $name
 * @property string|null $weblink
 * @property string|null $landline
 * @property string|null $contact_person_name
 * @property string|null $contact_person_email
 * @property string|null $contact_person_mobile
 * @property string|null $logo
 * @property string|null $pan_vat
 * @property string|null $certificate
 * @property string|null $silver_front
 * @property string|null $silver_back
 * @property string|null $gold_front
 * @property string|null $gold_back
 * @property string|null $white_front
 * @property string|null $white_back
 * @property int $fk_country
 * @property int $fk_province
 * @property int $fk_district
 * @property int $fk_municipal
 * @property int|null $fk_city
 * @property int $fk_user
 * @property int|null $ward
 * @property string $created_date
 * @property string|null $updated_date
 * @property int|null $last_updated_by
 * @property int $status
 * @property string|null $pin
 * @property BsHead[] $bsHeads
 * @property BsSubHead[] $bsSubHeads
 * @property FiscalYear[] $fiscalYears
 * @property Cities $fkCity
 * @property Country $fkCountry
 * @property Districts $fkDistrict
 * @property Municipals $fkMunicipal
 * @property Province $fkProvince
 * @property LedgerGroup[] $ledgerGroups
 * @property Ledger[] $ledgers
 * @property MemberType[] $memberTypes
 * @property Members[] $members
 */
class Organization extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public $LogoFile;
    public $SilverBack;
    public $CertificateFile;
    public $SilverFront;
    public $BlackBack;
    public $BlackFront;
    public $GoldenBack;
    public $GoldenFront;
    public $WhiteBack;
    public $WhiteFront;
    public $tempID;
    public $staffID;

    public function rules() {
        return [
            [['name', 'fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'created_date', 'status'], 'required'],
            [['fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'fk_city', 'fk_user', 'ward', 'last_updated_by', 'status','tempID'], 'integer'],
            [['name', 'contact_person_name', 'contact_person_email', 'logo', 'black_front', 'black_back','username','password','email','staff_id'], 'string', 'max' => 500],
            [['weblink', 'landline', 'contact_person_mobile', 'pan_vat', 'certificate', 'silver_front', 'silver_back', 'gold_front', 'gold_back','created_date', 'updated_date', 'pin'], 'string', 'max' => 255],
            [['fk_city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['fk_city' => 'id']],
            [['fk_country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_country' => 'id']],
            [['fk_district'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['fk_district' => 'id']],
            [['fk_municipal'], 'exist', 'skipOnError' => true, 'targetClass' => Municipals::className(), 'targetAttribute' => ['fk_municipal' => 'id']],
            [['fk_province'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['fk_province' => 'id']],
//        [['logoFile','silverBack','certificateFile','silverFront','blackBack','blackFront','goldenBack','goldenFront'],'safe'],
            [['SilverBack'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['LogoFile'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['GoldenBack'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['GoldenFront'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['SilverBack'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['BlackFront'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['BlackBack'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['WhiteBack'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['WhiteFront'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['staffID'], 'file', 'extensions' => 'jpg,jpeg,png'],
                // for user create
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'weblink' => Yii::t('app', 'Weblink'),
            'landline' => Yii::t('app', 'Landline'),
            'contact_person_name' => Yii::t('app', 'Contact Person Name'),
            'contact_person_email' => Yii::t('app', 'Contact Person Email'),
            'contact_person_mobile' => Yii::t('app', 'Contact Person Mobile'),
            'logo' => Yii::t('app', 'SIGN for STAFF-ID'),
            'pan_vat' => Yii::t('app', 'PAN/VAT'),
            'certificate' => Yii::t('app', 'Certificate'),
            'silver_front' => Yii::t('app', 'Silver Front'),
            'silver_back' => Yii::t('app', 'Silver Back'),
            'gold_front' => Yii::t('app', 'Gold Front'),
            'gold_back' => Yii::t('app', 'Gold Back'),
            'fk_country' => Yii::t('app', 'Country'),
            'fk_province' => Yii::t('app', 'Province'),
            'fk_district' => Yii::t('app', 'District'),
            'fk_municipal' => Yii::t('app', 'Municipal'),
            'fk_city' => Yii::t('app', 'City'),
            'fk_user' => Yii::t('app', 'Fk User'),
            'ward' => Yii::t('app', 'Ward'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'last_updated_by' => Yii::t('app', 'Last Updated By'),
            'status' => Yii::t('app', 'Status'),
            'pin' => Yii::t('app', 'Pin'),
            'black_front' => Yii::t('app', 'Black Front'),
            'black_back' => Yii::t('app', 'Black Back'),
            'LogoFile' => Yii::t('app', 'SIGN for STAFF-ID'),
        ];
    }

    /**
     * Gets query for [[BsHeads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBsHeads() {
        return $this->hasMany(BsHead::className(), ['fk_org' => 'id']);
    }

    /**
     * Gets query for [[BsSubHeads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBsSubHeads() {
        return $this->hasMany(BsSubHead::className(), ['fk_org' => 'id']);
    }

    /**
     * Gets query for [[FiscalYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiscalYears() {
        return $this->hasMany(FiscalYear::className(), ['fk_org' => 'id']);
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
     * Gets query for [[FkProvince]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkProvince() {
        return $this->hasOne(Province::className(), ['id' => 'fk_province']);
    }

    /**
     * Gets query for [[LedgerGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLedgerGroups() {
        return $this->hasMany(LedgerGroup::className(), ['fk_org' => 'id']);
    }

    /**
     * Gets query for [[Ledgers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLedgers() {
        return $this->hasMany(Ledger::className(), ['fk_org' => 'id']);
    }

    /**
     * Gets query for [[MemberTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberTypes() {
        return $this->hasMany(MemberType::className(), ['fk_org' => 'id']);
    }

    /**
     * Gets query for [[Members]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembers() {
        return $this->hasMany(Members::className(), ['fk_org' => 'id']);
    }

    public function uploadLogoFile($path) {
        $file = $path . uniqid() . '.' . $this->LogoFile->extension;
        if ($this->LogoFile->saveAs($file, false)) {
            $this->logo = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadCertificateFile($path) {
        $file = $path . uniqid() . '.' . $this->CertificateFile->extension;
        if ($this->CertificateFile->saveAs($file, false)) {
            $this->certificate = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadSilverBack($path) {
        $file = $path . uniqid() . '.' . $this->SilverBack->extension;
        if ($this->SilverBack->saveAs($file, false)) {
            $this->silver_back = $file;
            return true;
        } else {
            return false;
        }
    }
     public function uploadStaffCard($path) {
        $file = $path . uniqid() . '.' . $this->staffID->extension;
        if ($this->staffID->saveAs($file, false)) {
            $this->staff_id = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadSilverFront($path) {
        $file = $path . uniqid() . '.' . $this->SilverFront->extension;
        if ($this->SilverFront->saveAs($file, false)) {
            $this->silver_front = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadGoldenBack($path) {
        $file = $path . uniqid() . '.' . $this->GoldenBack->extension;
        if ($this->GoldenBack->saveAs($file, false)) {
            $this->gold_back = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadGoldenFront($path) {
        $file = $path . uniqid() . '.' . $this->GoldenFront->extension;
        if ($this->GoldenFront->saveAs($file, false)) {
            $this->gold_front = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadBlackFront($path) {
        $file = $path . uniqid() . '.' . $this->BlackFront->extension;
        //var_dump($file);die;
        if ($this->BlackFront->saveAs($file, false)) {
            $this->black_front = $file;
            return true;
        } else {
            return false;
        }
    }

    public function uploadBlackBack($path) {
        $file = $path . uniqid() . '.' . $this->BlackBack->extension;
        if ($this->BlackBack->saveAs($file, false)) {
            $this->black_back = $file;
            return true;
        } else {
            return false;
        }
    }
     public function uploadWhiteBack($path) {
        $file = $path . uniqid() . '.' . $this->WhiteBack->extension;
        if ($this->WhiteBack->saveAs($file, false)) {
            $this->white_back = $file;
            return true;
        } else {
            return false;
        }
    }
     public function uploadWhiteFront($path) {
        $file = $path . uniqid() . '.' . $this->WhiteFront->extension;
        if ($this->WhiteFront->saveAs($file, false)) {
            $this->white_front = $file;
            return true;
        } else {
            return false;
        }
    }

}
