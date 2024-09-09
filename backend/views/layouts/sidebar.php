<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="staticdoc/AdminLte.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SN BLUE CASINO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     
        <nav >
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Members Section',
                        'icon' => 'fa fa-id-card',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Member List', 'url' => ['members/index'], 'icon' => 'fa fa-th-list',],
                            ['label' => 'Suspended List', 'url' => ['members/suspended'], 'icon' => 'fa fa-window-close'],
                            ['label' => 'Add New', 'url' => ['members/create'], 'icon' => 'fa fa-user-plus'],
                        ]
                    ],
                    [
                        'label' => 'Visitors Section',
                        'icon' => 'users',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Records', 'url' => ['transactions/index'], 'icon' => 'fa fa-align-justify'],
                            ['label' => 'Today Visitors', 'url' => ['transactions/today-visitors'], 'icon' => 'fa fa-calendar-check'],
                        ]
                    ],
                   [
                        'label' => 'Setting',
                        'icon' => 'cogs',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Nationality Setup', 'url' => ['nationality/index'], 'icon' => 'building', 'iconStyle' => 'far'],
                            ['label' => 'Member Type', 'url' => ['member-type/index'], 'icon' => 'building', 'iconStyle' => 'far'],
                        ],
                        
                    ],
                    
//                 ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>