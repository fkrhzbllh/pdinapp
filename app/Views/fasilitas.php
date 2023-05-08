<div class="container">
    <div class="row">
        <div class="column">
            <h1 class="mt-3">fasilitas</h1>

            <div class="d-flex flex-row">
                <ul class="nav nav-pills mb-3 justify-content-left" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-ruangan-tab" data-bs-toggle="pill" data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan" aria-selected="true">Ruangan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill" data-bs-target="#pills-alat" type="button" role="tab" aria-controls="pills-alat" aria-selected="false">Alat</button>
                    </li>
                </ul>
                <select class="form-select ms-auto" aria-label="Default select example" id="filter" style="width: fit-content;height: fit-content;">
                    <option selected value="all">Pilih tipe ruangan</option>
                    <option value="Pameran">Pameran</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Meeting">Ruang Pertemuan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <input type="text" class="form-control ms-3" style="height: fit-content; width:fit-content;" id="cariruangan" placeholder="Cari ruangan...">
                <input type="text" class="form-control ms-auto" style="height: fit-content; width:fit-content; display:none;" id="carialat" placeholder="Cari alat...">
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel" aria-labelledby="pills-ruangan-tab" tabindex="0">
                    <div class="row justify-content-start mb-5">
                        <?php foreach($ruangan as $r) : ?>
                        <div class="col-4 <?= $r['tipe']?>">
                            <div class="card" >
                                <img class="card-img-top" src="<?= base_url()?>uploads/5ea50f43831c2.png">
                            <!-- <h5 class="card-header">Featured</h5> -->
                                <div class="card-body">
                                    <p class="small" >Lantai <?= $r['lantai'] ?></p>
                                    <h3 class="card-title"><?= $r['nama'] ?></h3>
                                    <p class="card-text"><?= $r['deskripsi'] ?></p>
                                    <!-- <a href="/fasilitas/ruang/<?php // $r['slug'];?>" class="btn btn-primary">Detail</a> -->
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <?php //echo $pager->links('ruangan','pager') ?>
                </div>
                <div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab" tabindex="0">
                    <div class="row justify-content-start mb-5">
                        <?php foreach($alat as $a) : ?>
                        <div class="col-4">
                            <div class="card">
                                <img class="card-img-top" src="<?= base_url()?>uploads/5ea50f43831c2.png">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $a['nama'] ?></h3>
                                    <p class="card-text"><?= $a['deskripsi'] ?></p>
                                    <!-- <a href="/fasilitas/alat/<?php // $a['slug'];?>" class="btn btn-primary">Detail</a> -->
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <?php // echo $pager->links('alat','pager') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#cariruangan").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pills-tabContent").children().children().children().filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#carialat").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pills-tabContent").children().children().children().filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#pills-tab').find('button').on('show.bs.tab',function() {
            $('#filter').toggle();
            $('#cariruangan').toggle();
            $('#carialat').toggle();
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#filter").on("change", function() {
            var value = $(this).val();
            $("#pills-tabContent").children().children().children().filter(function() {
                $(this).toggle($(this).hasClass(value))
            });
        });
    });
</script>