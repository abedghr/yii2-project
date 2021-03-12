<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="text-center">
                <h3 style="color:white;">YII2 Dashboard</h3>
            </div>
            <div class="pull-left info">
               
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Manage Makes', 'icon' => 'fa fa-star', 
                            'url' => ['/make/index'], 'active' => $this->context->route == 'site/index'
                        ],
                        ['label' => 'Manage Models' , 'icon'=>'fa fa-star', 
                            'url' => ['/models/index'], 'active' => $this->context->route == 'site/index'
                        ],
                        [
                            'label' => 'Manage Vehicles',
                            'icon' => 'fa fa-car',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'New Vehicles',
                                    'icon' => 'fa fa-car',
                                    'url' => '/new-vehicles/index',
				    'active' => $this->context->route == 'vehicles/index'
                                ],
                                [
                                    'label' => 'Used Vehicles',
                                    'icon' => 'fa fa-car',
                                    'url' => '/used-vehicles/index',
				    'active' => $this->context->route == 'vehicles/index'
                                ]
                            ]
                        ],
                        [
                            'label' => 'Manage Cities',
                            'icon' => 'fa fa-globe',
                            'url' => ['/city/index'],
                            'active' => $this->context->route == 'city/index',
                        ],
                        [
                            'label' => 'Manage Mileage',
                            'icon' => 'fa fa-tachometer',
                            'url' => ['/mileage/index'],
                            'active' => $this->context->route == 'mileage/index',
                        ],
                        [
                            'label' => 'Show Comments',
                            'icon' => 'fa fa-comment',
                            'url' => ['/comments/index'],
                            'active' => $this->context->route == 'comments/index',
                        ],
                        ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                        ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
