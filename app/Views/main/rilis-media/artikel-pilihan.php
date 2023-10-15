<!-- Artikel pilihan -->
<div class="row">
    <h5 class="mb-3">Artikel Pilihan</h5>
</div>

<?php foreach ($artikelPilihan as $i => $a) : ?>
    <!-- Item artikel -->
    <div class="card mb-2">
        <div class="row g-0">

            <!-- Gambar kegiatan -->
            <div class="col-3 position-relative">
                <img src="<?php echo base_url() . 'uploads/' . $a['featured_image'] ?>" class="card-img object-fit-cover w-100" style="height: 96px" alt="..." />
            </div>

            <!-- Ringkasan kegiatan -->
            <div class="col-9">

                <!-- Body kegiatan -->
                <div class="card-body p-2">

                    <!-- Judul kegiatan -->
                    <p class="card-title">
                        <a class="link-dark text-decoration-none crop-text-2" href="#" target="_blank">
                            <b>
                                <?php echo $a['judul']; ?>
                            </b>
                        </a>
                    </p>

                    <!-- Kategori dan tanggal terbit -->
                    <small class="card-text crop-text-1">
                        <?php echo $a['tgl_terbit_terformat']; ?> | <?php echo $a['kategori']; ?></small>
                </div>
                <!-- Akhir body kegiatan -->

            </div>
            <!-- Akhir ringkasan kegiatan -->

        </div>
    </div>
    <!-- Akhir item artikel -->
<?php endforeach; ?>