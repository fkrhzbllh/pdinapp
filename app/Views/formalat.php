<div class="container">
    <form id="formalat" class="mt-3" action="/admin/saveTambahAlat" method="post" enctype="multipart/form-data">
        <?php echo csrf_field()?>
        <div class="row g-3">
            <h3><?= $judul_halaman ?></h3>
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama Alat</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ?>" name="nama" autofocus>
                <div class="invalid-feedback">
                <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiAlat" class="form-label">Deskripsi Alat</label>
                <textarea class="form-control <?= (validation_show_error('deskripsiAlat')) ? 'is-invalid' : ''; ?>" id="deskripsiAlat" placeholder="" value="<?= old('deskripsiAlat') ?>" name="deskripsiAlat"></textarea>
                <div class="invalid-feedback">
                <?= validation_show_error('deskripsiAlat'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="biaya-sewa" class="form-label">Biaya Sewa</label>
                <div class="input-group">
                    <span class="input-group-text" >Rp</span>
                    <input type="number" step="1000" class="form-control biaya-sewa <?= (validation_show_error('fasilitas')) ? 'is-invalid' : ''; ?>" id="biaya-sewa" value="<?= old('biayasewa') ?>" name="biayasewa">
                </div>
                <div class="invalid-feedback">
                    <?= validation_show_error('biayasewa'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="fotoalat" class="form-label">Pilih Foto Alat</label>
                <input class="form-control <?= (validation_show_error('fotoalat[]')) ? 'is-invalid' : ''; ?>" type="file" id="fotoalat" multiple value="<?= old('fotoalat[]') ?>" name="fotoalat[]">
                <div class="invalid-feedback">
                    <?= validation_show_error('fotoalat[]'); ?>
                </div>
            </div>

            <button class="w-100 btn btn-primary mt-5" type="submit">Simpan</button>
        </div>
    </form>     
</div>

<script>
    $(document).ready(function () {
        $(".biaya-sewa").on("keyup", null, function () {
            var $input = $(this),
                value = $input.val(),
                // num = parseFloat(value).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                num = value.toLocaleString();

            // $input.siblings('.add-on').text('$' + num);
            $input.val(num);
        });
    });
</script>