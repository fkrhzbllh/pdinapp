<!-- ======= Judul Section ======= -->
<section id="background-hitam-atas" class="d-flex align-items-center">
    <div class="container">
        <div class="text-center">
            <h2 class="text-light my-4">Tambah Kegiatan</h2>
            <p class="text-light lh-base">
                Tambah data kegiatan
            </p>
        </div>
    </div>
</section>
<!-- End Hero -->

<section id="isi-section">
    <div class="container p-3">
        <div class="bg-white rounded-5 py-5 px-5 shadow-sm" id="">
            <form id="formkegiatan" class="mt-3" action="/DashboardAdmin/saveTambahKegiatan" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field()?>
                <div class="row g-3">
                    <!-- <h3><?php // $judul_halaman?></h3> -->
                    <?= \Config\Services::validation()->listErrors() ?>
                    <div class="col-12">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text"
                            class="form-control <?= (validation_show_error('nama_kegiatan')) ? 'is-invalid' : ''; ?>"
                            id="nama_kegiatan" placeholder=""
                            value="<?= old('nama_kegiatan') ?>"
                            name="nama_kegiatan" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_kegiatan'); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                        <input type="text"
                            class="form-control <?= (validation_show_error('jenis_kegiatan')) ? 'is-invalid' : ''; ?>"
                            id="jenis_kegiatan" placeholder=""
                            value="<?= old('jenis_kegiatan') ?>"
                            name="jenis_kegiatan">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jenis_kegiatan'); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="tipe_kegiatan" class="form-label">Tipe Kegiatan</label>
                        <select
                            class="form-select <?= (validation_show_error('tipe_kegiatan')) ? 'is-invalid' : ''; ?>"
                            aria-label="Default select" id="tipe_kegiatan" name="tipe_kegiatan">
                            <option selected disabled>Pilih Tipe</option>
                            <?php if (old('tipe_kegiatan') == 'Online') :?>
                            <option selected value="Online">Online</option>
                            <option value="Offline">Offline</option>
                            <option value="Online dan Offline">Online dan Offline</option>
                            <?php elseif (old('tipe_kegiatan') == 'Offline') :?>
                            <option value="Online">Online</option>
                            <option selected value="Offline">Offline</option>
                            <option value="Online dan Offline">Online dan Offline</option>
                            <?php elseif (old('tipe_kegiatan') == 'Online dan Offline') :?>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                            <option selected value="Online dan Offline">Online dan Offline</option>
                            <?php else :?>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                            <option value="Online dan Offline">Online dan Offline</option>
                            <?php endif; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('tipe_kegiatan'); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="tempat" class="form-label">Tempat</label>
                        <input type="text"
                            class="form-control <?= (validation_show_error('tempat')) ? 'is-invalid' : ''; ?>"
                            id="tempat" placeholder=""
                            value="<?= old('tempat') ?>"
                            name="tempat">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tempat'); ?>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                        <input id="tgl_mulai"
                            class="form-control <?= (validation_show_error('tgl_mulai')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" name="tgl_mulai"
                            value="<?= old('tgl_mulai') ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tgl_mulai'); ?>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                        <input id="tgl_selesai"
                            class="form-control <?= (validation_show_error('tgl_selesai')) ? 'is-invalid' : ''; ?>"
                            type="datetime-local" date name="tgl_selesai"
                            value="<?= old('tgl_selesai') ?>" />
                        <div class="invalid-feedback">
                            <?= validation_show_error('tgl_selesai'); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="link_pendaftaran" class="form-label">Link Pendaftaran</label>
                        <input type="text"
                            class="form-control <?= (validation_show_error('link_pendaftaran')) ? 'is-invalid' : ''; ?>"
                            id="link_pendaftaran" placeholder=""
                            value="<?= old('link_pendaftaran') ?>"
                            name="link_pendaftaran">
                        <div class="invalid-feedback">
                            <?= validation_show_error('link_pendaftaran'); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="link_virtual" class="form-label">Link Virtual</label>
                        <input type="text"
                            class="form-control <?= (validation_show_error('link_virtual')) ? 'is-invalid' : ''; ?>"
                            id="link_virtual" placeholder=""
                            value="<?= old('link_virtual') ?>"
                            name="link_virtual">
                        <div class="invalid-feedback">
                            <?= validation_show_error('link_virtual'); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="poster" class="form-label">Pilih Foto Poster</label>
                        <input
                            class="form-control <?= (validation_show_error('poster')) ? 'is-invalid' : ''; ?>"
                            type="file" id="poster"
                            value="<?= old('poster') ?>"
                            name="poster" onchange="onFileUpload(this);">
                        <div class="invalid-feedback">
                            <?= validation_show_error('poster'); ?>
                        </div>
                    </div>
                    <!-- preview foto -->
                    <div class="filearray" id="preview">

                    </div>



                    <button class="w-100 btn btn-primary mt-5" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>

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
                    // image.height = 100;
                    image.width = 100;
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