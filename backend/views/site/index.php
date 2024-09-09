<?php /*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */ ?>
<?php
$this->title = 'wdsds';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
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
   
 <!-- =========================================================== -->
        <!--<h5 class="mt-4 mb-2">Info Box With <code>bg-gradient-*</code></h5>-->
 <div class="row">
          <div class="col-md-4 col-sm-6 col-12">
              <a href="index.php?r=members/index">
            <div class="info-box bg-gradient-default">
              <!--<span class="info-box-icon"><i class="far fa-bookmark"></i></span>-->
              <div class="info-box-content">
                <span class="info-box-text text-center text-bold">Membership</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
     <div class="col-md-4 col-sm-6 col-12">
              <a href="index.php?r=staff-details/index">
            <div class="info-box bg-gradient-default">
              <!--<span class="info-box-icon"><i class="far users"></i></span>-->
              <div class="info-box-content">
                <span class="info-box-text text-center text-bold">Employees</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
<!--      <div class="col-md-4 col-sm-6 col-12">
              <a href="index.php?r=ac/index">
            <div class="info-box bg-gradient-default">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                  <span  class="info-box-text text-center text-bold">Accounting</span>
              </div>
               /.info-box-content 
            </div>
             /.info-box 
            </a>
          </div>-->
     
        </div>
        <!-- /.row -->

      
</div>
