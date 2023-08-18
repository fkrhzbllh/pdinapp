<div class="container">
    <form id="sewaruangan" class="mt-3"
        action="/DashboardAdmin/saveUpdateSewaAlat/<?= $jadwal['id'] . '/' . $penyewa['id']?>"
        method="post">
        <?php echo csrf_field()?>
        <div class="row g-3">
            <h3>Ubah Sewa <?= $alat['nama']?>
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
                <label hidden for="alat" class="form-label">Ruang yang Dipinjam</label>
                <select hidden
                    class="form-select <?= (validation_show_error('alat')) ? 'is-invalid' : ''; ?>"
                    aria-label="Default select" id="alat" name="alat" type="hidden">
                    <option selected disabled>Pilih Alat</option>
                    <?php // foreach($alat as $r) :?>
                    <?php if($id_alat == $alat['id'] || old('alat') == $alat['id']) :?>
                    <option selected
                        value="<?= $alat['id'] ?>">
                        <?= $alat['nama'] ?>
                    </option>
                    <?php else : ?>
                    <option
                        value="<?= $alat['id'] ?>">
                        <?= $alat['nama'] ?>
                    </option>
                    <?php endif ?>
                    <?php // endforeach?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('alat'); ?>
                </div>
            </div>

            <?php $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-dd'); ?>
            <?php $formatter2 = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-ddThh:mm'); ?>

            <div class="row">
                <div class="col-sm-6">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                    <input id="tanggalMulai"
                        class="form-control <?= (validation_show_error('tanggalMulai')) ? 'is-invalid' : ''; ?>"
                        type="datetime-local" name="tanggalMulai"
                        value="<?= (old('tanggalMulai')) ? old('tanggalMulai') : $formatter2->format(date_create($jadwal['tgl_mulai_sewa'])) ?>"
                        step="3600" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                    <input id="tanggalSelesai"
                        class="form-control <?= (validation_show_error('tanggalSelesai')) ? 'is-invalid' : ''; ?>"
                        type="datetime-local" name="tanggalSelesai"
                        value="<?= (old('tanggalSelesai')) ? old('tanggalSelesai') : $formatter2->format(date_create($jadwal['tgl_akhir_sewa'])) ?>"
                        step="60" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesai'); ?>
                    </div>
                </div>
            </div>
        </div>

        <?= d($jadwal['tgl_mulai_sewa']) ?>

        <!-- <input id="tipe" class="form-control" type="hidden" name="tipe"
                value="<?= old('tipe') ?>" />
        -->

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
        </script>

        <button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit">Edit Sewa Ruangan</button>
</div>
</form>
</div>