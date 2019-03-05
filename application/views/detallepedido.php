<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Detalles de pedido
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
                            <th>Producto ID</th>
                            <th>Precio</th>
                            <th style="text-align:right">Cantidad</th>
                            <th style="text-align:right"></th>
                        </tr>
                    </thead>
                    <?php foreach ($detalles as $items): ?>
                        <tr>
                            <td>
                                <?= $items->id; ?>
                            </td>
                            <td>
                                <?= $items->precio; ?>
                            </td>
                            <td style="text-align:right">
                                <?= $items->cantidad; ?>
                            </td>
                            <td style="text-align:right">
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>
</div>
