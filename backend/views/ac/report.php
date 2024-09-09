

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <?php
            $helper = new backend\controllers\Helper();
            foreach ($memberID as $id) {
                $model = \backend\models\Members::findOne(['id' => $id]);
               $points = backend\models\Points::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['fk_member' => $model->id])->all();
                $value = backend\models\Nationality::findOne(['id' => $model->fk_nationality]);
                $nationality = empty($value['nationality'])?'Not Set':$value['nationality'];
                if (!empty($city->name)) {
                    $cityname = $city->name;
                } else {
                    $cityname = 'Not Set';
                }
                $sn = 1; // for serial no
                
            
            ?>
            <div class="card">
                <div class="card-header">
                    <p class="float-left">Name: <b><?= $model->name . '( ' . $model->card_no . ' )'; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID No.:<b> <?= $model->idendity_no ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address:<b> <?= $model->address ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Nationality: <b><?= $nationality ?></b></p>
                </div>
                <div class="card-body">
                    <table class=" table table-bordered table-striped " style="font-size: 13px;text-align: center">
                        <thead>
                            <tr>
                                <th rowspan="2">S.N.</th>
                                <th rowspan="2">Date</th><!-- comment -->
                                <th rowspan="2">T.BY</th>
                                <th rowspan="2">Type</th>
                                <th rowspan="2">Particulars</th>
                                <th style="width:30%" colspan="3">Amount</th>
                                <th rowspan="2" >Remarks</th>
                            </tr>
                            <tr>
                                <th >CR.</th>
                                <th>DR.</th>
                                <th>Total</th>
<!--                                <th>Remarks</th>-->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 1;
                            $Remaining = 0;
                            $total_Cr = 0;
                            $total_Dr = 0;
                            foreach ($points as $account) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $count++ ?>
                                    </td>
                                    <td><?= $account['time'] ?></td>
                                    <td><?php
                                        $counter1 = backend\models\Counter::findOne(['id' => $account['fk_counter']]);
                                        echo $counter1->code;
                                        ?></td>
                                    <td><?= $account['net_points'] ?></td>
                                    <td><?php
                                        if ($account['points_action'] == 0) {
                                            echo 'CREDIT POINTS TO CARDS';
                                        } elseif ($account['points_action'] == 1) {
                                            echo 'DEBIT FROM CARD';
                                        }
                                        ?></td>

                                    <?php
                                    if ($account['points_action'] == 0) {
                                        $Remaining += $account['points'];
                                        $total_Cr += $account['points'];
                                        ?>

                                        <td><?= $account['points'] ?></td>
                                        <td>--------</td>

                                        <td><?= $Remaining ?></td>

                                        <?php
                                    } else {
                                        $total_Dr += $account['points'];
                                        $Remaining -= $account['points'];
                                        ?>

                                        <td>--------</td>
                                        <td><?= $account['points'] ?></td>

                                        <td><?= $Remaining ?></td>

                                        <?php
                                    }
                                    ?>
                                    <td><?= $account['remarks'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="5"> <span style="float: right;"><b>Grand Total</b></span></td>
                                <td><b><?= $total_Cr ?></b></td>
                                <td><b><?= $total_Dr ?></b></td>
                                <td><b><?= $Remaining ?></b></td>
                                <td><b><?php
                                        if ($Remaining > 0) {
                                            echo "Refundable: " . $Remaining;
                                        } elseif ($Remaining < 0) {
                                            echo "WIN: " . abs($Remaining);
                                        } else {
                                            echo "BLANCED";
                                        }
                                        ?></b></td>

                            </tr>
                        </tbody>


                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php } ?>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->



