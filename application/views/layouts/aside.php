<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">      
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU NAVEGACION</li>
            <li>
                <a href="<?php echo site_url() ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Categorias</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url(); ?>/principal"><i class="fa fa-circle-o"></i> TODOS</a></li>
                    <?php foreach ($categorias as $categoria): ?>
                        <li><a href="<?php echo site_url(); ?>/principal/categoria/<?= $categoria->id ?>"><i class="fa fa-circle-o"></i> <?= $categoria->nombre ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-shopping-cart"></i> <span>Carrito</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url(); ?>/carrito"><i class="fa fa-circle-o"></i>Carro de la compra</a></li>
                </ul>
            </li>
            <?php if ($this->session->userdata('login')) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-print"></i> <span>Pedidos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo site_url(); ?>/carrito/pedidos"><i class="fa fa-circle-o"></i> Mis pedidos</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($this->session->userdata('login') && $this->session->userdata('id') == 1) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user-circle-o"></i> <span>Administrador</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo site_url(); ?>/examples/muestraproductos"><i class="fa fa-circle-o"></i> CRUD articulos</a></li>
                        <li><a href="<?php echo site_url(); ?>/examples/muestracategorias"><i class="fa fa-circle-o"></i> CRUD categorias</a></li>
                        <li><a href="<?php echo site_url(); ?>/examples/muestrapedidos"><i class="fa fa-circle-o"></i> CRUD pedidos</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->