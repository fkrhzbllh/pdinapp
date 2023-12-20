<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Ubah Artikel</h3>
    <form method="post" action="/DashboardAdmin/saveUpdateRilisMedia/<?= $artikel['id'] ?>" class="form-container" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-9">
                <div class="mb-3">
                    <label class="control-label mb-2">Judul</label>
                    <input class="form-control <?= (validation_show_error('judul')) ? 'is-invalid' : ''; ?>" type="text" name="judul" value="<?= (old('judul')) ? old('judul') : $artikel['judul'] ?>" placeholder="Judul Artikel" required id="judul" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('judul'); ?>
                    </div>
                </div>
                <!-- <div class="mb-3">
                    <label class="control-label mb-2">Slug</label>
                    <input class="form-control" type="text" name="slug"
                        value="<?= set_value('slug', @$slug) ?>"
                placeholder="Slug" required />
            </div> -->
                <div class="mb-3">
                    <label class="control-label mb-2">Konten</label>
                    <textarea class="form-control tinymce <?= (validation_show_error('konten')) ? 'is-invalid' : ''; ?>" rows="30" type="text" name="konten" id="konten"><?= (old('konten')) ? old('konten') : $artikel['konten'] ?></textarea>
                    <div class="invalid-feedback">
                        <?= validation_show_error('konten'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="control-label mb-2">Meta Description</label>
                    <textarea class="form-control overlayscollbar <?= (validation_show_error('meta_description')) ? 'is-invalid' : ''; ?>" rows="5" type="text" name="meta_description" id="meta_description"><?= (old('meta_description')) ? old('meta_description') : $artikel['meta_description'] ?></textarea>
                    <div class="invalid-feedback">
                        <?= validation_show_error('meta_description'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="control-label mb-2">Excerpt</label>
                    <textarea class="form-control overlayscollbar <?= (validation_show_error('excerp')) ? 'is-invalid' : ''; ?>" rows="5" type="text" name="excerp" id="excerp"><?= (old('excerp')) ? old('excerp') : $artikel['excerp'] ?></textarea>
                    <div class="invalid-feedback">
                        <?= validation_show_error('excerp'); ?>
                    </div>
                </div>
                <!-- belum tau fungsinya -->
                <!-- <div class="mb-3">
                <label class="control-label mb-2">Search Engine Index</label>
                <div>

                </div>
            </div> -->
                <div class="mb-3">
                    <label class="control-label mb-2">Kategori</label>
                    <input class="form-control <?= (validation_show_error('kategori')) ? 'is-invalid' : ''; ?>" type="text" name="kategori" id="kategori" value="<?= (old('kategori')) ? old('kategori') : $artikel['kategori'] ?>" placeholder="kategori Artikel" required />
                    <div class="invalid-feedback">
                        <?= validation_show_error('kategori'); ?>
                    </div>
                </div>
                <!-- belum ditambahin di model dan db -->
                <!-- <div class="mb-3">
                <label class="control-label mb-2">Author</label>
                <input class="form-control" type="text" name="author"
                    value=""
                    placeholder="author" required />
            </div> -->
                <div class="mb-3">
                    <label class="control-label mb-2">Status</label>
                    <select class="form-select <?= (validation_show_error('status')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="status" name="status">
                        <option selected disabled>Status</option>
                        <?php if ((old('status')) ? old('status') : $artikel['status'] == 'draft') : ?>
                            <option selected value="draft">draft</option>
                            <option value="published">published</option>
                        <?php elseif ((old('status')) ? old('status') : $artikel['status'] == 'published') : ?>
                            <option value="draft">draft</option>
                            <option selected value="published">published</option>
                        <?php else : ?>
                            <option value="draft">draft</option>
                            <option value="published">published</option>
                        <?php endif; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('status'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="control-label mb-2">Tgl. Terbit</label>
                    <input id="tgl_terbit" class="form-control <?= (validation_show_error('tgl_terbit')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tgl_terbit" value="<?= (old('tgl_terbit')) ? old('tgl_terbit') : $artikel['tgl_terbit'] ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tgl_terbit'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="featured_image" class="form-label"><a class="btn btn-danger" role="button" aria-disabled="false">Ganti Foto featured_image</a></label>
                    <input class="form-control <?= (validation_show_error('featured_image')) ? 'is-invalid' : ''; ?>" type="file" id="featured_image" value="<?= old('featured_image') ?>" name="featured_image" style="display:none">
                    <div class="invalid-feedback">
                        <?= validation_show_error('featured_image'); ?>
                    </div>
                    <button class="btn btn-outline-danger" type="button" id="hapus"><i class="bi bi-trash3"></i></button>
                    <label for="featured_image" class="custom-file-label"><?= $artikel['featured_image'] ?></label>
                    <!-- preview foto -->
                    <div class="filearray col-sm-2" id="preview">
                        <img src="<?= base_url() . 'uploads/' . $artikel['featured_image'] ?>" height="73" onerror="this.onerror=null; this.style='display:none'" class="img-preview">
                    </div>
                </div>

            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="submit" name="submit" id="btn-submit" class="w-100 btn btn-danger mt-5">Simpan</button>
                </div>
            </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Tinymce -->
<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#konten',
        plugins: [
            'advlist', 'autolink',
            'lists', 'link', 'charmap', 'preview', 'anchor', 'searchreplace',
            'fullscreen', 'insertdatetime', 'table', 'help',
            'wordcount'
        ],
        toolbar: 'undo redo | casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | code table help',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: '/upload_image',
        file_picker_types: 'image',
        relative_urls: true,
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', (e) => {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name,
                        alt: file.name
                    });
                    // cb(e.target.result, {
                    //     alt: file.name
                    // });
                });
                reader.readAsDataURL(file);
            });

            input.click();
        },
        // Add this event handler to remove the image from the server when deleted or canceled
        images_delete_callback: function(img) {
            // Send a request to delete the image from the server
            var imageUrl = img.src;
            var formData = new FormData();
            formData.append('image_url', imageUrl);

            console.log(formData);

            fetch('<?= base_url() ?>/delete_image', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        },
        setup(editor) {
            editor.on("keydown", function(e) {
                if ((e.keyCode == 8 || e.keyCode == 46) && tinymce.activeEditor.selection) {
                    var selectedNode = tinymce.activeEditor.selection.getNode();
                    if (selectedNode && selectedNode.nodeName == 'IMG') {
                        var imageSrc = selectedNode.src;
                        //here you can call your server to delete the image

                        var formData = new FormData();
                        // formData.append('image_url', imageUrl);
                        formData.append('image_url', imageSrc);

                        fetch('/delete_image', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => console.log(data))
                            .catch(error => console.error('Error:', error));
                    }
                }
            });
        }
    });
</script>

<!-- preview foto -->
<script>
    $("#featured_image").on('change', function() {
        const featured_image = document.querySelector('#featured_image');
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
        filePoster.readAsDataURL(featured_image.files[0]);
        // filePoster.readAsDataURL(this.files[0]);
    });

    $("#hapus").click(function() {
        $("#featured_image").val('');
        console.log(document.querySelector("#featured_image").files);
        document.querySelector('.custom-file-label').textContent = '';
        $('.img-preview').hide();
    });

    // ***Here is the code for converting "image source" (url) to "Base64".***
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    let url =
        // 'https://cdn.shopify.com/s/files/1/0234/8017/2591/products/young-man-in-bright-fashion_925x_f7029e2b-80f0-4a40-a87b-834b9a283c39.jpg'
        '<?= base_url() . 'uploads/' . $artikel['featured_image'] ?>'
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
                "<?= $artikel['featured_image'] ?>");
            console.log("Here is JavaScript File Object", fileData)
            // fileArr.push(fileData)
            dt.items.add(fileData);
            document.querySelector('#featured_image').files = dt.files;
            // console.log("Here is Data Transfer", dt.files.item)
            console.log("Here is Data Transfer", document.querySelector('#featured_image').files)
        })
</script>
<?= $this->endSection() ?>