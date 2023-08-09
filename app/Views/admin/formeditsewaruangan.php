<div class="container">
    <form id="sewaruangan" class="mt-3"
        action="/DashboardAdmin/saveUpdateSewaRuangan/<?= $jadwal['id'] . '/' . $penyewa['id']?>"
        method="post">
        <?php echo csrf_field()?>
        <div class="row g-3">
            <h3>Ubah Sewa <?= $ruangan['nama']?>
            </h3>
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama Penyewa</label>
                <input type="text"
                    class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>"
                    id="nama" placeholder=""
                    value="<?= (old('nama')) ? old('nama') : $penyewa['nama'] ?>"
                    name="nama" autofocus>
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
                <input type="email"
                    class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>"
                    id="email" placeholder="you@example.com" name="email"
                    value="<?= (old('email')) ? old('email') : $penyewa['email'] ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('email'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                <input type="text"
                    class="form-control <?= (validation_show_error('nomorTelepon')) ? 'is-invalid' : ''; ?>"
                    id="nomorTelepon" placeholder="6281234567890" name="nomorTelepon"
                    value="<?= (old('nomorTelepon')) ? old('nomorTelepon') : $penyewa['kontak'] ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('nomorTelepon'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text"
                    class="form-control <?= (validation_show_error('instansi')) ? 'is-invalid' : ''; ?>"
                    id="instansi" placeholder=""
                    value="<?= (old('instansi')) ? old('instansi') : $penyewa['nama_instansi'] ?>"
                    name="instansi">
                <div class="invalid-feedback">
                    <?= validation_show_error('instansi'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text"
                    class="form-control <?= (validation_show_error('namaKegiatan')) ? 'is-invalid' : ''; ?>"
                    id="kegiatan" placeholder=""
                    value="<?= (old('namaKegiatan')) ? old('namaKegiatan') : $jadwal['nama_kegiatan'] ?>"
                    name="namaKegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('namaKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                <input type="text"
                    class="form-control <?= (validation_show_error('deskripsiKegiatan')) ? 'is-invalid' : ''; ?>"
                    id="deskripsiKegiatan" placeholder=""
                    value="<?= (old('deskripsiKegiatan')) ? old('deskripsiKegiatan') : $jadwal['deskripsi'] ?>"
                    name="deskripsiKegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label hidden for="ruangan" class="form-label">Ruang yang Dipinjam</label>
                <select hidden
                    class="form-select <?= (validation_show_error('ruangan')) ? 'is-invalid' : ''; ?>"
                    aria-label="Default select" id="ruangan" name="ruangan" type="hidden">
                    <option selected disabled>Pilih Ruangan</option>
                    <?php // foreach($ruangan as $r) :?>
                    <?php if($id_ruangan == $ruangan['id'] || old('ruangan') == $ruangan['id']) :?>
                    <option selected
                        value="<?= $ruangan['id'] ?>"
                        class="<?= $ruangan['tipe'] ?>">
                        <?= $ruangan['nama'] ?>
                    </option>
                    <?php else : ?>
                    <option
                        value="<?= $ruangan['id'] ?>"
                        class="<?= $ruangan['tipe'] ?>">
                        <?= $ruangan['nama'] ?>
                    </option>
                    <?php endif ?>
                    <?php // endforeach?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('ruangan'); ?>
                </div>
            </div>

            <?php $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-dd'); ?>
            <?php $formatter2 = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-ddThh:mm'); ?>

            <div class="Pameran mb-3" id="Pameran" style="display: none;">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input id="tanggalMulai"
                            class="form-control <?= (validation_show_error('tanggalMulaiPameran')) ? 'is-invalid' : ''; ?>"
                            type="date" name="tanggalMulaiPameran"
                            value="<?= (old('tanggalMulaiPameran')) ? old('tanggalMulaiPameran') : $formatter->format(date_create($jadwal['tgl_mulai_sewa'])) ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggalMulaiPameran'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai"
                            class="form-control <?= (validation_show_error('tanggalSelesaiPameran')) ? 'is-invalid' : ''; ?>"
                            type="date" date name="tanggalSelesaiPameran"
                            value="<?= (old('tanggalSelesaiPameran')) ? old('tanggalSelesaiPameran') : $formatter->format(date_create($jadwal['tgl_akhir_sewa'])) ?>" />
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
                        <input id="tanggalMulai2"
                            class="form-control <?= (validation_show_error('tanggalMulaiKantor')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tanggalMulaiKantor"
                            value="<?= (old('tanggalMulaiKantor')) ? old('tanggalMulaiKantor') : $formatter2->format(date_create($jadwal['tgl_mulai_sewa'])) ?>"
                            step="3600" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggalMulaiKantor'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai2" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai2"
                            class="form-control <?= (validation_show_error('tanggalSelesaiKantor')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tanggalSelesaiKantor"
                            value="<?= (old('tanggalSelesaiKantor')) ? old('tanggalSelesaiKantor') : $formatter2->format(date_create($jadwal['tgl_akhir_sewa'])) ?>"
                            step="60" />
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
                        <input id="tanggalMulai3"
                            class="form-control <?= (validation_show_error('tanggalMulaiMeeting')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tanggalMulaiMeeting"
                            value="<?= (old('tanggalMulaiMeeting')) ? old('tanggalMulaiMeeting') : $formatter2->format(date_create($jadwal['tgl_mulai_sewa'])) ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggalMulaiMeeting'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai3" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai3"
                            class="form-control <?= (validation_show_error('tanggalSelesaiMeeting')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tanggalSelesaiMeeting"
                            value="<?= (old('tanggalSelesaiMeeting')) ? old('tanggalSelesaiMeeting') : $formatter2->format(date_create($jadwal['tgl_akhir_sewa'])) ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggalSelesaiMeeting'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Pengembangan mb-3" id="Pengembangan" style="display: none;">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="tanggalMulai3" class="form-label">Tanggal Mulai</label>
                        <input id="tanggalMulai3"
                            class="form-control <?= (validation_show_error('tanggalMulaiPengembangan')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tanggalMulaiPengembangan"
                            value="<?= (old('tanggalMulaiPengembangan')) ? old('tanggalMulaiPengembangan') : date_create($jadwal['tgl_mulai_sewa'])->format('Y-m-d H:i') ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggalMulaiPengembangan'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai3" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai3"
                            class="form-control <?= (validation_show_error('tanggalSelesaiPengembangan')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tanggalSelesaiPengembangan"
                            value="<?= (old('tanggalSelesaiPengembangan')) ? old('tanggalSelesaiPengembangan') : date_create($jadwal['tgl_akhir_sewa'])->format('Y-m-d H:i') ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggalSelesaiPengembangan'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= d($jadwal['tgl_mulai_sewa']) ?>

            <input id="tipe" class="form-control" type="hidden" name="tipe"
                value="<?= old('tipe') ?>" />

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

                start.addEventListener('change', function() {
                    if (start.value)
                        end.min = start.value;
                }, false);
                end.addEventLiseter('change', function() {
                    if (end.value)
                        start.max = end.value;
                }, false);

                var start2 = document.getElementById('tanggalMulai2');
                var end2 = document.getElementById('tanggalSelesai2');
                // var tanggal = new Date();
                // var dd = String(tanggal.getDate()).padStart(2, '0');
                // var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
                // var yyyy = tanggal.getFullYear();

                // var today = dd + '-' + mm + '-' + yyyy;
                // start2.min = new Date(today);

                start2.addEventListener('change', function() {
                    if (start2.value)
                        end2.min = start2.value;
                }, false);
                end2.addEventLiseter('change', function() {
                    if (end2.value)
                        start2.max = end2.value;
                }, false);

                var start = document.getElementById('tanggalMulai');
                var end = document.getElementById('tanggalSelesai');
                // var tanggal = new Date();
                // var dd = String(tanggal.getDate()).padStart(2, '0');
                // var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
                // var yyyy = tanggal.getFullYear();

                // var today = dd + '-' + mm + '-' + yyyy;
                // start.min = new Date(today);

                start.addEventListener('change', function() {
                    if (start.value)
                        end.min = start.value;
                }, false);
                end.addEventLiseter('change', function() {
                    if (end.value)
                        start.max = end.value;
                }, false);
            </script>

            <button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit">Edit Sewa Ruangan</button>
        </div>
    </form>
</div>