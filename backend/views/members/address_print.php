<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$company = (new \yii\db\Query())
        ->select('members.member_name,members.mobile,posts.post_name,organization.org_name,organization.place,organization.landline,municipals.municipal_name,districts.district_name,province.province_name')
        ->from('members')
        ->join('JOIN', 'province', 'members.fk_province=province.id')
        ->join('JOIN', 'districts', 'members.fk_district=districts.id')
        ->join('JOIN', 'organization', 'members.fk_organization=organization.id')
        ->join('JOIN', 'posts','members.fk_post=posts.id')
        ->join('JOIN', 'municipals', 'members.fk_municipal=municipals.id')
        ->where(['members.id' => $model])
        ->all();
//print_r($company);die;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<style>

    /* Create three equal columns that floats next to each other */
    .column {

        text-align: justify;
        line-height:auto;
        float: left;
        margin-left: 14px;
        margin-bottom: 4px;
        width: 45%;
        padding: 10px;
       

    }
   
    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>

<div class="row">
    <?php 
   // print_r($company);die;
    foreach ($company as $com) {
        ?>
    



    <div class="column">
    <p style="text-align: center; background-color: white;font-family: Pompadur;">
        <span style="font-weight: bold;font-size: 16px;"><?= $com['member_name'] ?></span><br>
        <span><?= $com['post_name'] ?></span><br>
         <span><?= $com['mobile'] ?></span><br>
         <span style="font-size: 14px; font-weight: bold;"><?= $com['org_name'] ?></span><br>
          <span><?= $com['municipal_name'] ?></span><br>
         <span><?= $com['place'].','.$com['district_name'].','.$com['province_name'] ?></span><br>
         
         <span><?= $com['landline'] ?></span><br>
        
    </p>
</div>
       
    <?php } ?>
</div>




