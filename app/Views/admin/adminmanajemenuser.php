<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="p-5 col-12 bg-white">
    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
        </div>
    <?php endif; ?>

    <h3 class="mb-3">Manajemen User</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <a class="btn btn-outline-danger mb-3" href="<?= base_url() . 'DashboardAdmin/tambah-user' ?>">Tambah User</a>
        </div>
    </div>
    <div class="table-responsive p-0">
        <table class="table align-middle table-bordered" id="tableuser" style="width:100%">
            <thead>
                <tr>
                    <td>No</td>
                    <th>Nama</th>
                    <th>Grup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $key => $a) : ?>
                    <tr>
                        <td class="number"></td>
                        <td><?= $a['first_name'] . " " . $a['last_name'] ?></td>
                        <td><?= $a['group'] ?></td>
                        <td>
                            <!-- <a href="/DashboardAdmin/update-user/<?= $a['uuid'] ?>" class="btn btn-warning">Edit</a> -->
                            <form action="/DashboardAdmin/update-user" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="uuid" value="<?php echo $a['uuid'] ?>">
                                <button class="btn btn-warning" type="submit">Edit</button>
                            </form>
                            <form action="/DashboardAdmin/manajemen-user/<?php echo $a['id'] ?>" method="post" class="d-inline">
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
        $('#tableuser').DataTable({
            order: [
                [1, 'asc']
            ],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            }],
        });

        $("#tableuser").on('draw.dt', function() {
            let n = 0;
            $(".number").each(function() {
                $(this).html(++n);
            })
        })
    });
</script>
<?= $this->endSection() ?>