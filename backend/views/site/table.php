
<!--    <style>
      table.GeneratedTable {
        width: 100%;
        background-color: #ffffff;
        border-collapse: collapse;
        border-width: 2px;
        border-color: #1d190c;
        border-style: solid;
        color: #000000;
      }

      table.GeneratedTable td,
      table.GeneratedTable th {
        border-width: 2px;
        border-color: #1b1603;
        border-style: solid;
        padding: 3px;
      }

      table.GeneratedTable thead {
        background-color: #ffcc00;
      }
    </style>-->
<div class="card border shadow pl-2">
    <div class="card-header">
        <div class="row p-1">
            <?php

            use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
            use yii\helpers\Html;

$form = ActiveForm::begin([
                        'id' => 'login-form-inline',
                        'type' => ActiveForm::TYPE_INLINE,
                        'fieldConfig' => ['options' => ['class' => 'form-group mb-3 mr-2 me-2']] // spacing form field groups
            ]);
            ?>
            <?php //  $form->field($model, 'username')  ?>

            <?php //  $form->field($model, 'rememberMe')->checkbox(['custom' => true])  ?>
            <div class="form-group mb-3">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary mr-1']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>  
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
           

            <div class="row">
                 
                <div class="col-3 pt-3">
                    <p>Shift.....................</p>
                </div>
                  <div class="col-6">
                   <h2 class="text-center text-bold">CASH HOURLY REPORT</h2>
                </div>
                <div class="col-3 pt-3">
 <p class="text-right">Date.......................</p>
                </div>
            </div>
            <thead>
                <tr>
                    <th colspan="2" rowspan="2">Tables</th>
                    <th colspan="11" class="">Time</th>
                    <th rowspan="2">Remarks</th>
                </tr>
                <tr>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>
                    <th>11:00</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td colspan="2">gfgf</td>
                </tr>
                <tr>
                    <td colspan="2">gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td colspan="2">gfgf</td>
                </tr>
                <tr>
                    <td colspan="2">gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td>gfgf</td>
                    <td colspan="2">gfgf</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>

                <tr>
                    <td colspan="2">RESULT</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>
                <tr>
                    <td colspan="2">Chips Out</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>
                <tr>
                    <td colspan="2">Cash Out</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>
                <tr>
                    <td colspan="2">Prev. Chips Hold</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>
                <tr>
                    <td colspan="2">Total Chips Hold</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>
                <tr>
                    <td colspan="2">Head Count</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>
                <tr>
                    <td colspan="2">Issued/Coupons</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td colspan="2">0</td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-6">
            <h3>---------------</h3>
            <h3>Prepared by</h3>
        </div>
    </div>
</div>

