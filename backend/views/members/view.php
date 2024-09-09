<?php

use yii\helpers\Html;
use Da\QrCode\QrCode;

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
<!--fir member javascript id?-->
<input type="text" hidden="" id="member_id" value="<?=$model->id;?>">
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
                                <li class="list-group-item">
                                    <b>Card Print Count</b> <a class="float-right"><?= empty($model->member_card_print_count)?'Not Printed':$model->member_card_print_count ?></a>
                            </li>
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
                        <div class="float-left">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#additionalinfo" data-toggle="tab">Additional Information</a></li>
                                <!--<li class="nav-item"><a class="nav-link" href="#points" data-toggle="tab">Points</a></li>-->
                                <li class="nav-item"><a class="nav-link" href="#membership-card" data-toggle="tab">Membership Card</a></li>
                                <!--<li class="nav-item"><a class="nav-link" href="#inout" data-toggle="tab">IN-OUT</a></li>-->

                                <li class="nav-item"><a class="nav-link" href="#Timeline" data-toggle="tab">IN-OUT</a></li>


                            </ul>

                        </div>
                        <div class="float-right">
                            <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'm-0 btn btn-info  pull-right']) ?>

                          

                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="additionalinfo">
                                <div class="card card-default">
                                    <!--                                    <div class=" card-header">
                                                                            <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                                                                                <h4 class="card-title">Cards layout And Documents</h4>
                                    <?php // echo Html::a(Yii::t('app', 'Entery(IN/OUT)'), ['transactions/create', 'id' => $model->id], ['class' => 'btn btn-success', 'id' => 'inout']) ?>
                                    
                                    <?php // echoHtml::a(Yii::t('app', 'Points Transaction'), ['points/create', 'id' => $model->id], ['class' => 'btn btn-success', 'id' => 'inout'])  ?>
                                    
                                                                            </div>
                                    
                                                                            <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                                                                                <h4 class="card-title">Cards layout And Documents</h4>
                                    
                                    <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'm-1 btn btn-success float-right']) ?>
                                    <?=
                                    Html::button('PRINT DETAILS', [
                                        'class' => 'btn btn-success m-1 float-right'
                                    ])
                                    ?>
                                                                            </div>
                                                                        </div>-->
                                    <div class="card-header">
                                        <h3 class="card-title float-left "><b>ID No.:&nbsp;&nbsp;</b>  <?= $model->idendity_no ?>&nbsp;&nbsp;&nbsp; </h3>
                                          <button class="btn btn-md btn-default float-right " onclick="printDetails()"><i class="fa fa-print"></i></button>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title "><b>Address:&nbsp;&nbsp;&nbsp;&nbsp;</b>  <?php echo empty($model->address) ? 'Not Set' : $model->address ?>&nbsp;&nbsp;&nbsp; </h3>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title "><b>Nationality:&nbsp;&nbsp;&nbsp;&nbsp;</b>  <?php echo empty($country->nationality) ? 'Not Set' : $country->nationality ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DOB:&nbsp;&nbsp;</b>  <?php echo empty($model->dob) ? 'Not Set' : $model->dob; ?>&nbsp;&nbsp;&nbsp; </h3>
                                    </div>


                                    <!--                                    <div class="card-header">
                                                                            <h3 class="card-title "><b>Member Info Updated At&nbsp;&nbsp;</b>  <?php echo empty($model->update_date) ? 'Not Updated' : $model->update_date; ?> </h3>
                                                                        </div>-->

                                    <div class="card-footer bg-white">

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="float-left"><img class="img img-fluid" height="200"width="100%" src="<?= $model->idendity_doc ?>" alt="ID-FRONT" title="ID-FRONT"></div>

                                            </div>
                                            <div class="col-6">

                                                <div class="float-right"><img class="img img-fliud" height="200"width="100%" src="<?= $model->update_date ?>" alt="ID-BACK" title="ID-BACK"></div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-header">
                                        <h3 >  <span class="card-title "><b>Remarks.:&nbsp;&nbsp;</b>  <?= $model->remarks ?></span> </h3>
                                    </div>
                                </div>
                            </div>


                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="Timeline">
                                <!-- The timeline -->
                                <div class="container-fluid">
                                    <?php
                                    $searchModel = new \backend\models\TransactionsSearch(['fk_member' => $model->id]);
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
                                                <br><br><br><br><br><br><br><br><?php
                                                if ($model->fk_type == 3) {
                                                    echo '<br>';
                                                }
                                                ?>
                                                <p style="margin-left: 20px;line-height:1px;font-size: 17px;<?php
                                                if ($model->fk_type == 3) {
                                                    echo 'color: snow;';
                                                } else {
                                                    echo 'color: darkslategray;';
                                                }
                                                ?>text-align: justify;font-family: serif">
                                                    <strong>
                                                        <span sty><?= $model->name ?></span>&nbsp;&nbsp;&nbsp;
                                                        <span ><?= $model->card_no ?></span>
                                                    </strong>
                                                </p>
                                            </div>
                                            <div  style="background-image: url('<?= $backgroundback ?>');background-size: cover;background-repeat: no-repeat;width: 428px;height:273px;position: relative;font-size: 10px;opacity:1;">
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
                <?php // echoHtml::button('<span class="fa fa-times" aria-hidden="true"></span>', [ 'data-dismiss'=>'modal']);   ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_submit">PRINT</button>
                <?php // echo Html::button('<span class="fa fa-print" aria-hidden="true"></span>', ['id' => 'btn_submit', 'onclick' => 'printDiv(' . $model->id . ')']);   ?>
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
<div class="col-md-12" style="margin-top:450px; display: none;  ">
    <div class="col-md-12" id="print-details">
        <table style="width:100%;" >
            <tr>
            <h1 style="text-align:center;">SN BLUE GAMING CLUB NEPALGUNJ</h1>
            <h2 style="text-align:center;">New Road Nepalgunj-4 Banke</h2>
            </tr>
            <tr style="border:1px solid black">
            <p style="font-weight:bold;text-align: center">Membership Details</p>  
            </tr>

            <tr>
            <img style="float:right;margin-right: 0px;"  src="<?= $qrCode->writeDataUri() ?>" width="100" height="100"/>
            
            <p>Membership ID: <strong><?= empty($model['card_no']) ? 'Not Set' : $model['card_no'] ?></strong></p>

            <p>Name : <strong><?= $model['name'] ?></strong></p>    
            <p>Nationality : <strong><?= empty($country->nationality) ? 'Not Set' : $country->nationality ?></strong></p>
            <p>ID No : <strong><?= empty($model->idendity_no) ? 'Not Set' : $model->idendity_no ?></strong></p>
            <p>Label:
                <strong> <?php
                    $manae = backend\models\MemberType::findOne(['id' => $model->fk_type]);
                    if (empty($model->fk_type)) {
                        echo 'Not Set';
                    } else {
                        echo $manae->type;
                    }
                    ?>
                </strong></p><!-- comment -->
            <p>Address : <strong><?= empty($model['address']) ? 'Not Set' : $model['address'] ?></strong></p>
            <p>DOB : <strong><?= empty($model['dob']) ? 'Not Set' : $model['dob'] ?></strong></p>
                    <p>Membership Date : <strong><?= empty($model['dob']) ? 'Not Set' : $model['dob'] ?></strong></p>
   
        </tr>
            <tr style="position:relative">
            <div style="margin-top:0px;">
                <div style="float: left;width: 100%">
                     <!--<span><strong>FRONT-SIDE</strong></span>-->
                    <img style="overflow: auto;"  src="<?= empty($model->idendity_doc) ? 'Not Set' : $model->idendity_doc ?>" width="100%" height="300px"/> 
                    <!--<span><strong>BACK-SIDE</strong></span>-->
                    <img style=""  src="<?= empty($model->update_date) ? 'Not Set' : $model->update_date ?>" width="100%" height="300px"/>
                </div>
                
            </div>
            </tr>
        </table>




    </div>
</div>



<script>
    function printDiv()
    {
        var divToPrint = document.getElementById('printable');
        var id = document.getElementById('member_id').value;
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();

        newWin.document.write('<html><head><style>body{margin:0;padding:0;}.col-md-9{width:100%;}\n\
</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.onafterprint = function () {
            $.post("index.php?r=members/printcount&id="+id);

        }
        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 100);

    }
    function printDetails()
    {

        var divToPrint = document.getElementById('print-details');
//        alert(divToPrint);
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();

        newWin.document.write('<html><head><style> p{font-size:16px;margin-left:45px;margin-top:0px;}input{width: 100%;border: none;background-color: none;margin-left:0px;font-size:25px;background-color:transparent;}.col-md-12{width:100%;}.content{margin-top:-15px;}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.onafterprint = function(){
            
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

