<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 *  @property integer $pit_no
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $fk_organization
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property BsHead[] $bsHeads
 * @property BsSubHead[] $bsSubHeads
 * @property LedgerGroup[] $ledgerGroups
 * @property Transactions[] $transactions
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'fk_organization', 'created_at', 'updated_at'], 'required'],
            [['fk_organization', 'status', 'created_at', 'updated_at','pit_no'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'fk_organization' => Yii::t('app', 'Fk Organization'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
        ];
    }

    /**
     * Gets query for [[BsHeads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBsHeads()
    {
        return $this->hasMany(BsHead::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[BsSubHeads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBsSubHeads()
    {
        return $this->hasMany(BsSubHead::className(), ['fk_user' => 'id']);
    }

    /**
     * Gets query for [[LedgerGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLedgerGroups()
    {
        return $this->hasMany(LedgerGroup::className(), ['fk_user' => 'id']);
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['created_by' => 'id']);
    }
}
