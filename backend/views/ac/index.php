<?php $this->title = ''; ?>  

       <!--<h5 class="mt-4 mb-2">Info Box With <code>bg-gradient-*</code></h5>-->
 <div class="row">
     <?php 
     foreach ($data as $counter){
     ?>
          <div class="col-md-4 col-sm-6 col-12">
              <a href="index.php?r=ac/counter&id=<?=$counter['id']?>">
            <div class="info-box bg-gradient-default">
              <!--<span class="info-box-icon"><i class="far fa-bookmark"></i></span>-->
              <div class="info-box-content">
                <span class="info-box-text text-center text-bold"><?=$counter['name'].'('.$counter['code'].')';?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
     
     <?php } ?>
        </div>
        <!-- /.row -->