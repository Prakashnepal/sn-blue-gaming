<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "staff_details".
 *
 * @property int $id
 * @property string $name
 * @property int $fk_department
 * @property int $fk_designation
 * @property int $fk_org
 * @property int $fk_country
 * @property int $fk_province
 * @property int $fk_district
 * @property int $fk_municipal
 * @property string|null $blood_group
 * @property string|null $guardian_name
 * @property string|null $guardian_contact
 * @property int $status
 * @property string|null $image
 * @property string|null $contact_no
 * @property int|null $ward_no
 * @property string|null $sign
 * @property string $emp_id
 * @property string|null $dob
 * @property string|null $citizenship_doc
 * @property string|null $id_card_no
 *
 * @property Country $fkCountry
 * @property Department $fkDepartment
 * @property Districts $fkDistrict
 * @property Municipals $fkMunicipal
 * @property Organization $fkOrg
 * @property Province $fkProvince
 */
class StaffDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_details';
    }

    /**
     * {@inheritdoc}
     */
    public $ImageFile;
    public $CitizenshipDoc;
//    public $SignFile;
    public function rules()
    {
        return [
            [['ImageFile','CitizenshipDoc'],'file','extensions'=>'jpg,png,jpeg'],
            [['name', 'fk_department', 'fk_designation', 'fk_org',  'status', 'emp_id'], 'required'],
            [['fk_department', 'fk_designation', 'fk_org', 'fk_country', 'fk_province', 'fk_district', 'fk_municipal', 'status', 'ward_no'], 'integer'],
            [['name', 'image', 'contact_no', 'sign', 'dob', 'citizenship_doc', 'id_card_no','emp_id','blood_group','guardian_name','guardian_contact'], 'string', 'max' => 255],
            [['fk_country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_country' => 'id']],
            [['fk_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['fk_department' => 'id']],
            [['fk_district'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['fk_district' => 'id']],
            [['fk_municipal'], 'exist', 'skipOnError' => true, 'targetClass' => Municipals::className(), 'targetAttribute' => ['fk_municipal' => 'id']],
            [['fk_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['fk_org' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'fk_department' => Yii::t('app', 'Department'),
            'fk_designation' => Yii::t('app', 'Designation'),
            'fk_org' => Yii::t('app', 'Fk Org'),
            'fk_country' => Yii::t('app', 'Country'),
            'fk_province' => Yii::t('app', 'State/Province'),
            'fk_district' => Yii::t('app', 'District'),
            'fk_municipal' => Yii::t('app', 'Local Govt.'),
            'blood_group' => Yii::t('app', 'Blood Group'),
            'guardian_name' => Yii::t('app', 'Guardian Name'),
            'guardian_contact' => Yii::t('app', 'Guardian Contact'),
            'status' => Yii::t('app', 'Status'),
            'image' => Yii::t('app', 'Image'),
            'contact_no' => Yii::t('app', 'Contact No'),
            'ward_no' => Yii::t('app', 'Ward No'),
            'sign' => Yii::t('app', 'Employee No'),
            'emp_id' => Yii::t('app', 'Employee ID'),
            'dob' => Yii::t('app', 'Date Of Birth'),
            'citizenship_doc' => Yii::t('app', 'Citizenship Doc'),
            'id_card_no' => Yii::t('app', 'ID Card No'),
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
     * Gets query for [[FkDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'fk_department']);
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
     * Gets query for [[FkMunicipal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkMunicipal()
    {
        return $this->hasOne(Municipals::className(), ['id' => 'fk_municipal']);
    }

    /**
     * Gets query for [[FkOrg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkOrg()
    {
        return $this->hasOne(Organization::className(), ['id' => 'fk_org']);
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
     public function uploadIdendityDoc($path1) {
        $file = $path1 . uniqid() . '.' . $this->CitizenshipDoc->extension;
        if ($this->CitizenshipDoc->saveAs($file, false)) {
            $this->citizenship_doc = $file;
            return true;
        } else {
            return false;
        }
    }
     public function uploadImageFile($path1) {
        $file = $path1 . uniqid() . '.' . $this->ImageFile->extension;
        if ($this->ImageFile->saveAs($file, false)) {
            $this->image = $file;
            return true;
        } else {
            return false;
        }
    }
   
    public function generateCardNo() {
        $helper = new \backend\controllers\Helper();
        $memberNo = null;
        $member = StaffDetails::find()->where(['fk_org'=>$helper->getActiveOrganization()])->max('status');
       $nextMemberno = $member + 1;
       
       $memberData = StaffDetails::find()->where(['fk_org'=>$helper->getActiveOrganization()])->andWhere(['status'=>$member])->one();
        if (empty($memberData->status)) {
            $memberNo = str_pad(1, 4, "0", STR_PAD_LEFT);
        }else{
            $memberNo = str_pad($nextMemberno, 4, "0", STR_PAD_LEFT);
        }
        $this->status = $memberNo;
        $Org_val = str_pad($helper->getActiveOrganization(), 2, "0", STR_PAD_LEFT);
         $cardno = $Org_val  . $memberNo;
//         var_dump($memberNo);die;
        $this->emp_id = $cardno;
        
    }

}
