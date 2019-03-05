<div class="content-wrapper">
    <section class="content-header">
        <h1>
            CRUD
            <small>Listado productos</small>
        </h1>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <?php foreach ($css_files as $file): ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php endforeach; ?>

                <div style='height:20px;'></div>  
                <div style="padding: 10px">
                    <?php echo $output; ?>
                </div>
                <?php foreach ($js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>