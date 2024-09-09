<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\date\DatePicker;

//$this->registerJs($this->render('jsFile.js'), 5);

/* @var $this yii\web\View */
/* @var $model backend\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"  id="photo-file">
        <img id="foto" src="#"><!-- comment -->
        <?= $form->field($model, 'ImageFile')->fileInput(['maxlength' => true, 'onchange' => 'readURL(this);', 'id' => 'computer-photo', 'class' => 'float-left']) ?>
        <div >
            <a href="#" onclick="showCamera()" class="btn btn-warning">Photo From Camera</a>
        </div>


    </div>

    <div class="row" style="display: none;" id="camera-show">
        <div class="row" >
            <div class="col-md-6 float-left">
                <video id="video" height="" width="300"></video><br>
                <a href="#result" id="capture" class="btn btn-primary" >take a photo</a>
                <a href="#" onclick="displayPhoto()" class="btn btn-warning">Upload from Computer</a>
            </div>

            <div class="col-md-6 float-right mt-0">
                <?= $form->field($model, 'photo_from_camera')->hiddenInput(['maxlength' => true, 'id' => 'photo-from-camera'])->label(false) ?>
                <canvas id="canvas1" width="300" height="300" style="display:block;"></canvas> 
                <img src = "" id = "photo" style="margin:0;" alt="photo of you" height="" >
                <canvas id="canvas" width="300" height="300" style="display:none;"></canvas> 

            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> 
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'idendity_no')->textInput(['maxlength' => true]) ?>

        </div>

    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_type')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\MemberType::find()->all(), 'id', 'type'),
                'options' => ['placeholder' => 'PleaseSelect One...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Type');
            ?>  
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?> 
        </div>
    </div>
    <div class="row">


        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'address')->textarea(['rows' => 1])->label('Address') ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_nationality')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\Nationality::find()->all(), 'id', 'nationality'),
                'options' => ['placeholder' => 'PleaseSelect One...', 'id' => 'account-lev0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Nationality');
            ?> 
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'dob')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter birth date ...', 'autocomplete' => 'off'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]);
            ?>  
        </div>

    </div>
    <div class="row">







        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'remarks')->textarea(['rows' => 1]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'IdendityDoc')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ])->label('ID-CARD FRONT');
            ?>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'IdendityDocBack')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ])->label('ID-CARD BACK');
            ?>  
        </div>



    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    (function () {

        var video = document.getElementById('video'),
                canvas = document.getElementById('canvas'),
                photo = document.getElementById('photo'),
                result = document.getElementById('photo-from-camera'),
                image_preview = document.getElementById('foto'),
                computer_photo = document.getElementById('computer-photo');
        context = canvas.getContext('2d');
        navigator.getMedia = navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia ||
                navigator.msGetUserMedia;
        navigator.getMedia({
            video: true,
            audio: false
        }, function (stream) {
            video.srcObject = stream;
            video.play();
        }, function (error) {
            //error occcured
        });
        document.getElementById('capture').addEventListener('click', function () {
            computer_photo.value = null;
            image_preview.src = '#';
            context.drawImage(video, 0, 0, 300, 300);
            photo.setAttribute('src', canvas.toDataURL('image/png'));
            result.setAttribute('value', canvas.toDataURL('image/png'));
        });
    })();
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foto')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function adDate(date, id) {
        var split_date = date.split('-');
        var year = split_date[0];
        //console.log(year);
        var ad = NepaliFunctions.BS2AD({year: split_date[0], month: split_date[1], day: split_date[2]});
        var ad_date = ad.year + '-' + ad.month + '-' + ad.day;
        document.getElementById(id).value = ad_date;
        console.log(id);
    }
    function displayCause() {
        // console.log('cause');
        document.getElementById('cause').style.display = 'block';
    }

//    var mainInput = document.getElementById("nepali-datepicker1");
//
//    /* Initialize Datepicker with options */
//    mainInput.nepaliDatePicker({
//    ndpYear: true,
//    ndpMonth: true,
//    ndpYearCount: 10
//});
    function showCamera() {
        document.getElementById('camera-show').style.display = 'block';
        document.getElementById('photo-file').style.display = 'none';
        document.getElementById('computer-photo').style.display = 'none';
        document.getElementById('canvas1').style.display = 'none';
        document.getElementById('photo-from-camera').style.display = 'block';
    }
    function displayPhoto() {
        document.getElementById('photo').src = '#';
        document.getElementById('photo-from-camera').value = null;
        document.getElementById('camera-show').style.display = 'none';
        document.getElementById('photo-file').style.display = 'block';
        document.getElementById('computer-photo').style.display = 'block';
    }
</script>

