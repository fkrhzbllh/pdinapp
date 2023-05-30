<!-- ======= Judul Section ======= -->
<section id="background-hitam-atas" class="d-flex align-items-center">
    <div class="container">
        <div class="text-center">
            <h2 class="text-light my-4">Edit Alat</h2>
            <p class="text-light lh-base">
                Ubah data alat
            </p>
        </div>
    </div>
</section>
<!-- End Hero -->

<section id="isi-section">
    <div class="container p-3">
        <div class="bg-white rounded-5 py-5 px-5 shadow-sm" id="">
            <form id="formalat" class="mt-3"
                action="/DashboardAdmin/saveUpdateAlat/<?= $alat['id'] ?>"
                method="post" enctype="multipart/form-data">
                <?php echo csrf_field()?>
                <div class="row g-3">
                    <h3><?= $judul_halaman ?></h3>
                    <?= \Config\Services::validation()->listErrors() ?>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama Alat</label>
                        <input type="text"
                            class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>"
                            id="nama" placeholder=""
                            value="<?= (old('nama')) ? old('nama') : $alat['nama'] ?>"
                            name="nama" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="deskripsiAlat" class="form-label">Deskripsi Alat</label>
                        <textarea
                            class="form-control <?= (validation_show_error('deskripsiAlat')) ? 'is-invalid' : ''; ?>"
                            id="deskripsiAlat" placeholder="" value=""
                            name="deskripsiAlat"><?= (old('deskripsiAlat')) ? old('deskripsiAlat') : $alat['deskripsi'] ?></textarea>
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
                                value="<?= (old('biayasewa')) ? old('biayasewa') : $alat['biaya_sewa'] ?>"
                                name="biayasewa">
                        </div>
                        <div class="invalid-feedback">
                            <?= validation_show_error('biayasewa'); ?>
                        </div>
                    </div>



                    <!-- coba -->
                    <p class="mt-5 text-center">
                        <label for="fotoalat">
                            <a class="btn btn-danger text-light" role="button" aria-disabled="false">+ Tambah Gambar</a>

                        </label>
                        <input type="file" name="fotoalat[]" id="fotoalat"
                            style="visibility: hidden; position: absolute;" multiple />

                    </p>
                    <div id="files-area">
                        <div id="filesList">
                            <div id="files-names"></div>

                        </div>
                    </div>

                    <input type="hidden" name="slug"
                        value="<?= $alat['slug'] ?>">

                    <button class="w-100 btn btn-primary mt-5" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    $("#fotoalat").on('change', function(e) {
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
            document.getElementById('fotoalat').files = dt.files;
        });
    });

    <?php foreach($fotoalat as $f) : ?>
    {
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
    document.getElementById('fotoalat').files = dt.files;
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
        document.getElementById('fotoalat').files = dt.files;
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

<!-- <script>
    var input = $('#fotoruangan');
    input.files = <?php $fotoruangan ?> ;
</script> -->