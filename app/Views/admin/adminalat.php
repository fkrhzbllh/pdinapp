<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="p-5 col-12 bg-white">
    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
        </div>
    <?php endif; ?>

    <h3 class="mb-3">Alat</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <a class="btn btn-outline-danger mb-3" href="<?= base_url() . 'DashboardAdmin/tambah-alat' ?>">Tambah
                Alat</a>
        </div>
        <!-- input pencarian -->
        <!-- <div class="col-12 col-md-6">
            <form action="" method="post">
                <div class="input-group mb-3 ps-5">
                    <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Ruangan"
                        aria-label="" aria-describedby="" id="" name="keyword" />
                    <div class="input-group-append">
                        <div class="tooltip"></div>
                        <button class="btn btn-danger rounded-start-0" type="submit">
                            <span class="bi bi-search"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div> -->
    </div>
    <div class="table-responsive p-0">
        <table class="table align-middle table-bordered" id="tablealat" style="width:100%">
            <thead>
                <tr>
                    <!-- <td>No</td> -->
                    <th>Nama Alat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alat as $key => $a) : ?>
                    <tr>
                        <td><?= $a['nama'] ?></td>
                        <td><a href="/DashboardAdmin/update-alat/<?= $a['slug'] ?>" class="btn btn-warning">Edit</a>
                            <form action="/DashboardAdmin/alat/<?php echo $a['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php // echo $pager->links('artikel', 'pager')
    ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tablealat').DataTable({
            "columns": [{
                    "width": "80%"
                },
                null,
            ],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
<?= $this->endSection() ?>