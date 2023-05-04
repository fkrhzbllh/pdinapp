<div class="container">
    <div class="row">
        <div class="column">
            <h1 class="mt-3">Layanan</h1>
            <!-- <a href="<?php echo base_url()?>sewa-ruang">Sewa Ruang</a> -->
        </div>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center" style="height:auto;">
    <div class="container mt-5">
        <?php foreach($layanan as $l) : ?>
        <div class="row align-items-center justify-content-center mb-5">
            <div class="column" style="width: 50px;">
                <img src="<?= base_url()?>favicon.ico">
            </div>
            <div class="col-sm-10">
                <div class="card">
                <!-- <h5 class="card-header">Featured</h5> -->
                    <div class="card-body">
                        <h3 class="card-title"><?= $l['nama_layanan'] ?></h3>
                        <p class="card-text"><?= $l['deskripsi'] ?></p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>