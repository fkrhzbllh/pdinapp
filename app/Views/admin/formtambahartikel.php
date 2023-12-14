<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Tambah Artikel</h3>
    <form method="post" action="/DashboardAdmin/saveTambahRilisMedia" class="form-container" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-9">
                <div class="mb-3">
                    <label class="control-label mb-2">Judul</label>
                    <input class="form-control <?= (validation_show_error('judul')) ? 'is-invalid' : ''; ?>" type="text" name="judul" value="<?= old('judul') ?>" placeholder="Judul Artikel" required id="judul" />
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
                    <textarea class="form-control tinymce <?= (validation_show_error('konten')) ? 'is-invalid' : ''; ?>" rows="30" type="text" name="konten" id="konten"><?= old('konten') ?></textarea>
                    <div class="invalid-feedback">
                        <?= validation_show_error('konten'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="control-label mb-2">Meta Description</label>
                    <textarea class="form-control overlayscollbar <?= (validation_show_error('meta_description')) ? 'is-invalid' : ''; ?>" rows="5" type="text" name="meta_description" id="meta_description"><?= old('meta_description') ?></textarea>
                    <div class="invalid-feedback">
                        <?= validation_show_error('meta_description'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="control-label mb-2">Excerp</label>
                    <textarea class="form-control overlayscollbar <?= (validation_show_error('excerp')) ? 'is-invalid' : ''; ?>" rows="5" type="text" name="excerp" id="excerp"><?= old('excerp') ?></textarea>
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
                    <input class="form-control <?= (validation_show_error('kategori')) ? 'is-invalid' : ''; ?>" type="text" name="kategori" id="kategori" value="<?= old('kategori') ?>" placeholder="kategori Artikel" required />
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
                        <?php if (old('status') == 'draft') : ?>
                            <option selected value="draft">draft</option>
                            <option value="published">published</option>
                        <?php elseif (old('status') == 'published') : ?>
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
                    <input id="tgl_terbit" class="form-control <?= (validation_show_error('tgl_terbit')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tgl_terbit" value="<?= old('tgl_terbit') ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tgl_terbit'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="control-label mb-2">Feature Image</label>
                    <input class="form-control <?= (validation_show_error('featured_image')) ? 'is-invalid' : ''; ?>" type="file" id="featured_image" value="<?= old('featured_image') ?>" name="featured_image" onchange="onFileUpload(this);" accept="image/*">
                    <div class="invalid-feedback">
                        <?= validation_show_error('featured_image'); ?>
                    </div>
                </div>
                <!-- preview foto -->
                <div class="filearray" id="preview">

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="submit" name="submit" id="btn-submit" class="w-100 btn btn-primary mt-5">Simpan</button>
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
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
            'wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
        image_title: true,
        automatic_uploads: true,
        image_upload_url: '/upload_image',
        file_picker_types: 'image',
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', () => {
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
                        title: file.name
                    });
                });
                reader.readAsDataURL(file);
            });

            input.click();
        }
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
<?= $this->endSection() ?>