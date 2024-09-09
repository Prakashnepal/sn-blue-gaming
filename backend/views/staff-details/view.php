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
$qr_value = $model['emp_id'];
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

                        <p class="text-muted text-center"><?= $model->contact_no ?></p>

                        <ul class="list-group list-group-unbordered mb-3">


                            <li class="list-group-item">
                                <b>Employee ID</b> <a class="float-right"><?= $model->emp_id ?></a>
                            </li>


                            <?php if (!empty($checkinout->status)) { ?>
                                <li class="list-group-item">
                                    <b>Current Points</b> <a class="float-right"><?php
                                        if ($checkinout->status == 1) {
                                            echo "Active";
                                        } else {
                                            echo "Resigned";
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

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#additionalinfo" data-toggle="tab">Additional Information</a></li>
                            <!--<li class="nav-item"><a class="nav-link" href="#points" data-toggle="tab">Points</a></li>-->
                            <li class="nav-item"><a class="nav-link" href="#membership-card" data-toggle="tab">ID-CARD</a></li>
                            <!--<li class="nav-item"><a class="nav-link" href="#inout" data-toggle="tab">IN-OUT</a></li>-->
                            <!--<li class="nav-item"><a class="nav-link" href="#Timeline" data-toggle="tab">IN-OUT</a></li>-->
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="additionalinfo">
                                <div class="card card-default">

                                    <?php if (!empty($municipal)) { ?>
                                        <div class="card-header">
                                            <span class="card-title float-left"><b>Address:&nbsp;&nbsp;</b>  <?php echo $municipal . '-' . $district . ', ' . $province . ' ' . $country ?></span>
                                        </div>

                                    <?php }
                                    ?>
                                    <div class="card-header">
                                        <p>
                                            <span class="card-title float-left"><b>ID No.:&nbsp;&nbsp;</b>  <?= $model->id_card_no ?></span>
                                        </p>

                                    </div>
                                    <div class="card-header">

                                        <p>
                                            <span class="card-title float-left"><b>Date Of Birth.:&nbsp;&nbsp;</b>  <?= $model->dob ?></span>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                            <li>
                                                <span><img class="img img-responsive" height="200"width="100%" src="<?= $model->citizenship_doc ?>" alt="ID DOCS"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>



                            <?php
                            $backgroundfront = $org['staff_id'];
                            ?>

                            <div class="tab-pane" id="membership-card">
                                <div class="tab-pane active" id="membership-card">
                                    <div class="row">
                                        <div class="col-md-9" id="printable">
                                            <div style="background-image: url('<?= $backgroundfront ?>');background-size: cover;background-repeat: no-repeat;width: 428px;height:274px;position: relative;font-size: 10px;">
                                                <img src="<?= $model['image'] ?>" width="79" height="108" style="margin-left:349px;margin-top: 103px;"/>
                                                <!--<img src="<?php // $qrCode->writeDataUri() ?>" width="68" height="68" style="margin-left:349px;margin-top: 8px;"/>-->
                                                <img src="<?= $org['logo'] ?>" width="100" height="108" style="margin-left:329px;margin-top: -45px;opacity: 1"/>
                                                <p style="margin-left:359px;margin-top: -50px;opacity: 1">-------------------</p>
                                                <p style="margin-left:334px;margin-top: -15px;opacity: 1;font-weight: bold">Authorised Signatory</p>
                                                <p style="margin-top: -175px;color: black;margin-left:20px;text-align: justify;font-size:15px;font-family: sans-serif; font-weight: bold;">ID:&nbsp;&nbsp;<?= $model->emp_id ?></p>
                                                <p style="margin-left:20px;font-size:15px;font-family: sans-serif; font-weight: bold;">Name:&nbsp;&nbsp;<?= $model->name ?></p>
                                                <p style="margin-left: 20px;font-size:15px;font-family: sans-serif; font-weight: bold;">Department:&nbsp;&nbsp;<?= $department ?></p>
                                                <p style="margin-left:20px;font-size:15px;font-family: sans-serif; font-weight: bold;">Designation:&nbsp;&nbsp;<?= $designation ?></p>
                                                <?php if (!empty($model->sign)) { ?>

                                                    <p style="margin-left:20px;font-size:15px;font-family: sans-serif; font-weight: bold;">Validity:&nbsp;&nbsp;<?= $model->sign ?> </p>


                                                <?php } ?>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_submit">PRINT</button>
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->

<script>
    function printDiv()
    {
        var divToPrint = document.getElementById('printable');

        var newWin = window.open('', 'Print-Window');

        console.log(divToPrint);
        newWin.document.open();

        newWin.document.write('<html><head><style>body{margin:0;padding:0;}input{width: 100%;border: none;background-color: none;margin-left:0px;background-color:transparent;}.col-md-12{width:100%;}.content{margin-top:-15px;}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.onafterprint = function () {
            console.log('printed');

        }
        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }

</script>
