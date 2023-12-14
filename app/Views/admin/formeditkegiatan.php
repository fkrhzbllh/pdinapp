<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Ubah Kegiatan</h3>
    <form id="formkegiatan" class="mt-3" action="/DashboardAdmin/saveUpdateKegiatan/<?= $kegiatan['id'] ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <!-- <h3><?php // $judul_halaman
                        ?></h3> -->
            <?= \Config\Services::validation()->listErrors() ?>

            <div class="col-12">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('nama_kegiatan')) ? 'is-invalid' : ''; ?>" id="nama_kegiatan" placeholder="" value="<?= (old('nama_kegiatan')) ? old('nama_kegiatan') : $kegiatan['nama_kegiatan'] ?>" name="nama_kegiatan" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('nama_kegiatan'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('jenis_kegiatan')) ? 'is-invalid' : ''; ?>" id="jenis_kegiatan" placeholder="" value="<?= (old('jenis_kegiatan')) ? old('jenis_kegiatan') : $kegiatan['jenis_kegiatan'] ?>" name="jenis_kegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('jenis_kegiatan'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="tipe_kegiatan" class="form-label">Tipe Kegiatan</label>
                <select class="form-select <?= (validation_show_error('tipe_kegiatan')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="tipe_kegiatan" name="tipe_kegiatan">
                    <option selected disabled>Pilih Tipe</option>
                    <?php if ((old('tipe_kegiatan')) ? old('tipe_kegiatan') : $kegiatan['tipe_kegiatan'] == 'Online') : ?>
                        <option selected value="Online">Online</option>
                        <option value="Offline">Offline</option>
                        <option value="Online dan Offline">Online dan Offline</option>
                    <?php elseif ((old('tipe_kegiatan')) ? old('tipe_kegiatan') : $kegiatan['tipe_kegiatan'] == 'Offline') : ?>
                        <option value="Online">Online</option>
                        <option selected value="Offline">Offline</option>
                        <option value="Online dan Offline">Online dan Offline</option>
                    <?php elseif ((old('tipe_kegiatan')) ? old('tipe_kegiatan') : $kegiatan['tipe_kegiatan'] == 'Online dan Offline') : ?>
                        <option value="Online">Online</option>
                        <option value="Offline">Offline</option>
                        <option selected value="Online dan Offline">Online dan Offline</option>
                    <?php else : ?>
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
                <input type="text" class="form-control <?= (validation_show_error('tempat')) ? 'is-invalid' : ''; ?>" id="tempat" placeholder="" value="<?= (old('tempat')) ? old('tempat') : $kegiatan['tempat'] ?>" name="tempat">
                <div class="invalid-feedback">
                    <?= validation_show_error('tempat'); ?>
                </div>
            </div>

            <div class="col-6 col-sm-6">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input id="tgl_mulai" class="form-control <?= (validation_show_error('tgl_mulai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tgl_mulai" value="<?= (old('tgl_mulai')) ? old('tgl_mulai') : $kegiatan['tgl_mulai'] ?>" />
                <div class="invalid-feedback">
                    <?= validation_show_error('tgl_mulai'); ?>
                </div>
            </div>

            <div class="col-6 col-sm-6">
                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                <input id="tgl_selesai" class="form-control <?= (validation_show_error('tgl_selesai')) ? 'is-invalid' : ''; ?>" type="datetime-local" date name="tgl_selesai" value="<?= (old('tgl_selesai')) ? old('tgl_selesai') : $kegiatan['tgl_selesai'] ?>" />
                <div class="invalid-feedback">
                    <?= validation_show_error('tgl_selesai'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="link_pendaftaran" class="form-label">Link Pendaftaran</label>
                <input type="text" class="form-control <?= (validation_show_error('link_pendaftaran')) ? 'is-invalid' : ''; ?>" id="link_pendaftaran" placeholder="" value="<?= (old('link_pendaftaran')) ? old('link_pendaftaran') : $kegiatan['link_pendaftaran'] ?>" name="link_pendaftaran">
                <div class="invalid-feedback">
                    <?= validation_show_error('link_pendaftaran'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="link_virtual" class="form-label">Link Virtual</label>
                <input type="text" class="form-control <?= (validation_show_error('link_virtual')) ? 'is-invalid' : ''; ?>" id="link_virtual" placeholder="" value="<?= (old('link_virtual')) ? old('link_virtual') : $kegiatan['link_virtual'] ?>" name="link_virtual">
                <div class="invalid-feedback">
                    <?= validation_show_error('link_virtual'); ?>
                </div>
            </div>

            <!-- <p class="mt-5 text-center">
                        <label for="poster">
                            <a id="tambah" class="btn btn-danger text-light" role="button" aria-disabled="false">+
                                Tambah
                                Gambar</a>

                        </label>
                        <input type="file" name="poster" id="poster" style="visibility: hidden; position: absolute;" />

                    </p>
                    <div id="files-area">
                        <div id="filesList">
                            <div id="files-names"></div>

                        </div>
                    </div> -->

            <div class="col-12">
                <label for="poster" class="form-label"><a class="btn btn-danger" role="button" aria-disabled="false">Ganti Foto Poster</a></label>
                <input class="form-control <?= (validation_show_error('poster')) ? 'is-invalid' : ''; ?>" type="file" id="poster" value="<?= old('poster') ?>" name="poster" style="display:none">
                <div class="invalid-feedback">
                    <?= validation_show_error('poster'); ?>
                </div>
                <button class="btn btn-outline-danger" type="button" id="hapus"><i class="bi bi-trash3"></i></button>
                <label for="poster" class="custom-file-label"><?= $kegiatan['poster'] ?></label>
                <!-- preview foto -->
                <div class="filearray col-sm-2" id="preview">
                    <img src="<?= base_url() . 'uploads/' . $kegiatan['poster'] ?>" height="73" onerror="this.onerror=null; this.style='display:none'" class="img-preview">
                </div>
            </div>

            <input type="hidden" name="slug" value="<?= $kegiatan['slug'] ?>">

            <button class="w-100 btn btn-danger mt-5" type="submit">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $("#poster").on('change', function() {
        const poster = document.querySelector('#poster');
        const labelPoster = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        // labelPoster.textContent = poster.files[0].name;
        labelPoster.textContent = this.files[0].name;

        // console.log(poster.files);
        console.log(this.files);

        const filePoster = new FileReader();
        // filePoster.readAsDataURL(poster.files[0]);
        // filePoster.readAsDataURL(this.files[0]);
        filePoster.onload = function(e) {
            imgPreview.src = e.target.result;
            $('.img-preview').show();
        }
        filePoster.readAsDataURL(poster.files[0]);
        // filePoster.readAsDataURL(this.files[0]);
    });

    $("#hapus").click(function() {
        $("#poster").val('');
        console.log(document.querySelector("#poster").files);
        document.querySelector('.custom-file-label').textContent = '';
        $('.img-preview').hide();
    });

    // ***Here is the code for converting "image source" (url) to "Base64".***
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    let url =
        // 'https://cdn.shopify.com/s/files/1/0234/8017/2591/products/young-man-in-bright-fashion_925x_f7029e2b-80f0-4a40-a87b-834b9a283c39.jpg'
        '<?= base_url() . 'uploads/' . $kegiatan['poster'] ?>'
    const toDataURL = url => fetch(url)
        .then(response => response.blob())
        .then(blob => new Promise((resolve, reject) => {
            const reader = new FileReader()
            reader.onloadend = () => resolve(reader.result)
            reader.onerror = reject
            reader.readAsDataURL(blob)
        }))


    // ***Here is code for converting "Base64" to javascript "File Object".***

    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {
            type: mime
        });
    }


    // *** Calling both function ***

    toDataURL(url)
        .then(dataUrl => {
            console.log('Here is Base64 Url', dataUrl)
            var fileData = dataURLtoFile(dataUrl,
                "<?= $kegiatan['poster'] ?>");
            console.log("Here is JavaScript File Object", fileData)
            // fileArr.push(fileData)
            dt.items.add(fileData);
            document.querySelector('#poster').files = dt.files;
            // console.log("Here is Data Transfer", dt.files.item)
            console.log("Here is Data Transfer", document.querySelector('#poster').files)
        })
</script>
<?= $this->endSection() ?>