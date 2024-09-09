<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;

//var_dump($lgr['id']);die;
$this->registerJs($this->render('verification.js'), 5);
/* @var $this yii\web\View */
/* @var $model backend\models\Members */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

if (!empty($city->name)) {
    $cityname = $city->name;
} else {
    $cityname = 'Not Set';
}
$sn = 1; // for serial no
$qr_value = $model['card_no'];
$qrCode = (new QrCode($qr_value))
        ->setSize(500)
        ->setMargin(10);

//->useForegroundColor(51, 153, 255);
// now we can display the qrcode in many ways
// saving the result to a file:
//$qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified
// display directly to the browser 
//header('Content-Type: ' . $qrCode->getContentType());
//echo '<img src="' . $qrCode->writeDataUri() . '">';
//echo $qrCode->writeString();
?>

<style>
    *{
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
    }
    input{
        width: 100%;
        border: none;
        background-color: transparent;

    }

</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="<?= $model->image ?>"
                                 alt="Member PP Size Photo">
                        </div>
                        <h3 class="profile-username text-center"><?= $model->name ?></h3>

                        <p class="text-muted text-center"><?= $model->email . '<br>' . $model->phone ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Membership Date</b> <a class="float-right"><?= $model->created_date; ?></a>
                            </li>

                            <li class="list-group-item">
                                <b>Membership No.</b> <a class="float-right"><?= $model->card_print_count ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Card No.</b> <a class="float-right"><?= $model->card_no ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Current Points</b> <a class="float-right"><?php echo empty($points) ? '0' : $points ?></a>
                            </li>

                            <?php if (!empty($checkinout->status)) { ?>
                                <li class="list-group-item">
                                    <b>Current Points</b> <a class="float-right"><?php
                                        if ($checkinout->status == 1) {
                                            echo "CHECK-IN";
                                        } else {
                                            echo "CHECK-OUT";
                                        }
                                        ?></a>
                                </li>

                            <?php }
                            ?>
                        </ul><!--

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <!--                            <div class="card card-primary">
                                              <div class="card-header">
                                                <h3 class="card-title">Additional Information</h3>
                                              </div>
                                               /.card-header 
                                              <div class="card-body">
                                                <strong><i class="fas fa-map mr-1"></i> Address</strong>
                                
                                                <p class="text-muted">
                <?= $model->dob ?>
                                                
                                                </p>
                                
                                                <hr>
                                                  <strong><i class="fas fa-calendar mr-1"></i> Date Of Birth</strong>
                                
                                                <p class="text-muted">
                <?= $model->dob ?>
                                                </p>
                                
                                                <hr>
                                              </div>
                                               /.card-body 
                                            </div>-->
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#additionalinfo" data-toggle="tab">Additional Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#points" data-toggle="tab">Points</a></li>
                            <li class="nav-item"><a class="nav-link" href="#membership-card" data-toggle="tab">Membership Card</a></li>
                            <!--<li class="nav-item"><a class="nav-link" href="#inout" data-toggle="tab">IN-OUT</a></li>-->

                            <li class="nav-item"><a class="nav-link" href="#Timeline" data-toggle="tab">IN-OUT</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="additionalinfo">
                                <div class="card card-default">
                                    <div class="row card-header">
                                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                                            <!--<h4 class="card-title">Cards layout And Documents</h4>-->
                                            <?php // echo Html::a(Yii::t('app', 'Entery(IN/OUT)'), ['transactions/create', 'id' => $model->id], ['class' => 'btn btn-success', 'id' => 'inout']) ?>

                                            <?php // echoHtml::a(Yii::t('app', 'Points Transaction'), ['points/create', 'id' => $model->id], ['class' => 'btn btn-success', 'id' => 'inout']) ?>

                                        </div>
                                        <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                                            <!--<h4 class="card-title">Cards layout And Documents</h4>-->

                                        </div>
                                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                            <!--<h4 class="card-title">Cards layout And Documents</h4>-->

                                            <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'm-1 btn btn-success float-right']) ?>

                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title "><b>Address:&nbsp;&nbsp;&nbsp;&nbsp;</b>  <?php echo empty($model->address) ? 'Not Set' : $model->address ?>&nbsp;&nbsp;&nbsp; </h3>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title "><b>Nationality:&nbsp;&nbsp;&nbsp;&nbsp;</b>  <?php echo empty($country->nationality) ? 'Not Set' : $country->nationality ?>&nbsp;&nbsp;&nbsp; </h3>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title "><b>ID No.:&nbsp;&nbsp;</b>  <?= $model->idendity_no ?>&nbsp;&nbsp;&nbsp; </h3>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title "><b>DOB:&nbsp;&nbsp;</b>  <?php echo empty($model->dob) ? 'Not Set' : $model->dob ;?>&nbsp;&nbsp;&nbsp; </h3>
                                    </div>
<!--                                    <div class="card-header">
                                        <h3 class="card-title "><b>Member Info Updated At&nbsp;&nbsp;</b>  <?php echo empty($model->update_date) ? 'Not Updated' : $model->update_date ;?> </h3>
                                    </div>-->
                                   
                                    <div class="card-header">
                                        <h3 >  <span class="card-title "><b>Remarks.:&nbsp;&nbsp;</b>  <?= $model->remarks ?></span> </h3>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                            <li>
                                                <span><img class="img img-responsive" height="200"width="100%" src="<?= $model->idendity_doc ?>" alt="Attachment"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="Timeline">
                                <!-- The timeline -->
                                <div class="container-fluid">
                                    <?php
                                    $searchModel = new \backend\models\TransactionsSearch(['fk_member'=>$model->id]);
                                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                                    ?>
                                    <?=
                                    fedemotta\datatables\DataTables::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'attribute' => 'status',
                                                'label' => 'Status',
                                                'value' => function ($data) {
                                                    if ($data->status == 1) {
                                                        return "CheckIn";
                                                    } elseif ($data->status == 0) {
                                                        return "CheckOut";
                                                    } else {
                                                        return "INVALID";
                                                    }
                                                }
                                            ],
//                                        [
//                                            'attribute' => 'points_action',
//                                            'value' => function ($data) {
//                                                if ($data->points_action == 1) {
//                                                    return "BUY";
//                                                } elseif ($data->points_action == 0) {
//                                                    return "COLLECTION";
//                                                } else {
//                                                    return "INVALID";
//                                                }
//                                            }
//                                        ],
                                            'date',
                                            'time',
                                            // 'status',
                                            'purpose',
//                                       
//                                        ['class' => 'yii\grid\ActionColumn'],
                                        ],
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                            <div class="tab-pane container" id="points">
                                <?php
//                                $searchModel = new \backend\models\PointsSearch();
//                                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                                ?>
                               
                                <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Member</th>
                    <th>Points</th>
                    <th>Counter</th>
                    <th>DateTime</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.0
                    </td>
                    <td>Win 95+</td>
                    <td>5</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.5
                    </td>
                    <td>Win 95+</td>
                    <td>5.5</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 6
                    </td>
                    <td>Win 98+</td>
                    <td>6</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet Explorer 7</td>
                    <td>Win XP SP2+</td>
                    <td>7</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>AOL browser (AOL desktop)</td>
                    <td>Win XP</td>
                    <td>6</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Firefox 1.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Firefox 1.5</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Firefox 2.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Firefox 3.0</td>
                    <td>Win 2k+ / OSX.3+</td>
                    <td>1.9</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Camino 1.0</td>
                    <td>OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Camino 1.5</td>
                    <td>OSX.3+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Netscape 7.2</td>
                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Netscape Browser 8</td>
                    <td>Win 98SE+</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Netscape Navigator 9</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.0</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.1</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.1</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.2</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.2</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.3</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.3</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.4</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.4</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.5</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.5</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.6</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.6</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.7</td>
                    <td>Win 98+ / OSX.1+</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.8</td>
                    <td>Win 98+ / OSX.1+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Seamonkey 1.1</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Epiphany 2.20</td>
                    <td>Gnome</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>Safari 1.2</td>
                    <td>OSX.3</td>
                    <td>125.5</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>Safari 1.3</td>
                    <td>OSX.3</td>
                    <td>312.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>Safari 2.0</td>
                    <td>OSX.4+</td>
                    <td>419.3</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>Safari 3.0</td>
                    <td>OSX.4+</td>
                    <td>522.1</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>OmniWeb 5.5</td>
                    <td>OSX.4+</td>
                    <td>420</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>iPod Touch / iPhone</td>
                    <td>iPod</td>
                    <td>420.1</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Webkit</td>
                    <td>S60</td>
                    <td>S60</td>
                    <td>413</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 7.0</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 7.5</td>
                    <td>Win 95+ / OSX.2+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 8.0</td>
                    <td>Win 95+ / OSX.2+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 8.5</td>
                    <td>Win 95+ / OSX.2+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 9.0</td>
                    <td>Win 95+ / OSX.3+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 9.2</td>
                    <td>Win 88+ / OSX.3+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera 9.5</td>
                    <td>Win 88+ / OSX.3+</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Opera for Wii</td>
                    <td>Wii</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Nokia N800</td>
                    <td>N800</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Presto</td>
                    <td>Nintendo DS browser</td>
                    <td>Nintendo DS</td>
                    <td>8.5</td>
                    <td>C/A<sup>1</sup></td>
                  </tr>
                  <tr>
                    <td>KHTML</td>
                    <td>Konqureror 3.1</td>
                    <td>KDE 3.1</td>
                    <td>3.1</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>KHTML</td>
                    <td>Konqureror 3.3</td>
                    <td>KDE 3.3</td>
                    <td>3.3</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>KHTML</td>
                    <td>Konqureror 3.5</td>
                    <td>KDE 3.5</td>
                    <td>3.5</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Tasman</td>
                    <td>Internet Explorer 4.5</td>
                    <td>Mac OS 8-9</td>
                    <td>-</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Tasman</td>
                    <td>Internet Explorer 5.1</td>
                    <td>Mac OS 7.6-9</td>
                    <td>1</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Tasman</td>
                    <td>Internet Explorer 5.2</td>
                    <td>Mac OS 8-X</td>
                    <td>1</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>NetFront 3.1</td>
                    <td>Embedded devices</td>
                    <td>-</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>NetFront 3.4</td>
                    <td>Embedded devices</td>
                    <td>-</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>Dillo 0.8</td>
                    <td>Embedded devices</td>
                    <td>-</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>Links</td>
                    <td>Text only</td>
                    <td>-</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>Lynx</td>
                    <td>Text only</td>
                    <td>-</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>IE Mobile</td>
                    <td>Windows Mobile 6</td>
                    <td>-</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>PSP browser</td>
                    <td>PSP</td>
                    <td>-</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Other browsers</td>
                    <td>All others</td>
                    <td>-</td>
                    <td>-</td>
                    <td>U</td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </div>
                            <!-- /.tab-pane -->
                            <?php
                            if ($model->fk_type == 1) {
                                $backgroundfront = $org['gold_front'];
                                $backgroundback = $org['gold_back'];
                            } else if ($model->fk_type == 2) {
                                $backgroundfront = $org['silver_front'];
                                $backgroundback = $org['silver_back'];
                            } elseif ($model->fk_type == 3) {
                                $backgroundfront = $org['black_front'];
                                $backgroundback = $org['black_back'];
                            } elseif ($model->fk_type == 4) {
                                $backgroundfront = $org['white_front'];
                                $backgroundback = $org['white_back'];
                            }
                            ?>

                            <div class="tab-pane" id="membership-card">
                                <div class="tab-pane active" id="membership-card">
                                    <div class="row">
                                        <div class="col-md-9" id="printable">
                                            <div style="background-image: url('<?= $backgroundfront ?>');background-size: cover;background-repeat: no-repeat;width: 428px;height:273px;position: relative;font-size: 10px;">
                                                <span> <img src="<?= $model['image'] ?>" width="73" height="83" style="margin-left:349px;margin-top: 8px;"/></span>
                                                <span>  <img src="<?= $qrCode->writeDataUri() ?>" width="68" height="68" style="margin-left:5px;margin-top: -120px;"/></span>
                                                <br><br><br><br><br><br><br>
                                                <p style="margin-left: 20px; font-size: 17px;color: darkslategray;text-align: justify;font-family: serif">
                                                    <strong>
                                                        <span ><?= $model->name ?></span><br>
                                                        <span ><?= $model->card_no ?></span>
                                                    </strong>
                                                </p>
                                            </div>
                                            <div  style="background-image: url('<?= $backgroundback ?>');background-size: cover;background-repeat: no-repeat;width: 428px;height:273px;position: relative;font-size: 10px;">
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <p style="text-align:right;">

                                                <?= Html::a('Edit', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>

                                                <button id="print-div" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">PRINT</button>
                                            </p>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Enter PIN Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" value="<?php echo $org->pin; ?>" id="municipal_id">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">PIN Code:</label>
                        <input type="password" class="form-control" value="" placeholder="Enter PIN Code" id="typed_pin">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <?php // echoHtml::button('<span class="fa fa-times" aria-hidden="true"></span>', [ 'data-dismiss'=>'modal']);?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_submit">PRINT</button>
                <?php // echo Html::button('<span class="fa fa-print" aria-hidden="true"></span>', ['id' => 'btn_submit', 'onclick' => 'printDiv(' . $model->id . ')']);?>
            </div>
        </div>
    </div>
</div>
<!--checkin modal-->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">--CHECK-IN FORM--</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    function printDiv()
    {
        var divToPrint = document.getElementById('printable');

        var newWin = window.open('', 'Print-Window');

        console.log(divToPrint);
        newWin.document.open();

        newWin.document.write('<html><head><style>body{margin:0;padding:0;}.col-md-9{width:100%;}\n\
</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.onafterprint = function () {
            console.log('printed');

        }
        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }

</script>

<!--<script>
    function printDiv() {
        //////// console.log(id);
        //var print_data = '';
        // var array = [];
        var return_data = '';
        $.post('index.php?r=members/print-data&id=' + id, function (data) {
            var printdata = data.split(',');
            var lotNo = printdata[1];
            var no_of_piece = printdata[0];
            var size = printdata[2];
            var weight = printdata[3];
            var order_id = printdata['4'];
            //  alert("data Lodaded"+data);
            var newWindow = window.open('', 'title');
            newWindow.document.open();
            newWindow.document.write('<html><head><style>body{height:259px;width:384px;font-size:20px;margin-top:18px;margin-left:67px; margin-right:0px;margin-bottom:0px;font-family:algerian;}</style><title></title></head><body onload="window.print()"><p>' + lotNo + '</p><p>' + size + '</p><p>' + no_of_piece + '</p><p>' + weight + '</p></body></html>');
            newWindow.document.close();
            newWindow.onafterprint = function () {
                var path = 'index.php?r=ordering/change-status&id=' + id;
                $.post(path);
                //console.log(path);
                window.location = 'index.php?r=ordering/singleorderinfo&id=' + id + '&orderId=' + order_id;
                //  'index.php?r=ordering/singleorderinginfo'.reload();
            };
            setTimeout(function () {
                newWindow.close();
            }, 10);
        });
        console.log(return_data);
        // print_data = data;
    }
</script>-->

