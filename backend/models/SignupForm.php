<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fk_organization;
    public $fk_roleModel;
    public $counter;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['fk_organization','fk_roleModel','counter'],'integer'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['fk_organization','integer'],
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($org,$username,$pass,$email)
    {
       // var_dump($username);die;
        if (!$this->validate()) {
            return null;
        }
//        $helper = new \backend\controllers\Helper();
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->fk_role = 1;
        $user->setPassword($pass);
        $user->pit_no = null;
        $user->fk_organization = $org;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();

//        return $user->save() && $this->sendEmail($user);
    }
    public function signupFromOrg($org)
    {
       // var_dump($username);die;
        if (!$this->validate()) {
            return null;
        }
//        $helper = new \backend\controllers\Helper();
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->fk_organization = $org;
        $user->fk_role = $this->fk_roleModel;
        $user->pit_no = $this->counter;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
       // return $user->save();

        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['email'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
