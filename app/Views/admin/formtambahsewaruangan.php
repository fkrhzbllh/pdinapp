<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Sewa Ruangan</h3>

    <!-- === Nav === -->
    <div class="col mt-1">
        <ul class="nav nav-tabs nav-justified" role="tablist" id="navs-tab-2">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="penyewa-lama" data-bs-toggle="tab" data-bs-target="#tab-penyewa-lama" role="tab" aria-controls="tab-penyewa-lama" aria-selected="true">Penyewa Lama</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="penyewa-baru" data-bs-toggle="tab" data-bs-target="#tab-penyewa-baru" role="tab" aria-controls="tab-penyewa-baru" aria-selected="false">Penyewa Baru</button>
            </li>
        </ul>
    </div>

    <!-- konten tab -->
    <div class="tab-content">

        <!-- tab tambah penyewa lama -->
        <div class="tab-pane active" id="tab-penyewa-lama" role="tabpanel" aria-labelledby="penyewa-lama" tabindex="0">
            <form id="tambahpenyewalama" class="mt-3" action="/DashboardAdmin/saveTambahSewaRuanganPenyewaLama" method="post">
                <?php echo csrf_field() ?>
                <div class="row g-3">
                    <?= \Config\Services::validation()->listErrors() ?>

                    <div class="col-12">
                        <label for="penyewa" class="form-label">Penyewa &emsp;
                        </label>
                        <select class="form-select <?= (validation_show_error('penyewa')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="penyewa" name="penyewa">
                            <option selected disabled>Pilih Penyewa</option>
                            <?php foreach ($penyewa as $p) : ?>

                                <option value="<?= $p['id'] ?>">
                                    <?= $p['nama'] . ' - ' . $p['email'] ?>
                                </option>

                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('penyewa'); ?>
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
                        <label for="ruangan" class="form-label">Ruang yang Dipinjam &emsp;
                            <!-- <span id="ubahruangan">ubah</span> -->
                        </label>
                        <select class="form-select <?= (validation_show_error('ruangan')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="ruangan" name="ruangan">
                            <option selected disabled>Pilih Ruangan</option>
                            <?php foreach ($ruangan as $r) : ?>
                                <?php if ($id_ruangan == $r['id'] || old('ruangan') == $r['id']) : ?>
                                    <option selected value="<?= $r['id'] ?>" class="<?= $r['tipe'] ?>">
                                        <?= $r['nama'] ?>
                                    </option>
                                <?php else : ?>
                                    <option value="<?= $r['id'] ?>" class="<?= $r['tipe'] ?>">
                                        <?= $r['nama'] ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ruangan'); ?>
                        </div>
                    </div>


                    <div class="Pameran mb-3" id="Pameran" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulaiPameran')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalMulaiPameran" value="<?= old('tanggalMulaiPameran') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiPameran'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesaiPameran')) ? 'is-invalid' : ''; ?>" type="date" date name="tanggalSelesaiPameran" value="<?= old('tanggalSelesaiPameran') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiPameran'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Kantor mb-3" id="Kantor" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai2" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai2" class="form-control <?= (validation_show_error('tanggalMulaiKantor')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiKantor" value="<?= old('tanggalMulaiKantor') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiKantor'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai2" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai2" class="form-control <?= (validation_show_error('tanggalSelesaiKantor')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiKantor" value="<?= old('tanggalSelesaiKantor') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiKantor'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Meeting mb-3" id="Meeting" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai3" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai3" class="form-control <?= (validation_show_error('tanggalMulaiMeeting')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiMeeting" value="<?= old('tanggalMulaiMeeting') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiMeeting'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai3" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai3" class="form-control <?= (validation_show_error('tanggalSelesaiMeeting')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiMeeting" value="<?= old('tanggalSelesaiMeeting') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiMeeting'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Pengembangan mb-3" id="Pengembangan" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai4" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai4" class="form-control <?= (validation_show_error('tanggalMulaiPengembangan')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiPengembangan" value="<?= old('tanggalMulaiPengembangan') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiPengembangan'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai4" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai4" class="form-control <?= (validation_show_error('tanggalSelesaiPengembangan')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiPengembangan" value="<?= old('tanggalSelesaiPengembangan') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiPengembangan'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input id="tipe" class="form-control" type="hidden" name="tipe" value="<?= old('tipe') ?>" />
                    <button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit" id="submit">Sewa Ruangan</button>

                </div>
            </form>
        </div>

        <!-- tab tambah penyewa baru -->
        <div class="tab-pane" id="tab-penyewa-baru" role="tabpanel" aria-labelledby="penyewa-baru" tabindex="0">
            <form id="tambahpenyewabaru" class="mt-3" action="/DashboardAdmin/saveTambahSewaRuanganPenyewaBaru" method="post">
                <?php echo csrf_field() ?>
                <div class="row g-3">
                    <?= \Config\Services::validation()->listErrors() ?>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama Penyewa</label>
                        <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ?>" name="nama" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>

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
                        <label for="kegiatanPenyewaBaru" class="form-label">Nama Kegiatan</label>
                        <input type="text" class="form-control <?= (validation_show_error('namaKegiatanPenyewaBaru')) ? 'is-invalid' : ''; ?>" id="kegiatanPenyewaBaru" placeholder="" value="<?= old('namaKegiatanPenyewaBaru') ?>" name="namaKegiatanPenyewaBaru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('namaKegiatanPenyewaBaru'); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="deskripsiKegiatanPenyewaBaru" class="form-label">Deskripsi Kegiatan</label>
                        <input type="text" class="form-control <?= (validation_show_error('deskripsiKegiatanPenyewaBaru')) ? 'is-invalid' : ''; ?>" id="deskripsiKegiatanPenyewaBaru" placeholder="" value="<?= old('deskripsiKegiatanPenyewaBaru') ?>" name="deskripsiKegiatanPenyewaBaru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('deskripsiKegiatanPenyewaBaru'); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="ruanganPenyewaBaru" class="form-label">Ruang yang Dipinjam &emsp;
                        </label>
                        <select class="form-select <?= (validation_show_error('ruanganPenyewaBaru')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="ruanganPenyewaBaru" name="ruanganPenyewaBaru">
                            <option selected disabled>Pilih Ruangan</option>
                            <?php foreach ($ruangan as $r) : ?>
                                <?php if ($id_ruangan == $r['id'] || old('ruanganPenyewaBaru') == $r['id']) : ?>
                                    <option selected value="<?= $r['id'] ?>" class="<?= $r['tipe'] . 'PenyewaBaru' ?>">
                                        <?= $r['nama'] ?>
                                    </option>
                                <?php else : ?>
                                    <option value="<?= $r['id'] ?>" class="<?= $r['tipe'] . 'PenyewaBaru' ?>">
                                        <?= $r['nama'] ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ruanganPenyewaBaru'); ?>
                        </div>
                    </div>

                    <!-- tanggal sewa tipe pameran penyewa baru -->
                    <div class="PameranPenyewaBaru mb-3" id="PameranPenyewaBaru" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai11" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai11" class="form-control <?= (validation_show_error('tanggalMulaiPameranPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalMulaiPameranPenyewaBaru" value="<?= old('tanggalMulaiPameranPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiPameranPenyewaBaru'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai11" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai11" class="form-control <?= (validation_show_error('tanggalSelesaiPameranPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="date" date name="tanggalSelesaiPameranPenyewaBaru" value="<?= old('tanggalSelesaiPameranPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiPameranPenyewaBaru'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tanggal sewa tipe kantor penyewa baru -->
                    <div class="KantorPenyewaBaru mb-3" id="KantorPenyewaBaru" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai22" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai22" class="form-control <?= (validation_show_error('tanggalMulaiKantorPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiKantorPenyewaBaru" value="<?= old('tanggalMulaiKantorPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiKantorPenyewaBaru'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai22" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai22" class="form-control <?= (validation_show_error('tanggalSelesaiKantorPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiKantorPenyewaBaru" value="<?= old('tanggalSelesaiKantorPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiKantorPenyewaBaru'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tanggal sewa tipe meeting penyewa baru -->
                    <div class="MeetingPenyewaBaru mb-3" id="MeetingPenyewaBaru" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai33" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai33" class="form-control <?= (validation_show_error('tanggalMulaiMeetingPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiMeetingPenyewaBaru" value="<?= old('tanggalMulaiMeetingPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiMeetingPenyewaBaru'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai33" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai33" class="form-control <?= (validation_show_error('tanggalSelesaiMeetingPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiMeetingPenyewaBaru" value="<?= old('tanggalSelesaiMeetingPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiMeetingPenyewaBaru'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tanggal sewa tipe pengembangan penyewa baru -->
                    <div class="PengembanganPenyewaBaru mb-3" id="PengembanganPenyewaBaru" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tanggalMulai44" class="form-label">Tanggal Mulai</label>
                                <input id="tanggalMulai44" class="form-control <?= (validation_show_error('tanggalMulaiPengembanganPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiPengembanganPenyewaBaru" value="<?= old('tanggalMulaiPengembanganPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalMulaiPengembanganPenyewaBaru'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggalSelesai44" class="form-label">Tanggal Selesai</label>
                                <input id="tanggalSelesai44" class="form-control <?= (validation_show_error('tanggalSelesaiPengembanganPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiPengembanganPenyewaBaru" value="<?= old('tanggalSelesaiPengembanganPenyewaBaru') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggalSelesaiPengembanganPenyewaBaru'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input id="tipePenyewaBaru" class="form-control" type="hidden" name="tipePenyewaBaru" value="<?= old('tipePenyewaBaru') ?>" />
                    <button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit" id="submitPenyewaBaru">Sewa Ruangan</button>

                </div>
            </form>
        </div>
    </div>


</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Calendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/locales-all.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>

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


        if ($("#ruanganPenyewaBaru").find("option:selected").attr("class") == "PameranPenyewaBaru") {
            $("#KantorPenyewaBaru,#MeetingPenyewaBaru,#PengembanganPenyewaBaru").hide();
            $('#PameranPenyewaBaru').show();
            $("#tipePenyewaBaru").val($(this).find('option:selected').attr('class'));
        } else if ($('#ruanganPenyewaBaru').find('option:selected').attr('class') == 'KantorPenyewaBaru') {
            $("#PameranPenyewaBaru,#MeetingPenyewaBaru,#PengembanganPenyewaBaru").hide();
            $('#KantorPenyewaBaru').show();
            $("#tipePenyewaBaru").val($(this).find('option:selected').attr('class'));
        } else if ($('#ruanganPenyewaBaru').find('option:selected').attr('class') == 'MeetingPenyewaBaru') {
            $("#PameranPenyewaBaru,#KantorPenyewaBaru,#PengembanganPenyewaBaru").hide();
            $('#MeetingPenyewaBaru').show();
            $("#tipePenyewaBaru").val($(this).find('option:selected').attr('class'));
        } else if ($('#ruanganPenyewaBaru').find('option:selected').attr('class') == 'PengembanganPenyewaBaru') {
            $("#PameranPenyewaBaru,#KantorPenyewaBaru,#MeetingPenyewaBaru").hide();
            $('#PengembanganPenyewaBaru').show();
            $("#tipePenyewaBaru").val($(this).find('option:selected').attr('class'));
        } else {
            $("#PameranPenyewaBaru,#KantorPenyewaBaru,#MeetingPenyewaBaru,#PengembanganPenyewaBaru").hide();
        }

        $('#ruanganPenyewaBaru').change(function() {
            $("#PameranPenyewaBaru,#KantorPenyewaBaru,#MeetingPenyewaBaru,#PengembanganPenyewaBaru").hide();
            $('#' + $(this).find('option:selected').attr('class')).show();
            $("#tipePenyewaBaru").val($(this).find('option:selected').attr('class'));
        });
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

    start2.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;
    end2.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;

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

<script>
    var start = document.getElementById('tanggalMulai11');
    var end = document.getElementById('tanggalSelesai11');
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

    var start2 = document.getElementById('tanggalMulai22');
    var end2 = document.getElementById('tanggalSelesai22');

    start2.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;
    end2.min = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));;

    start2.addEventListener('change', function() {
        if (start2.value)
            end2.min = start2.value;
    }, false);
    end2.addEventListener('change', function() {
        if (end2.value)
            start2.max = end2.value;
    }, false);

    var start3 = document.getElementById('tanggalMulai33');
    var end3 = document.getElementById('tanggalSelesai33');

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

    var start4 = document.getElementById('tanggalMulai44');
    var end4 = document.getElementById('tanggalSelesai44');

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

<script>
    var submit = document.getElementById('submit');
    submit.addEventListener('click', function() {
        var ruangan = document.getElementById('ruangan');
        ruangan.removeAttribute('disabled');
    });
</script>

<script>
    var submit = document.getElementById('submitPenyewaBaru');
    submit.addEventListener('click', function() {
        var ruangan = document.getElementById('ruanganRuanganPenyewaBaru');
        ruangan.removeAttribute('disabled');
    });
</script>
<?= $this->endSection() ?>