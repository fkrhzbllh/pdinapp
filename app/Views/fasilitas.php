<div class="container">
    <div class="row">
        <div class="column">
            <h1 class="mt-3">fasilitas</h1>
            <!-- <a href="<?php echo base_url()?>sewa-ruang">Sewa Ruang</a> -->
        </div>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center" style="height:auto;">
    <div class="container mt-3">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-link"><a data-toggle="pill" href="#ruangan">Ruangan</a></li>
            <li class="nav-link"><a data-toggle="pill" href="#menu1">Alat</a></li>
        </ul>

        <div class="tab-content">
            <div id="ruangan" class="tab-pane fade in active mt-3">
                <h3>Ruangan</h3>
                <?php foreach($ruangan as $r) : ?>
                <div class="row align-items-center justify-content-center mb-5">
                    <div class="column" style="width: 50px;">
                        <img src="<?= base_url()?>favicon.ico">
                    </div>
                    <div class="col-sm-10">
                        <div class="card">
                        <!-- <h5 class="card-header">Featured</h5> -->
                            <div class="card-body">
                                <h3 class="card-title"><?= $r['nama'] ?></h3>
                                <p class="card-text"><?= $r['deskripsi'] ?></p>
                                <a href="/fasilitas/ruang/<?= $r['slug'];?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div id="menu1" class="tab-pane fade mt-3">
                <h3>Alat</h3>
                <?php foreach($alat as $a) : ?>
                <div class="row align-items-center justify-content-center mb-5">
                    <div class="column" style="width: 50px;">
                        <img src="<?= base_url()?>favicon.ico">
                    </div>
                    <div class="col-sm-10">
                        <div class="card">
                        <!-- <h5 class="card-header">Featured</h5> -->
                            <div class="card-body">
                                <h3 class="card-title"><?= $a['nama'] ?></h3>
                                <p class="card-text"><?= $a['deskripsi'] ?></p>
                                <a href="/fasilitas/alat/<?= $a['slug'];?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>