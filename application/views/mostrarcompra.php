<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Compra
            <small>Listado</small>
        </h1>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo site_url('carrito/actualizarCarrito') ?>" method="post">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Cantidad</th>
                                <th>Descripción</th>
                                <th style="text-align:right">Precio</th>
                                <th style="text-align:right">Sub-Total</th>
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        <?php foreach ($this->cart->contents() as $items): ?>

                            <tr>
                                <td><?php
                                    echo form_hidden($i . '[rowid]', $items['rowid']);
                                    echo '<p class=""cantidad>'.$items['qty'].'</p>';
                                    ?>
                                </td>
                                <td id="nombre">
                                    <?php echo $items['name']; ?>
                                    <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                        <p>
                                            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value):
                                                ?>
                                                <strong><?php echo $option_name; ?>:</strong>
                                                <?php echo $option_value; ?><br/>
                                            <?php endforeach; ?>
                                        </p>
                                    <?php endif; ?>
                                </td>
                                <td class="precio" style="text-align:right">
                                    <?php echo $this->cart->format_number($items['price']); ?>€
                                </td>
                                <td style="text-align:right">
                                    <?php echo $this->cart->format_number($items['subtotal']); ?>€
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td>
                                <?php echo $this->cart->format_number($this->cart->total()); ?>€
                            </td>
                        </tr>
                    </table>
                    <div class="col-xs-3">
                        <a href="<?php echo site_url('carrito/realizarcompra') ?>">
                            <input type="button"  value="Realizar pedido" class="btn btn-primary btn-block btn-flat">
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
