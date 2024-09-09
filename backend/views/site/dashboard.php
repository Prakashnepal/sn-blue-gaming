<?php /*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */ ?>
<?php
$this->title = '';
//$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<!--this is div container fluid-->
<div class="container-fluid">


    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?=
            \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $mno,
                'text' => 'Registed Members',
                'icon' => 'fa fa-users',
            ])
            ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php
            $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                        'title' => $inout,
                        'text' => 'Today Head Count',
                        'icon' => 'fas fa-users-cart',
                        'theme' => 'success',
                        'loadingStyle' => false
                    ])
            ?>
            <?=
            \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id . '-ribbon',
                'text' => date('Y-m-d'),
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ])
            ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?=
            \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $total,
                'text' => 'Visitors Count',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-warning',
                'loadingStyle' => false
            ])
            ?>
        </div>
    </div>

    <div class="row">
<!--        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Visitors Report</h3>
                        <a href="javascript:void(0);">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?=$inout ?></span>
                            <span>Visitors Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 12.5%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </p>
                    </div>
                     /.d-flex 

                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Week
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                    </div>
                </div>
            </div>
-->        </div>
<!--        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             /.card 
            <div class="card">
                
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                           
                            <span>Visitors/New Membership Report</span>
                        </p>
                       
                    </div>
                   

                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i>Visitors
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i>New Members
                        </span>
                    </div>
                </div>
            </div>
             
        </div>-->

    </div>
</div>
