<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use backend\models\Tables;
use backend\models\TableChips;
/**
 * Description of Helper
 *
 * @author hiramani
 */
class Helper {

    //put your code here
    public static function actionNepaliDate() {
        date_default_timezone_set('Asia/Kathmandu');
        $nepdate = new NepaliCalender();
        // print_r($nepdate);die;
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $today = $nepdate->eng_to_nep($year, $month, $day);
//print_r($cal->nep_to_eng(2065,8,8));
        //$nepali_date1 = $today['year'] . '-' . $today['month'] . '-' . $today['date'];

        $nepali_date2 = strlen($today['month']);
        $nepali_date1 = strlen($today['date']);
        if ($nepali_date2 == 1) {
            $month1 = '0' . $today['month'];
        } else {
            $month1 = $today['month'];
        }
        if ($nepali_date1 == 1) {
            $date1 = '0' . $today['date'];
        } else {
            $date1 = $today['date'];
        }
        $nepali_today = $today['year'] . '-' . $month1 . '-' . $date1;
        return $nepali_today;
    }

    public static function getActiveUserName() {
        $user_id = \Yii::$app->user->id;
        $user = \common\models\User::findOne(['id' => $user_id]);
        return $user->username;
    }

    public static function getActiveUserId() {
        return \Yii::$app->user->id;
    }
    public function getActiveUserRole() {
       $user_id = \Yii::$app->user->id;
        $user = \common\models\User::findOne(['id' => $user_id]);
        return $user->fk_role;
    }
    public function getActiveUserPit() {
       $user_id = \Yii::$app->user->id;
        $user = \common\models\User::findOne(['id' => $user_id]);
        return $user->pit_no;
    }

    public static function getActiveOrganization() {
        $user_id = \Yii::$app->user->id;
        $user = \common\models\User::findOne(['id' => $user_id]);
//        var_dump($user->fk_organization);die;
        return $user->fk_organization;
    }

    public static function getFiscalYearStart() {
        $currentDate = $this->actionNepaliDate();
        $currentDateInt = explode("-", $currentDate);
        $startDate = $currentDateInt[0] . '-04-01';
//        var_dump($startDate);die;
        return $startDate;
    }

    public static function getFiscalYearEnd() {
        $currentDate = $this->actionNepaliDate();
        $currentDateInt = explode("-", $currentDate);
        $nextYear = $currentDateInt[0] + 1;
        $endDate = $nextYear . '-03-31';
//        var_dump($startDate);die;
        return $endDate;
    }
       public static  function getPitvalue($id) {
        $pitvalue = 00.00;
        
        $tables = Tables::find()->where(['fk_counter'=>$id])->asArray()->all();
        foreach ($tables as $data){
           $tchips = TableChips::find()->where(['fk_table'=>$data['id']])->andWhere(['status'=>1])->andWhere(['fk_org'=> Helper::getActiveOrganization()])->asArray()->all();
//           print_r($tchips);die;
           foreach ($tchips as $tc){
               $singlecoinvalue = $tc['qty'] * $tc['value'];
               $pitvalue = $pitvalue  + $singlecoinvalue;
           } // end of table chips 
        }// end of table 
        return $pitvalue;
    }

    public static  function createFolder($path) {
        $mode = 0777;
        $recursive = true;
        if (!is_dir($path)) {
            \yii\helpers\FileHelper::createDirectory($path, $mode, $recursive);
        }
    }

    public static function createMultiple($modelClass, $multipleModels = []) {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = \Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(\yii\helpers\ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }
        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }
        unset($model, $formName, $post);
        return $models;
    }

}
