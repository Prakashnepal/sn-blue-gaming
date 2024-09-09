
<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
$helper = new backend\controllers\Helper();
$this->registerJs($this->render('gallery.js'), 5);

$this->registerJs($this->render('ekko-lightbox.min.js'), 5);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = '';
//$this->params['breadcrumbs'][] = 'Company Setup';
?>


<section class="content">

    <!-- Default box -->
    <div class="card">

        <div class="card-body">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div>
                    <p class="float-right"> 
                        <?= Html::a(Yii::t('app', 'Edit info'), ['update','id'=>$helper->getActiveOrganization()], ['class' => 'btn btn-primary btn-rounded btn-xs']) ?>
                    </p>  
                </div>
                <div class="clearfix"></div>
                <div>
                    <p  style="font-weight: bold;color: black;font-size: 1.1rem;text-align: center;font-family: sans-serif"><?= $model->name ?></p>

                </div>
            </div>


            <div class="container" >

                <div class="card"style="background-color:lightcyan">
                    <div class="clearfix bg-primary "><span class="m-2">Company Details</span></div>
                    <p class="m-2 position-relative">
                        
                        <span>Landline: &nbsp;<b><?php echo empty($model->landline) ? 'Not Set' : $model->landline ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Contact Person:&nbsp; <b><?php echo empty($model->contact_person_name) ? 'Not Set' : $model->contact_person_name ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Contact Person Phone:&nbsp; <b><?php echo empty($model->contact_person_mobile) ? 'Not Set' : $model->contact_person_mobile ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Contact Person Email:&nbsp; <b><?php echo empty($model->contact_person_email) ? 'Not Set' : $model->contact_person_email ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Website:&nbsp; <b><?php echo empty($model->weblink) ? 'Not Set' : $model->weblink ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>PAN/VAT:&nbsp; <b><?php echo empty($model->pan_vat) ? 'Not Set' : $model->pan_vat ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;

                    </p>

                    <div class="clearfix bg-primary"><span class="m-2">Address Details</span></div>
                    <p class="m-2 position-relative">
                        <span>Country:&nbsp;<b><?= $country->country_name; ?></b></span> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Province:&nbsp; <b><?php echo empty($province->name_eng) ? 'Not Set' : $province->name_eng ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>District: &nbsp;<b><?php echo empty($district->district_eng) ? 'Not Set' : $district->district_eng ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Municipality:&nbsp; <b><?php echo empty($municipal->mun_eng) ? 'Not Set' : $municipal->mun_eng ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <span>Ward:&nbsp; <b><?php echo empty($model->ward) ? 'Not Set' : $model->ward ?></b></span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;



                    </p>
                    <!--<div class="clearfix bg-primary"><span class="m-2">Card Background</span></div>-->
                   <!--      
                        <div style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;" class="float-left m-2 "><img src="<?=$model->logo?> " height="150px;" width="230"></div>
                        <div class="float-right"><img src="<?=$model->certificate?> "></div>
                        -->
                        
                        <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Cards layout And Documents</h4>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->logo?>" data-toggle="lightbox" data-title="SIGN For STAFF-ID" data-gallery="gallery">
                        <img src="<?= $model->logo?>" class="img-fluid " alt="STAFF ID SIGN"/>
                    </a>
                  </div>
                    <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->certificate?>" data-toggle="lightbox" data-title="STAFF ID FRONT" data-gallery="gallery" title="Org. Reg. Certificate">
                        <img src="<?= $model->certificate?>" class="img-fluid " alt="STAFF ID FRONT"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->silver_front?>" data-toggle="lightbox" data-title="Silver Front" data-gallery="gallery"title="Silver Card Front Layout">
                        <img src="<?= $model->silver_front?>" class="img-fluid " alt="Silver Front"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->silver_back?>" data-toggle="lightbox" data-title="Silver back" data-gallery="gallery"title="Silver Card Back Layout">
                        <img src="<?= $model->silver_back?>" class="img-fluid " alt="Silver Back"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->gold_front?>" data-toggle="lightbox" data-title="Golden Front" data-gallery="gallery"title="Golden Card Front Layout">
                        <img src="<?= $model->gold_front?>" class="img-fluid " alt="Golden Front"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->gold_back?>" data-toggle="lightbox" data-title="Golden Back" data-gallery="gallery" title="Golden Card Back Layout">
                        <img src="<?= $model->gold_back?>" class="img-fluid " alt="Golden Back"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->black_front?>" data-toggle="lightbox" data-title="Black Front" data-gallery="gallery"title="Black Card Front Layout">
                        <img src="<?= $model->black_front?>" class="img-fluid mb-2" alt="Black Front"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->black_back?>" data-toggle="lightbox" data-title="Black_back" data-gallery="gallery"title="Black Card Back Layout">
                        <img src="<?= $model->black_back?>" class="img-fluid " alt="black back"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                    <a href="<?= $model->white_back?>" data-toggle="lightbox" data-title="White Back " data-gallery="gallery"title="White Card Back Layout">
                        <img src="<?= $model->white_back?>" class="img-fluid " alt="White Back"/>
                    </a>
                  </div>
                     <div class="col-sm-2 m-2" style="height: 100px;">
                         <a href="<?= $model->white_front?>" data-toggle="lightbox" data-title="White Front" data-gallery="gallery" title="White Card Front Layout">
                        <img src="<?= $model->white_front?>" class="img-fluid " alt="WhiteFront"/>
                    </a>
                  </div>
                    <div class="col-sm-2 m-2" style="height: 100px;">
                         <a href="<?= $model->staff_id?>" data-toggle="lightbox" data-title="STAFF ID BACK" data-gallery="gallery" title="Staff Id Card Layout">
                        <img src="<?= $model->staff_id?>" class="img-fluid " alt="STAFF ID BACK"/>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
                   
                </div>
                <div class="container-fluid">

                </div>

            </div>

        </div>
    </div>

    <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
