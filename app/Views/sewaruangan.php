<div class="container">
    <form id="sewaruangan" class="mt-3" action="/fasilitas/saveSewaRuangan" method="post">
        <?php echo csrf_field()?>
        <div class="row g-3">
            <h3>Sewa Ruangan</h3>
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ?>" name="nama" autofocus>
                <div class="invalid-feedback">
                <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <!-- <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username" placeholder="Username" required="">
                    <div class="invalid-feedback">
                        Your username is required.
                    </div>
                </div>
            </div> -->

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="you@example.com" name="email" value="<?= old('email') ?>">
                <div class="invalid-feedback">
                <?= validation_show_error('email'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?= (validation_show_error('nomorTelepon')) ? 'is-invalid' : ''; ?>" id="nomorTelepon" placeholder="6281234567890" name="nomorTelepon" value="<?= old('nomorTelepon') ?>">
                <div class="invalid-feedback">
                <?= validation_show_error('nomorTelepon'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text" class="form-control <?= (validation_show_error('instansi')) ? 'is-invalid' : ''; ?>" id="instansi" placeholder="" value="<?= old('instansi') ?>" name="instansi">
                <div class="invalid-feedback">
                <?= validation_show_error('instansi'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('namaKegiatan')) ? 'is-invalid' : ''; ?>" id="kegiatan" placeholder="" value="<?= old('namaKegiatan') ?>" name="namaKegiatan">
                <div class="invalid-feedback">
                <?= validation_show_error('namaKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('deskripsiKegiatan')) ? 'is-invalid' : ''; ?>" id="deskripsiKegiatan" placeholder="" value="<?= old('deskripsiKegiatan') ?>" name="deskripsiKegiatan">
                <div class="invalid-feedback">
                <?= validation_show_error('deskripsiKegiatan'); ?>
                </div>
            </div>
            
            <div class="col-12">
                <label for="ruangan" class="form-label">Ruang yang Dipinjam</label>
                <select class="form-select <?= (validation_show_error('ruangan')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="ruangan" name="ruangan">
                    <option selected disabled>Pilih Ruangan</option>
                    <?php foreach($ruangan as $r) : ?>
                        <?php if($id_ruangan == $r['id'] || old('ruangan') == $r['id']) :?>
                            <option selected value="<?= $r['id'] ?>" class="<?= $r['tipe'] ?>"><?= $r['nama'] ?></option>
                        <?php else : ?>
                            <option value="<?= $r['id'] ?>" class="<?= $r['tipe'] ?>"><?= $r['nama'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                <?= validation_show_error('ruangan'); ?>
                </div>
            </div> 

            <div class="Pameran mb-3" id="Pameran" style="display: none;">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulaiPameran')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalMulaiPameran" value="<?= old('tanggalMulaiPameran') ?>"/>
                        <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulaiPameran'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesaiPameran')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalSelesaiPameran" value="<?= old('tanggalSelesaiPameran') ?>"/>
                        <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesaiPameran'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Kantor mb-3" id="Kantor" style="display: none;">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulaiKantor')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiKantor" value="<?= old('tanggalMulaiKantor') ?>" step="3600"/>
                        <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulaiKantor'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesaiKantor')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiKantor" value="<?= old('tanggalSelesaiKantor') ?>" step="60"/>
                        <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesaiKantor'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Meeting mb-3" id="Meeting" style="display: none;">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulaiMeeting')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiMeeting" value="<?= old('tanggalMulaiMeeting') ?>"/>
                        <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulaiMeeting'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                        <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesaiMeeting')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiMeeting" value="<?= old('tanggalSelesaiMeeting') ?>"/>
                        <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesaiMeeting'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <input id="tipe" class="form-control" type="hidden" name="tipe" value="<?= old('tipe') ?>"/>

            <script>
                $(document).ready(function(){
                    if ($("#ruangan").find("option:selected").attr("class") == "Pameran")
                    {
                        $("#Kantor,#Meeting").hide();
                        $('#Pameran').show();
                        $("#tipe").val($(this).find('option:selected').attr('class'));
                    }
                    else if ($('#ruangan').find('option:selected').attr('class') == 'Kantor')
                    {
                        $("#Pameran,#Meeting").hide();
                        $('#Kantor').show();
                        $("#tipe").val($(this).find('option:selected').attr('class'));
                    }
                    else if ($('#ruangan').find('option:selected').attr('class') == 'Meeting')
                    {
                        $("#Pameran,#Kantor").hide();
                        $('#Meeting').show();
                        $("#tipe").val($(this).find('option:selected').attr('class'));
                    }
                    else
                    {
                        $("#Pameran,#Kantor,#Meeting").hide();
                    }

                    $('#ruangan').change(function () {
                        $("#Pameran,#Kantor,#Meeting").hide();
                        $('#' + $(this).find('option:selected').attr('class')).show();
                        $("#tipe").val($(this).find('option:selected').attr('class'));
                    });

                    // if ($('$sewaruangan').length > 0)
                    // {
                    //     $('$sewaruangan').validate({
                    //         rules: {
                    //             nama: {
                    //                 required: true
                    //             },
                    //             email: {
                    //                 required: true,
                    //                 email: true
                    //             },
                    //             nomorTelepon: {
                    //                 required: true
                    //             }
                    //         }
                    //     })
                    // }

                    // $('#tanggalMulai').date_default_timezone_set('id');
                    // $('#tanggalSelesai').date_default_timezone_set('id');                
                });
                

            </script>

            <button class="w-100 btn btn-primary btn-lg mt-5" type="submit">Sewa Ruangan</button>
        </div>
    </form>     
</div>