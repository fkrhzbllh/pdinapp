<div class="container">
    <div class="row">
        <div class="column">
            <h1 class="mt-3">fasilitas</h1>

            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-ruangan-tab" data-bs-toggle="pill" data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan" aria-selected="true">Ruangan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill" data-bs-target="#pills-alat" type="button" role="tab" aria-controls="pills-alat" aria-selected="false">Alat</button>
                </li>
                
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel" aria-labelledby="pills-ruangan-tab" tabindex="0">
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
                <div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab" tabindex="0">
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
</div>