<div class="p-5 col-12 bg-white">
    <?php if(session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
    </div>
    <?php endif; ?>
    <h3 class="mb-3">Rilis Media</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <a class="btn btn-outline-danger mb-3"
                href="<?= base_url() . 'DashboardAdmin/tambah-rilis-media'?>">Tambah
                Artikel</a>
        </div>
        <div class="col-12 col-md-6">
            <!-- <div class="row mb-3">
                <div class="col-12 col-sm-12"> -->
            <!-- input pencarian -->
            <form action="" method="post">
                <div class="input-group mb-3 ps-5">
                    <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Artikel"
                        aria-label="" aria-describedby="" id="" name="keyword" />
                    <div class="input-group-append">
                        <div class="tooltip"></div>
                        <button class="btn btn-danger rounded-start-0" type="submit">
                            <span class="bi bi-search"></span>
                        </button>
                    </div>
                </div>
            </form>
            <!-- </div>
            </div> -->
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-middle table-bordered">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Judul</td>
                    <td>Tanggal</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artikel as $key => $a):?>
                <tr>
                    <td><?= ($pager_current - 1) * $per_page + ($key + 1) ?>
                    </td>
                    <td><?= $a['judul']?></td>
                    <td><?= $a['tgl_terbit']?>
                    </td>
                    <td><?= $a['status']?></td>
                    <td><a href="/DasboardAdmin/update-rilis-media/<?= $a['id'] ?>"
                            class="btn btn-warning">Edit</a>
                        <form
                            action="/DashboarAdmin/rilismedia/<?php echo $a['id']?>"
                            method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
    <?= $pager->links('artikel', 'pager')?>
</div>