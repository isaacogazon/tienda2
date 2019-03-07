<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Carrito
            <small>Listado</small>
        </h1>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <?php echo form_open_multipart('principal/inportar_productos'); ?>

                <div class="form-group">
                    <input class="input" type="file" name="file">

                </div>


                <div class="form-group">
                    <button class="input" type="submit" >Importar</button>
                </div>
                </form>
            </div>
        </div>

    </section>
</div>
