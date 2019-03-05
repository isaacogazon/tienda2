<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Pedidos realizados
            <small>Listado</small>
        </h1>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th style="text-align:right">Estado</th>
                            <th style="text-align:right">Acciones</th>
                        </tr>
                    </thead>
                    <?php foreach ($pedidos as $items): ?>
                        <tr>
                            <td>
                                <?= $items->id; ?>
                            </td>
                            <td>
                                <?= $items->fecha; ?>
                            </td>
                            <td style="text-align:right">
                                <?= $items->estado; ?>
                            </td>
                            <td style="text-align:right">
                                <a href="<?php echo site_url(); ?>/carrito/anular/<?= $items->id; ?>"><span class="label label-danger">Anular</span></a>
                                <a href="<?php echo site_url(); ?>/carrito/generarpdf/<?= $items->id; ?>"><span class="label label-success">PDF</span></a>
                                <a href="<?php echo site_url(); ?>/carrito/detallepedido/<?= $items->id; ?>"><span class="label label-primary">Ver</span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>
</div>
