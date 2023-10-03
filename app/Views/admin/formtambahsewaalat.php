<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="container">
    <form id="sewaalat" class="mt-3" action="/DashboardAdmin/saveTambahSewaAlat" method="post">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <h3>Sewa Alat</h3>
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama Penyewa</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ?>" name="nama" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <!-- <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username" placeholder="Username" required="">
                    <div class="invalid-feedback">
                        Your username is required.
                    </div>
                </div>
            </div> -->

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="you@example.com" name="email" value="<?= old('email') ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('email'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?= (validation_show_error('nomorTelepon')) ? 'is-invalid' : ''; ?>" id="nomorTelepon" placeholder="6281234567890" name="nomorTelepon" value="<?= old('nomorTelepon') ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('nomorTelepon'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text" class="form-control <?= (validation_show_error('instansi')) ? 'is-invalid' : ''; ?>" id="instansi" placeholder="" value="<?= old('instansi') ?>" name="instansi">
                <div class="invalid-feedback">
                    <?= validation_show_error('instansi'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('namaKegiatan')) ? 'is-invalid' : ''; ?>" id="kegiatan" placeholder="" value="<?= old('namaKegiatan') ?>" name="namaKegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('namaKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('deskripsiKegiatan')) ? 'is-invalid' : ''; ?>" id="deskripsiKegiatan" placeholder="" value="<?= old('deskripsiKegiatan') ?>" name="deskripsiKegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="alat" class="form-label">Alat yang Dipinjam &emsp;
                    <!-- <span id="ubahruangan">ubah</span> -->
                </label>
                <select class="form-select <?= (validation_show_error('alat')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="alat" name="alat">
                    <option selected disabled>Pilih Alat</option>
                    <?php foreach ($alat as $a) : ?>
                        <?php if ($id_alat == $a['id'] || old('alat') == $a['id']) : ?>
                            <option selected value="<?= $a['id'] ?>">
                                <?= $a['nama'] ?>
                            </option>
                        <?php else : ?>
                            <option value="<?= $a['id'] ?>">
                                <?= $a['nama'] ?>
                            </option>
                            <?= d($a['id']) ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('alat'); ?>
                </div>
            </div>

            <?php $formatter2 = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-ddThh:mm'); ?>

            <div class="row">
                <div class="col-sm-6">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                    <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulai" value="<?= old('tanggalMulai') ?>" step="3600" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                    <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesai" value="<?= old('tanggalSelesai') ?>" step="60" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesai'); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
        if ($("#ruangan").find("option:selected").attr("class") == "Pameran") {
            $("#Kantor,#Meeting,#Pengembangan").hide();
            $('#Pameran').show();
            $("#tipe").val($(this).find('option:selected').attr('class'));
        } else if ($('#ruangan').find('option:selected').attr('class') == 'Kantor') {
            $("#Pameran,#Meeting,#Pengembangan").hide();
            $('#Kantor').show();
            $("#tipe").val($(this).find('option:selected').attr('class'));
        } else if ($('#ruangan').find('option:selected').attr('class') == 'Meeting') {
            $("#Pameran,#Kantor,#Pengembangan").hide();
            $('#Meeting').show();
            $("#tipe").val($(this).find('option:selected').attr('class'));
        } else if ($('#ruangan').find('option:selected').attr('class') == 'Pengembangan') {
            $("#Pameran,#Kantor,#Meeting").hide();
            $('#Pengembangan').show();
            $("#tipe").val($(this).find('option:selected').attr('class'));
        } else {
            $("#Pameran,#Kantor,#Meeting,#Pengembangan").hide();
        }

        $('#ruangan').change(function() {
            $("#Pameran,#Kantor,#Meeting,#Pengembangan").hide();
            $('#' + $(this).find('option:selected').attr('class')).show();
            $("#tipe").val($(this).find('option:selected').attr('class'));
        });

        // if ($('$sewaruangan').length > 0)
        // {
        //     $('$sewaruangan').validate({
        //         rules: {
        //             nama: {
        //                 required: true
        //             },
        //             email: {
        //                 required: true,
        //                 email: true
        //             },
        //             nomorTelepon: {
        //                 required: true
        //             }
        //         }
        //     })
        // }

        // $('#tanggalMulai').date_default_timezone_set('id');
        // $('#tanggalSelesai').date_default_timezone_set('id');

        // var start = document.getElementById('tanggalMulai');
        // var end = document.getElementById('tanggalSelesai');

        // $('#tanggalMulai').change(function() {
        //     if ($('#tanggalMulai').val)
        //         $('#tanggalSelesai').min = $('#tanggalMulai').val;
        // }, false);
        // $('#tanggalSelesai').change(function() {
        //     if ($("#tanggalSelesai").val)
        //         $('#tanggalMulai').max = $("#tanggalSelesai").val;
        // }, false);
    });
</script>

<script>
    var start = document.getElementById('tanggalMulai');
    var end = document.getElementById('tanggalSelesai');
    var tanggal = new Date();
    var dd = String(tanggal.getDate()).padStart(2, '0');
    var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = tanggal.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;
    start.min = today;
    end.min = today;

    start.addEventListener('change', function() {
        if (start.value)
            end.min = start.value;
    }, false);
    end.addEventListener('change', function() {
        if (end.value)
            start.max = end.value;
    }, false);

    var start2 = document.getElementById('tanggalMulai2');
    var end2 = document.getElementById('tanggalSelesai2');
    // var tanggal = new Date();
    // var dd = String(tanggal.getDate()).padStart(2, '0');
    // var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
    // var yyyy = tanggal.getFullYear();

    // today = dd + '-' + mm + '-' + yyyy;
    // start2.min = new Date(today);
    start2.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;
    end2.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;
    // console.log(start2.min);

    start2.addEventListener('change', function() {
        if (start2.value)
            end2.min = start2.value;
    }, false);
    end2.addEventListener('change', function() {
        if (end2.value)
            start2.max = end2.value;
    }, false);

    var start3 = document.getElementById('tanggalMulai3');
    var end3 = document.getElementById('tanggalSelesai3');
    // var tanggal = new Date();
    // var dd = String(tanggal.getDate()).padStart(2, '0');
    // var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
    // var yyyy = tanggal.getFullYear();

    // var today = dd + '-' + mm + '-' + yyyy;
    // start.min = new Date(today);
    start3.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;
    end3.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;

    start3.addEventListener('change', function() {
        if (start3.value)
            end3.min = start3.value;
    }, false);
    end3.addEventListener('change', function() {
        if (end3.value)
            start3.max = end3.value;
    }, false);

    var start4 = document.getElementById('tanggalMulai4');
    var end4 = document.getElementById('tanggalSelesai4');
    // var tanggal = new Date();
    // var dd = String(tanggal.getDate()).padStart(2, '0');
    // var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
    // var yyyy = tanggal.getFullYear();

    // var today = dd + '-' + mm + '-' + yyyy;
    // start.min = new Date(today);
    start4.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;
    end4.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;

    start4.addEventListener('change', function() {
        if (start4.value)
            end4.min = start4.value;
    }, false);
    end4.addEventListener('change', function() {
        if (end4.value)
            start4.max = end4.value;
    }, false);
</script>

<button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit" id="submit">Sewa Ruangan</button>

<script>
    var submit = document.getElementById('submit');
    submit.addEventListener('click', function() {
        var ruangan = document.getElementById('ruangan');
        ruangan.removeAttribute('disabled');
    });
</script>
<?= $this->endSection() ?>