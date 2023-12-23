<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="p-5 col-12 bg-white">
    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
        </div>
    <?php endif; ?>
    <h3 class="mb-3">Rilis Media</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <a class="btn btn-outline-danger mb-3" href="<?= base_url() . 'DashboardAdmin/tambah-rilis-media' ?>">Tambah
                Artikel</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-bordered" id="tableartikel" style="width:100%">
            <thead>
                <tr>
                    <td>No</td>
                    <th class="w-50">Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artikel as $key => $a) : ?>
                    <tr>
                        <td class="number"></td>
                        <td><?= $a['judul'] ?></td>
                        <td><?php $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                            echo $formatter->format(date_create($a['tgl_terbit'])) ?>
                        </td>
                        <td><?= $a['status'] ?></td>
                        <td><a href="/DashboardAdmin/update-rilis-media/<?= $a['slug'] ?>" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-title="Edit" id="edit">Edit</a>
                            <form action="/DashboardAdmin/rilismedia/<?php echo $a['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');" data-bs-toggle="tooltip" data-bs-title="Hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tableartikel').DataTable({
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ],
        });
    });

    $("#tableartikel").on('draw.dt', function() {
        let n = 0;
        $(".number").each(function() {
            $(this).html(++n);
        })
    })
</script>
<?= $this->endSection() ?>