<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<style>
  .mapouter {
    position: relative;
    text-align: right;
    width: 100%;
    height: 200px;
  }

  .gmap_canvas {
    overflow: hidden;
    background: none !important;
    width: 100%;
    height: 200px;
  }

  .gmap_iframe {
    height: 200px !important;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Section isi -->
<section id="section-konten">
  <div class="container container-konten">
    <div class="row my-4">
      <div class="col-lg-2 p-0 m-0">
        <h4 class="ms-2">Hubungi Kami</h4>
      </div>
      <div class="col-lg-10 p-0 m-0 pe-3">
        <hr />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <!-- untuk WA dan email -->
        <div class="row p-0 m-0 mb-3">
          <div class="col-md-6 p-0 m-0">
            <h6 class="m-0 mb-3 p-0">Chat</h6>
            <!-- WhatsApp -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-whatsapp" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">WhatsApp</small>
                <p class="p-0 ms-3 fw-bold">+62 812 390 093 93</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-0 m-0">
            <h6 class="m-0 mb-3 p-0">Email</h6>
            <!-- Email -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-envelope-fill" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">Email</small>
                <p class="p-0 ms-3 fw-bold">
                  pdin.yogyakarta@gmail.com
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- untuk Sosmed -->
        <div class="row p-0 m-0 mb-3">
          <h6 class="m-0 mb-3 p-0">Sosial Media</h6>
          <div class="col-md-6 p-0 m-0">
            <!-- Instagram -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-instagram" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">Instagram</small>
                <p class="p-0 ms-3 fw-bold">@pdin.id</p>
              </div>
            </div>
            <!-- Youtube -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-youtube" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">YouTube</small>
                <p class="p-0 ms-3 fw-bold">PDIN Yogyakarta</p>
              </div>
            </div>
            <!-- Facebook -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-tiktok" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">TikTok</small>
                <p class="p-0 ms-3 fw-bold">@pdin_id</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 p-0 m-0">
            <!-- Twitter -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-twitter" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">Twitter</small>
                <p class="p-0 ms-3 fw-bold">@pdin.id</p>
              </div>
            </div>
            <!-- Facebook -->
            <div class="row p-0 m-0 mb-2">
              <div class="col-2 m-0 p-0 align-self-start">
                <div class="bg-danger text-center p-1 m-0 rounded-2">
                  <i class="bi bi-facebook" style="font-size: 24px; color: white"></i>
                </div>
              </div>
              <div class="col-10 text-start p-0 m-0 align-self-end">
                <small class="p-0 m-0 ms-3">Facebook</small>
                <p class="p-0 ms-3 fw-bold">PDIN Yogyakarta</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <!-- untuk Alamat -->
        <div class="row p-0 m-0 mt-3 mt-lg-0">
          <h6 class="m-0 mb-3 p-0">Alamat Kantor</h6>
          <div class="col-md-6 p-0 m-0">
            <!-- Alamat -->
            <div class="pe-2">
              <p class="mb-2">
                Jl. C. Simanjuntak, Terban, Kapanewon Gondokusuman, Kota
                Yogyakarta, Daerah Istimewa Yogyakarta
              </p>
              <p>Kode Pos 55223</p>
            </div>
          </div>
          <div class="col-md-6 p-0 m-0">
            <!-- Gambar -->
            <!-- Alamat -->
            <div>
              <div class="mapouter">
                <div class="gmap_canvas">
                  <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=230&amp;height=200&amp;hl=en&amp;q=pusat desain industri nasional&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://capcuttemplate.org/">Capcut Template</a>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>



  </div>
</section>
<?= $this->endSection() ?>