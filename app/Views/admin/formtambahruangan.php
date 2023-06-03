<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Tambah Ruangan</h3>
    <form id="formruangan" class="mt-3" action="/DashboardAdmin/saveTambahRuangan" method="post"
        enctype="multipart/form-data">
        <?php echo csrf_field()?>
        <div class="row g-3">
            <!-- <h3><?php // $judul_halaman?></h3> -->
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama Ruangan</label>
                <input type="text"
                    class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>"
                    id="nama" placeholder=""
                    value="<?= old('nama') ?>"
                    name="nama" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiRuangan" class="form-label">Deskripsi Ruangan</label>
                <textarea
                    class="form-control <?= (validation_show_error('deskripsiRuangan')) ? 'is-invalid' : ''; ?>"
                    id="deskripsiRuangan" placeholder=""
                    value="<?= old('deskripsiRuangan') ?>"
                    name="deskripsiRuangan"><?= old('deskripsiRuangan') ?></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiRuangan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="kegunaan" class="form-label">Kegunaan</label>
                <textarea
                    class="form-control <?= (validation_show_error('kegunaan')) ? 'is-invalid' : ''; ?>"
                    id="kegunaan" placeholder=""
                    value="<?= old('kegunaan') ?>"
                    name="kegunaan"></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('kegunaan'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="tipe" class="form-label">Tipe Ruangan</label>
                <select
                    class="form-select <?= (validation_show_error('tipe')) ? 'is-invalid' : ''; ?>"
                    aria-label="Default select" id="tipe" name="tipe">
                    <option selected disabled>Pilih Tipe</option>
                    <?php if (old('tipe') == 'Pameran') :?>
                    <option selected value="Pameran">Pameran</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Meeting">Ruang Pertemuan</option>
                    <option value="Pengembangan">Ruang Pengembangan</option>
                    <option value="Lainnya">Lainnya</option>
                    <?php elseif (old('tipe') == 'Kantor') :?>
                    <option value="Pameran">Pameran</option>
                    <option selected value="Kantor">Kantor</option>
                    <option value="Meeting">Ruang Pertemuan</option>
                    <option value="Pengembangan">Ruang Pengembangan</option>
                    <option value="Lainnya">Lainnya</option>
                    <?php elseif (old('tipe') == 'Meeting') :?>
                    <option value="Pameran">Pameran</option>
                    <option value="Kantor">Kantor</option>
                    <option selected value="Meeting">Ruang Pertemuan</option>
                    <option value="Pengembangan">Ruang Pengembangan</option>
                    <option value="Lainnya">Lainnya</option>
                    <?php elseif (old('tipe') == 'Pengembangan') :?>
                    <option value="Pameran">Pameran</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Meeting">Ruang Pertemuan</option>
                    <option selected value="Pengembangan">Ruang Pengembangan</option>
                    <option value="Lainnya">Lainnya</option>
                    <?php elseif (old('tipe') == 'Lainnya') :?>
                    <option value="Pameran">Pameran</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Meeting">Ruang Pertemuan</option>
                    <option value="Pengembangan">Ruang Pengembangan</option>
                    <option selected value="Lainnya">Lainnya</option>
                    <?php else :?>
                    <option value="Pameran">Pameran</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Meeting">Ruang Pertemuan</option>
                    <option value="Pengembangan">Ruang Pengembangan</option>
                    <option value="Lainnya">Lainnya</option>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('tipe'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="lantai" class="form-label">Lantai</label>
                <select
                    class="form-select <?= (validation_show_error('lantai')) ? 'is-invalid' : ''; ?>"
                    aria-label="Default select" id="lantai" name="lantai">
                    <option selected disabled>Pilih Lantai</option>
                    <?php if (old('lantai') == '0') :?>
                    <option selected value="0">Ground Floor</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <?php elseif (old('lantai') == '1') :?>
                    <option value="0">Ground Floor</option>
                    <option selected value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <?php elseif (old('lantai') == '2') :?>
                    <option value="0">Ground Floor</option>
                    <option value="1">1</option>
                    <option selected value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <?php elseif (old('lantai') == '3') :?>
                    <option value="0">Ground Floor</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option selected value="3">3</option>
                    <option value="4">4</option>
                    <?php elseif (old('lantai') == '4') :?>
                    <option value="0">Ground Floor</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option selected value="4">4</option>
                    <?php else :?>
                    <option value="0">Ground Floor</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('lantai'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number"
                    class="form-control <?= (validation_show_error('kapasitas')) ? 'is-invalid' : ''; ?>"
                    id="kapasitas" placeholder=""
                    value="<?= old('kapasitas') ?>"
                    name="kapasitas">
                <div class="invalid-feedback">
                    <?= validation_show_error('kapasitas'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="panjang" class="form-label">Panjang Ruangan (m)</label>
                <input type="number"
                    class="form-control <?= (validation_show_error('panjang')) ? 'is-invalid' : ''; ?>"
                    id="panjang" placeholder=""
                    value="<?= old('panjang') ?>"
                    name="panjang">
                <div class="invalid-feedback">
                    <?= validation_show_error('panjang'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="lebar" class="form-label">Lebar Ruangan (m)</label>
                <input type="number"
                    class="form-control <?= (validation_show_error('lebar')) ? 'is-invalid' : ''; ?>"
                    id="lebar" placeholder=""
                    value="<?= old('lebar') ?>"
                    name="lebar">
                <div class="invalid-feedback">
                    <?= validation_show_error('lebar'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="tinggi" class="form-label">Tinggi Ruangan (m)</label>
                <input type="number"
                    class="form-control <?= (validation_show_error('tinggi')) ? 'is-invalid' : ''; ?>"
                    id="tinggi" placeholder=""
                    value="<?= old('tinggi') ?>"
                    name="tinggi">
                <div class="invalid-feedback">
                    <?= validation_show_error('tinggi'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="biaya-sewa" class="form-label">Biaya Sewa</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" step="1000"
                        class="form-control biaya-sewa <?= (validation_show_error('fasilitas')) ? 'is-invalid' : ''; ?>"
                        id="biaya-sewa"
                        value="<?= old('biayasewa') ?>"
                        name="biayasewa">
                </div>
                <div class="invalid-feedback">
                    <?= validation_show_error('biayasewa'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="fotoruangan" class="form-label">Pilih Foto Ruangan</label>
                <input
                    class="form-control <?= (validation_show_error('fotoruangan[]')) ? 'is-invalid' : ''; ?>"
                    type="file" id="fotoruangan" multiple
                    value="<?= old('fotoruangan[]') ?>"
                    name="fotoruangan[]" onchange="onFileUpload(this);">
                <div class="invalid-feedback">
                    <?= validation_show_error('fotoruangan[]'); ?>
                </div>
            </div>
            <!-- preview foto -->
            <div class="filearray" id="preview">

            </div>



            <button class="w-100 btn btn-primary mt-5" type="submit">Simpan</button>
        </div>
    </form>
</div>

<!-- preview foto -->
<script>
    function onFileUpload(input) {

        const preview = document.querySelector("#preview");
        const files = document.querySelector("input[type=file]").files;

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    image.src = this.result;
                    preview.appendChild(image);
                };

                reader.readAsDataURL(file);
            }
        }

        if (files) {
            while (preview.lastElementChild) {
                preview.removeChild(preview.lastElementChild);
            }
            Array.prototype.forEach.call(files, readAndPreview);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $(".biaya-sewa").on("keyup", null, function() {
            var $input = $(this),
                value = $input.val(),
                // num = parseFloat(value).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                num = value.toLocaleString();

            // $input.siblings('.add-on').text('$' + num);
            $input.val(num);
        });
    });
</script>