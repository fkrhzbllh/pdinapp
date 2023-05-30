<!-- ======= Judul Section ======= -->
<section id="background-hitam-atas" class="d-flex align-items-center">
    <div class="container">
        <div class="text-center">
            <h2 class="text-light my-4">Tambah Alat</h2>
            <p class="text-light lh-base">
                Tambah data alat
            </p>
        </div>
    </div>
</section>
<!-- End Hero -->

<section id="isi-section">
    <div class="container p-3">
        <div class="bg-white rounded-5 py-5 px-5 shadow-sm" id="">
            <form id="formalat" class="mt-3" action="/admin/saveTambahAlat" method="post" enctype="multipart/form-data">
                <?php echo csrf_field()?>
                <div class="row g-3">
                    <h3><?= $judul_halaman ?></h3>
                    <?= \Config\Services::validation()->listErrors() ?>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama Alat</label>
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
                        <label for="deskripsiAlat" class="form-label">Deskripsi Alat</label>
                        <textarea
                            class="form-control <?= (validation_show_error('deskripsiAlat')) ? 'is-invalid' : ''; ?>"
                            id="deskripsiAlat" placeholder=""
                            value="<?= old('deskripsiAlat') ?>"
                            name="deskripsiAlat"></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('deskripsiAlat'); ?>
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
                        <label for="fotoalat" class="form-label">Pilih Foto Alat</label>
                        <input
                            class="form-control <?= (validation_show_error('fotoalat[]')) ? 'is-invalid' : ''; ?>"
                            type="file" id="fotoalat" multiple
                            value="<?= old('fotoalat[]') ?>"
                            name="fotoalat[]" onchange="onFileUpload(this);">
                        <div class="invalid-feedback">
                            <?= validation_show_error('fotoalat[]'); ?>
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