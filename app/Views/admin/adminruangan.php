<div class="p-5 col-12 bg-white">
    <?php if(session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
    </div>
    <?php endif; ?>
    <h3 class="mb-3">Ruangan</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <a class="btn btn-outline-danger mb-3"
                href="<?= base_url() . 'DashboardAdmin/tambah-ruangan'?>">Tambah
                Ruangan</a>
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
    <div class="table-responsive">
        <table class="table align-middle table-bordered" id="tableruangan">
            <thead>
                <tr>
                    <!-- <td>No</td> -->
                    <td>Nama Ruangan</td>
                    <td>Tipe</td>
                    <td>Lantai</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ruangan as $key => $a):?>
                <tr>
                    <!-- <td><?php // echo ($pager_current - 1) * $per_page + ($key + 1)?>
                    -->
                    </td>
                    <td><?= $a['nama']?></td>
                    <td><?= $a['tipe']?>
                    </td>
                    <td><?= ($a['lantai'] == 0) ? '0 (Floor Ground)' : $a['lantai'] ?>
                    </td>
                    <td><a href="/DashboardAdmin/update-ruangan/<?= $a['slug'] ?>"
                            class="btn btn-warning">Edit</a>
                        <form
                            action="/DashboardAdmin/ruangan/<?php echo $a['id']?>"
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
    <?php // echo $pager->links('artikel', 'pager')?>
</div>

<script>
    $(document).ready(function() {
        $('#tableruangan').DataTable();
    });
</script>