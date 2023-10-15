<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="p-5 col-12 bg-white">
    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
        </div>
    <?php endif; ?>

    <h3 class="mb-3">Manajemen User</h3>

    <div class="table-responsive p-0">
        <table class="table align-middle table-bordered" id="tableuser" style="width:100%">
            <thead>
                <tr>
                    <!-- <td>No</td> -->
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Grup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $key => $a) : ?>
                    <tr>
                        <!-- <td><?php // echo ($pager_current - 1) * $per_page + ($key + 1)
                                    ?>
                    -->
                        </td>
                        <td><?= $a['username'] ?></td>
                        <td><?= $a['first_name'] . " " . $a['last_name'] ?></td>
                        <td><?= $a['group'] ?></td>
                        <td>
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

            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
<?= $this->endSection() ?>