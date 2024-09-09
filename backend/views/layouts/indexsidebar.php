<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="staticdoc/AdminLte.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SN BLUE CASINO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->



        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['site/dashboard'], 'icon' => 'fa fa-tachometer-alt'],
                    ['label' => 'Membership', 'url' => ['members/index'], 'icon' => 'fa fa-id-card', 'iconStyle' => 'far'],
                    ['label' => 'Employees', 'url' => ['staff-details/index'], 'icon' => 'fa fa-users'],
                    ['label' => 'Account', 'url' => ['ac/index'], 'icon' => 'fa fa-credit-card', 'iconStyle' => 'far'],
//                 ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                    [
                        'label' => 'Setting',
                        'icon' => 'cogs',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Country Setup', 'url' => ['country/index']],
                            ['label' => 'Province/State Setup', 'url' => ['province/index'], 'iconStyle' => 'far'],
                            ['label' => 'District Setup', 'url' => ['districts/index'], 'iconStyle' => 'far'],
                            ['label' => 'Local Govt. Setup', 'url' => ['municipals/index'], 'iconStyle' => 'far'],
                            ['label' => 'Cities Setup', 'url' => ['cities/index'], 'iconStyle' => 'far'],
                        ]
                    ],
                     [
                        'label' => 'Setup',
                        'icon' => 'cogs',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Profile Setup', 'url' => ['organization/index'], 'icon' => 'building', 'iconStyle' => 'far'],
                            ['label' => 'Cash Chips Setup', 'url' => ['ccchips/index']],
                            ['label' => 'Province/State Setup', 'url' => ['province/index'], 'iconStyle' => 'far'],
                            ['label' => 'District Setup', 'url' => ['districts/index'], 'iconStyle' => 'far'],
                            ['label' => 'Local Govt. Setup', 'url' => ['municipals/index'], 'iconStyle' => 'far'],
                            ['label' => 'Cities Setup', 'url' => ['cities/index'], 'iconStyle' => 'far'],
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