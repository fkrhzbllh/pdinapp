<div class="container">
    <form class="needs-validation mt-3" novalidate="" action="/fasilitas/saveSewaAlat" method="post">
        <?php echo csrf_field()?>
        <div class="row g-3">
            <h3>Sewa Alat</h3>
            <div class="col-12">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="" value="" required="" name="nama" autofocus>
                <div class="invalid-feedback">
                Nama harus diisi.
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
                <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email">
                <div class="invalid-feedback">
                Email harus diisi dan valid.
                </div>
            </div>

            <div class="col-md-6">
                <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomorTelepon" placeholder="6281234567890" required="" name="nomorTelepon">
                <div class="invalid-feedback">
                Nomor telepon harus diisi.
                </div>
            </div>

            <div class="col-12">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text" class="form-control" id="instansi" placeholder="" value="" required="" name="instansi">
                <div class="invalid-feedback">
                Instansi harus diisi.
                </div>
            </div>

            <!-- <div class="col-12">
                <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control" id="kegiatan" placeholder="" value="" required="" name="namaKegiatan">
                <div class="invalid-feedback">
                Nama Kegiatan harus diisi.
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                <input type="text" class="form-control" id="deskripsiKegiatan" placeholder="" value="" required="" name="deskripsiKegiatan">
                <div class="invalid-feedback">
                Deskripsi Kegiatan harus diisi.
                </div>
            </div> -->
            
            <div class="col-12">
                <label for="alat" class="form-label">Alat yang Dipinjam</label>
                <select class="form-select" aria-label="Default select" id="alat" name="alat">
                    <option selected disabled>Pilih Alat</option>
                    <?php foreach($alat as $a) : ?>
                        <?php if($id_alat == $a['id']) :?>
                            <option selected value="<?= $a['id'] ?>"><?= $a['nama'] ?></option>
                        <?php else : ?>
                            <option value="<?= $a['id'] ?>" ><?= $a['nama'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div> 
            
            <div class="col-sm-6">
                <!-- <label for="linkedPickers1Input" class="form-label">Waktu Mulai Sewa</label>
                <div
                    class="input-group log-event"
                    id="linkedPickers1"
                    data-td-target-input="nearest"
                    data-td-target-toggle="nearest"
                >
                    <input
                    id="linkedPickers1Input"
                    type="text"
                    class="form-control"
                    data-td-target="#linkedPickers1"
                    />
                    <span
                    class="input-group-text"
                    data-td-target="#linkedPickers1"
                    data-td-toggle="datetimepicker"
                    >
                    <span class="fa-solid fa-calendar"></span>
                    </span>
                </div> -->
                <label for="datetimepicker1Input" class="form-label">Picker</label>
                <div class="input-group log-event" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
                    <input id="datetimepicker1Input" type="text" class="form-control" data-td-target="#datetimepicker1">
                    <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker">
                    <i class="fas fa-calendar"></i>
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- <label for="linkedPickers2Input" class="form-label">Waktu Selesai Sewa</label>
                <div
                    class="input-group log-event"
                    id="linkedPickers2"
                    data-td-target-input="nearest"
                    data-td-target-toggle="nearest"
                >
                    <input
                    id="linkedPickers2Input"
                    type="text"
                    class="form-control"
                    data-td-target="#linkedPickers2"
                    />
                    <span
                    class="input-group-text"
                    data-td-target="#linkedPickers2"
                    data-td-toggle="datetimepicker"
                    >
                    <span class="fa-solid fa-calendar"></span>
                    </span>
                </div> -->
                <label for="datetimepicker2Input" class="form-label">Picker</label>
                <div class="input-group log-event" id="datetimepicker2" data-td-target-input="nearest" data-td-target-toggle="nearest">
                    <input id="datetimepicker2Input" type="text" class="form-control" data-td-target="#datetimepicker2">
                    <span class="input-group-text" data-td-target="#datetimepicker2" data-td-toggle="datetimepicker">
                    <i class="fas fa-calendar"></i>
                    </span>
                </div>
            </div>

            <script>
                // import { TempusDominus, Namespace } from '@eonasdan/tempus-dominus';

                // const linkedPicker1Element = document.getElementById('linkedPickers1');
                // const linked1 = new TempusDominus(linkedPicker1Element);
                // const linked2 = new TempusDominus(document.getElementById('linkedPickers2'), {
                // useCurrent: false,
                // });

                // //using event listeners
                // linkedPicker1Element.addEventListener(Namespace.events.change, (e) => {
                // linked2.updateOptions({
                //     restrictions: {
                //     minDate: e.detail.date,
                //     },
                // });
                // });
                // import { TempusDominus } from '@eonasdan/tempus-dominus';

                // new TempusDominus(document.getElementById('datetimepicker1'), {
                //put your config here
                // });
            </script>

            <button class="w-100 btn btn-primary btn-lg mt-5" type="submit">Sewa Ruangan</button>
        </div>
    </form>     
</div>