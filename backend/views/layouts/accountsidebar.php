<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="staticdoc/AdminLte.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">SN BLUE CASINO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
//                    ['label' => 'Dashboard', 'url' => ['ac/dashboard'], 'icon' => 'fa fa-id-card', 'iconStyle' => 'far'],
//                    ['label' => 'Blance Sheet', 'url' => ['ac/blancesheet'], 'icon' => 'fa fa-id-card', 'iconStyle' => 'far'],
                    ['label' => 'All Transaction', 'url' => ['points/index'], 'icon' => 'fa fa-id-card', 'iconStyle' => 'far'],
                    [
                        'label' => 'Extend Counters',
                        'icon' => 'fa fa-id-card',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Counters', 'url' => ['ac/index'], 'icon' => 'fa fa-window-close'],
                            ['label' => 'Make New', 'url' => ['counter/create'], 'icon' => 'fa fa-user-plus'],
                        ]
                    ],
                    [
                        'label' => 'Setting',
                        'icon' => 'cogs',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Counter Type', 'url' => ['counter-type/index'], 'icon' => 'building', 'iconStyle' => 'far'],
//                            ['label' => '', 'url' => ['nationality/index'], 'icon' => 'building', 'iconStyle' => 'far'],
//                            ['label' => 'Member Type', 'url' => ['member-type/index'], 'icon' => 'building', 'iconStyle' => 'far'],
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