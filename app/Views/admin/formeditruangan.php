<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Ubah Ruangan</h3>
    <form id="formruangan" class="mt-3" action="/DashboardAdmin/saveUpdateRuangan/<?= $ruangan['id'] ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <?= \Config\Services::validation()->listErrors() ?>

            <div class="col-12">
                <label for="nama" class="form-label">Nama Ruangan</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= (old('nama')) ? old('nama') : $ruangan['nama'] ?>" name="nama" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiRuangan" class="form-label">Deskripsi Ruangan</label>
                <textarea class="form-control <?= (validation_show_error('deskripsiRuangan')) ? 'is-invalid' : ''; ?>" id="deskripsiRuangan" placeholder="" rows="5" name="deskripsiRuangan"><?= (old('deskripsiRuangan')) ? old('deskripsiRuangan') : $ruangan['deskripsi'] ?></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiRuangan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="kegunaan" class="form-label">Kegunaan</label>
                <textarea class="form-control <?= (validation_show_error('kegunaan')) ? 'is-invalid' : ''; ?>" id="kegunaan" placeholder="" rows="5" name="kegunaan"><?= (old('kegunaan')) ? old('kegunaan') : $ruangan['kegunaan'] ?></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('kegunaan'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="tipe" class="form-label">Tipe Ruangan</label>
                <select class="form-select <?= (validation_show_error('tipe')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="tipe" name="tipe">
                    <option selected disabled>Pilih Tipe</option>
                    <?php if ((old('tipe')) ? old('tipe') : $ruangan['tipe'] == 'Pameran') : ?>
                        <option selected value="Pameran">Pameran</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Meeting">Ruang Pertemuan</option>
                        <option value="Pengembangan">Ruang Pengembangan</option>
                        <option value="Lainnya">Lainnya</option>
                    <?php elseif ((old('tipe')) ? old('tipe') : $ruangan['tipe'] == 'Kantor') : ?>
                        <option value="Pameran">Pameran</option>
                        <option selected value="Kantor">Kantor</option>
                        <option value="Meeting">Ruang Pertemuan</option>
                        <option value="Pengembangan">Ruang Pengembangan</option>
                        <option value="Lainnya">Lainnya</option>
                    <?php elseif ((old('tipe')) ? old('tipe') : $ruangan['tipe'] == 'Meeting') : ?>
                        <option value="Pameran">Pameran</option>
                        <option value="Kantor">Kantor</option>
                        <option selected value="Meeting">Ruang Pertemuan</option>
                        <option value="Pengembangan">Ruang Pengembangan</option>
                        <option value="Lainnya">Lainnya</option>
                    <?php elseif ((old('tipe')) ? old('tipe') : $ruangan['tipe'] == 'Pengembangan') : ?>
                        <option value="Pameran">Pameran</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Meeting">Ruang Pertemuan</option>
                        <option selected value="Pengembangan">Ruang Pengembangan</option>
                        <option value="Lainnya">Lainnya</option>
                    <?php elseif ((old('tipe')) ? old('tipe') : $ruangan['tipe'] == 'Lainnya') : ?>
                        <option value="Pameran">Pameran</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Meeting">Ruang Pertemuan</option>
                        <option value="Pengembangan">Ruang Pengembangan</option>
                        <option selected value="Lainnya">Lainnya</option>
                    <?php else : ?>
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
                <select class="form-select <?= (validation_show_error('lantai')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="lantai" name="lantai">
                    <option selected disabled>Pilih Lantai</option>
                    <?php if ((old('lantai')) ? old('lantai') : $ruangan['lantai'] == '0') : ?>
                        <option selected value="0">Ground Floor</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    <?php elseif ((old('lantai')) ? old('lantai') : $ruangan['lantai'] == '1') : ?>
                        <option value="0">Ground Floor</option>
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    <?php elseif ((old('lantai')) ? old('lantai') : $ruangan['lantai'] == '2') : ?>
                        <option value="0">Ground Floor</option>
                        <option value="1">1</option>
                        <option selected value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    <?php elseif ((old('lantai')) ? old('lantai') : $ruangan['lantai'] == '3') : ?>
                        <option value="0">Ground Floor</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option selected value="3">3</option>
                        <option value="4">4</option>
                    <?php elseif ((old('lantai')) ? old('lantai') : $ruangan['lantai'] == '4') : ?>
                        <option value="0">Ground Floor</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option selected value="4">4</option>
                    <?php else : ?>
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
                <input type="number" class="form-control <?= (validation_show_error('kapasitas')) ? 'is-invalid' : ''; ?>" id="kapasitas" placeholder="" value="<?= (old('kapasitas')) ? old('kapasitas') : $ruangan['kapasitas'] ?>" name="kapasitas">
                <div class="invalid-feedback">
                    <?= validation_show_error('kapasitas'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="panjang" class="form-label">Panjang Ruangan (m)</label>
                <input type="number" class="form-control <?= (validation_show_error('panjang')) ? 'is-invalid' : ''; ?>" id="panjang" placeholder="" value="<?= (old('panjang')) ? old('panjang') : $panjang ?>" name="panjang">
                <div class="invalid-feedback">
                    <?= validation_show_error('panjang'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="lebar" class="form-label">Lebar Ruangan (m)</label>
                <input type="number" class="form-control <?= (validation_show_error('lebar')) ? 'is-invalid' : ''; ?>" id="lebar" placeholder="" value="<?= (old('lebar')) ? old('lebar') : $lebar ?>" name="lebar">
                <div class="invalid-feedback">
                    <?= validation_show_error('lebar'); ?>
                </div>
            </div>

            <div class="col-4">
                <label for="tinggi" class="form-label">Tinggi Ruangan (m)</label>
                <input type="number" class="form-control <?= (validation_show_error('tinggi')) ? 'is-invalid' : ''; ?>" id="tinggi" placeholder="" value="<?= (old('tinggi')) ? old('tinggi') : $tinggi ?>" name="tinggi">
                <div class="invalid-feedback">
                    <?= validation_show_error('tinggi'); ?>
                </div>
            </div>

            <div class="col-6">
                <label for="biaya-sewa" class="form-label">Biaya Sewa</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" step="1000" class="form-control biaya-sewa <?= (validation_show_error('fasilitas')) ? 'is-invalid' : ''; ?>" id="biaya-sewa" value="<?= (old('biayasewa')) ? old('biayasewa') : $ruangan['biaya_sewa'] ?>" name="biayasewa">
                </div>
                <div class="invalid-feedback">
                    <?= validation_show_error('biayasewa'); ?>
                </div>
            </div>

            <!-- <div class="col-6">
                        <label for="fotoruangan" class="form-label">Pilih Foto Ruangan</label>
                        <input
                            class="form-control <?= (validation_show_error('fotoruangan[]')) ? 'is-invalid' : ''; ?>"
            type="file" id="fotoruangan" multiple value="<?php foreach ($fotoruangan as $key) {
                                                                echo '"' . $key['nama_file'] . '" ';
                                                            } ?>" name="fotoruangan[]" onchange="onFileUpload(this);" file="<?php foreach ($fotoruangan as $key) {
                                                                                                                                echo $key['nama_file'];
                                                                                                                            } ?>">
            <div class="invalid-feedback">
                <?= validation_show_error('fotoruangan[]'); ?>
            </div>
        </div> -->
            <!-- preview foto -->
            <!-- <div class="filearray" id="preview" style="position:relative">
                        <?php if ($fotoruangan) : ?>
        <?php foreach ($fotoruangan as $f) : ?>

        <button class="bi bi-x-circle close">asd</button>
        <img src="<?= base_url() . 'uploads/' . $f['nama_file'] ?>"
            alt="" style="width: 200px;">

        <?php endforeach; ?>
        <?php endif; ?>
</div> -->

            <!-- coba -->
            <p class="mt-5 text-center">
                <label for="fotoruangan">
                    <a class="btn btn-danger text-light" role="button" aria-disabled="false">+ Tambah Gambar</a>

                </label>
                <input type="file" name="fotoruangan[]" id="fotoruangan" style="visibility: hidden; position: absolute;" multiple />

            </p>
            <div id="files-area">
                <div id="filesList">
                    <div id="files-names"></div>

                </div>
            </div>

            <input type="hidden" name="slug" value="<?= old('slug') ? old('slug') : $ruangan['slug'] ?>">
            <input type="hidden" name="idRuangan" value="<?= old('idRuangan') ? old('idRuangan') : $ruangan['id'] ?>">

            <button class="w-100 btn btn-primary mt-5" type="submit">Simpan</button>
        </div>
    </form>
</div>
</div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    $("#fotoruangan").on('change', function(e) {
        for (var i = 0; i < this.files.length; i++) {
            let fileBloc = $('<span/>', {
                    class: 'file-block'
                }),
                fileName = $('<span/>', {
                    class: 'name',
                    text: this.files.item(i).name
                });
            console.log(this.files.item(i));
            const reader = new FileReader();
            let image = new Image();
            reader.onload = function(e) {
                image.height = 100;
                // image.title = file.name;
                // image.src = this.files.item(i).name;
                image.src = this.result;
                console.log(this.result);
            }
            reader.readAsDataURL(this.files.item(i));

            fileBloc.append('<span class="file-delete"><span>+</span></span>')
                .append(fileName).append(image);
            $("#filesList > #files-names").append(fileBloc);
        };
        // Ajout des fichiers dans l'objet DataTransfer
        for (let file of this.files) {
            dt.items.add(file);
        }
        // Mise à jour des fichiers de l'input file après ajout
        this.files = dt.files;

        // EventListener pour le bouton de suppression créé
        $('span.file-delete').click(function() {
            let name = $(this).next('span.name').text();
            // Supprimer l'affichage du nom de fichier
            $(this).parent().remove();
            for (let i = 0; i < dt.items.length; i++) {
                // Correspondance du fichier et du nom
                if (name === dt.items[i].getAsFile().name) {
                    // Suppression du fichier dans l'objet DataTransfer
                    dt.items.remove(i);
                    continue;
                }
            }
            // Mise à jour des fichiers de l'input file après suppression
            document.getElementById('fotoruangan').files = dt.files;
        });
    });

    <?php foreach ($fotoruangan as $f) : ?> {
            let fileBloc = $('<span/>', {
                    class: 'file-block'
                }),
                fileName = $('<span/>', {
                    class: 'name',
                    text: '<?= $f['nama_file'] ?>'
                });
            // console.log(this.files.item(i));
            // const reader = new FileReader();
            let image = new Image();
            image.height = 100;
            // image.title = file.name;
            // image.src = this.files.item(i).name;
            image
                .src =
                '<?= base_url() . 'uploads/' . $f['nama_file'] ?>';
            // image
            //     .src = '';
            // console.log(this.result);
            // reader.onload = function(e) {
            // }
            // reader.readAsDataURL(this.files.item(i));

            fileBloc.append('<span class="file-delete"><span>+</span></span>')
                .append(fileName).append(image);
            $("#filesList > #files-names").append(fileBloc);

            // ***Here is the code for converting "image source" (url) to "Base64".***

            let url =
                // 'https://cdn.shopify.com/s/files/1/0234/8017/2591/products/young-man-in-bright-fashion_925x_f7029e2b-80f0-4a40-a87b-834b9a283c39.jpg'
                '<?= base_url() . 'uploads/' . $f['nama_file'] ?>'
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
                        "<?= $f['nama_file'] ?>");
                    console.log("Here is JavaScript File Object", fileData)
                    // fileArr.push(fileData)
                    dt.items.add(fileData);
                    console.log("Here is Data Transfer", dt.files.item)
                })
        };
    <?php endforeach; ?>
    // Ajout des fichiers dans l'objet DataTransfer
    // for (let file of this.files) {
    //     dt.items.add(file);
    // }
    // Mise à jour des fichiers de l'input file après ajout
    document.getElementById('fotoruangan').files = dt.files;
    // this.files = dt.files;

    // EventListener pour le bouton de suppression créé
    $('span.file-delete').click(function() {
        let name = $(this).next('span.name').text();
        // Supprimer l'affichage du nom de fichier
        $(this).parent().remove();
        for (let i = 0; i < dt.items.length; i++) {
            // Correspondance du fichier et du nom
            if (name === dt.items[i].getAsFile().name) {
                // Suppression du fichier dans l'objet DataTransfer
                dt.items.remove(i);
                continue;
            }
        }
        // Mise à jour des fichiers de l'input file après suppression
        document.getElementById('fotoruangan').files = dt.files;
    });
</script>

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

<?= $this->endSection() ?>