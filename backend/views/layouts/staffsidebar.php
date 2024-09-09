<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="AssetFiles/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .5">
        <span class="brand-text font-weight-light">SN BLUE CASINO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>-->

        <!--         SidebarSearch Form 
                 href be escaped -->
<!--                 <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Staff Section',
                        'icon' => 'fa fa-tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Staff Lists', 'url' => ['staff-details/index'], 'icon' => 'fa fa-list-alt'],
                            ['label' => 'Add New', 'url' => ['members/create'], 'icon' => 'fa fa-user-plus'],
                        ]
                    ],
                    [
                        'label' => 'Setting',
                        'icon' => 'cogs',
//                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Department Setup', 'url' => ['department/index'], 'icon' => 'building', 'iconStyle' => 'far'],
                            ['label' => 'Designation', 'url' => ['designation/index'], 'icon' => 'building', 'iconStyle' => 'far'],
                        ]
                    ],
                    
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>