<div class="p-5 col-12 bg-white">
    <?php if(session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
    </div>
    <?php endif; ?>
    <h3 class="mb-3">Kegiatan</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <a class="btn btn-outline-danger mb-3"
                href="<?= base_url() . 'DashboardAdmin/tambah-kegiatan'?>">Tambah
                Kegiatan</a>
        </div>
        <div class="col-12 col-md-6">
            <div class="row mb-3">
                <div class="col-6 col-sm-8 ms-auto">
                    <!-- input pencarian -->
                    <form action="" method="post">
                        <div class="input-group ">
                            <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Kegiatan"
                                aria-label="" aria-describedby="" id="" name="keyword" />
                            <div class="input-group-append">
                                <div class="tooltip"></div>
                                <button class="btn btn-danger rounded-start-0" type="submit">
                                    <span class="bi bi-search"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-middle table-bordered">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Kegiatan</td>
                    <td>Tanggal</td>
                    <td>Tipe</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kegiatan as $key => $a):?>
                <tr>
                    <td><?= ($pager_current - 1) * $per_page + ($key + 1) ?>
                    </td>
                    <td><?= $a['nama_kegiatan']?>
                    </td>
                    <td><?php $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                	echo $formatter->format(date_create($a['tgl_mulai']))?>
                    </td>
                    <td><?= $a['tipe_kegiatan'] ?>
                    </td>
                    <td><a href="/DashboardAdmin/update-kegiatan/<?= $a['slug'] ?>"
                            class="btn btn-warning">Edit</a>
                        <form
                            action="/DashboardAdmin/kegiatan/<?php echo $a['id']?>"
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
    <?= $pager->links('kegiatan', 'pager')?>
</div>