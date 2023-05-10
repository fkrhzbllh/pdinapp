<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('sukses') ?>
            </div>
        <?php endif; ?>
        <div class="card mb-3">
            <?php if (is_array($fotoruangan) && sizeof($fotoruangan) > 1):?>
                <div id="carouselExampleIndicators" class="carousel slide card-img-top">
                    <div class="carousel-indicators">
                        <?php foreach ($fotoruangan as $key => $value) :?>
                            <?php if ($key == 0) :?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <?php else :?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" aria-label="Slide <?= $key-1 ?>"></button>
                            <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($fotoruangan as $key => $value) :?>
                            <?php if ($key == 0) :?>
                                <div class="carousel-item active">
                                    <img src="<?php echo base_url() ?>uploads/<?= $value['nama_file']?>" class="d-block w-100" alt="...">
                                </div>
                            <?php else :?>
                                <div class="carousel-item">
                                    <img src="<?php echo base_url() ?>uploads/<?= $value['nama_file']?>" class="d-block w-100" alt="...">
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                        <!-- <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                        </div> -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php elseif (is_array($fotoruangan) && isset($fotoruangan[0])) :?>
                <img src="<?php echo base_url() ?>uploads/<?= $fotoruangan[0]['nama_file'] ?>" class="card-img-top" alt="tidak ada gambar" onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'">
            <?php else :?>
                <img src="<?php echo base_url() ?>uploads/<?= $fotoruangan['nama_file'] ?>" class="card-img-top" alt="tidak ada gambar" onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'">
            <?php endif;?>
            <div class="card-body">
                <h5 class="card-title"><?= $ruangan['nama'] ?></h5>
                <p class="card-text"><?= $ruangan['deskripsi'] ?></p>
                <p class="border border-1 rounded border-danger" style="padding-left: 10px; padding-right: 10px; width:fit-content;"><?= $ruangan['tipe'] ?></p>
                <p class="card-text">Kapasitas : <b><?= $ruangan['kapasitas']?></b></p>
                <p class="card-text">Fasilitas : <b><?= $ruangan['fasilitas']?></b></p>
                <p class="card-text">Ukuran : <b><?= $ruangan['ukuran']?></b></p>
                <p class="card-text mb-5">Biaya sewa : <b><?= $ruangan['biaya_sewa']?></b></p>
                <a class="btn btn-primary" href="/fasilitas/sewaruangan/<?= $ruangan['id'] ?>">Sewa Ruangan</a>
                <p class="card-text mb-2">Jadwal Sewa : </p>

                <?php //d($jadwal_sewa)?>
                <script>
                    //const element = document.getElementById("kt_docs_fullcalendar_basic");

                    var todayDate = moment().startOf("day");
                    var YM = todayDate.format("YYYY-MM");
                    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
                    var TODAY = todayDate.format("YYYY-MM-DD");
                    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

                    var calendarEl = document.getElementById("kt_docs_fullcalendar_basic");
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: "prev,next today",
                            center: "title",
                            right: "dayGridMonth,timeGridWeek,listMonth"
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                        nowIndicator: true,
                        now: TODAY + "T09:25:00", // just for demo

                        views: {
                            dayGridMonth: { buttonText: "month" },
                            timeGridWeek: { buttonText: "week" }
                        },

                        initialView: "dayGridMonth",
                        initialDate: TODAY,

                        editable: true,
                        dayMaxEvents: true, // allow "more" link when too many events
                        navLinks: true,
                        events: [
                            
                        ],

                        eventContent: function (info) {
                            var element = $(info.el);

                            if (info.event.extendedProps && info.event.extendedProps.description) {
                                if (element.hasClass("fc-day-grid-event")) {
                                    element.data("content", info.event.extendedProps.description);
                                    element.data("placement", "top");
                                    KTApp.initPopover(element);
                                } 
                                else if (element.hasClass("fc-time-grid-event")) {
                                    element.find(".fc-title").append("<div class=",fc-description,">" + info.event.extendedProps.description + "</div>");
                                } else if (element.find(".fc-list-item-title").lenght !== 0) {
                                    element.find(".fc-list-item-title").append("<div class=",fc-description,">" + info.event.extendedProps.description + "</div>");
                                }
                            }
                        }
                    });

                    calendar.render();
                </script>

                <script>

                    document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                        left: "prev,next,today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,listMonth"
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,
                    
                        nowIndicator: true,
                        now: TODAY, // just for demo

                        views: {
                        dayGridMonth: { buttonText: "month" },
                        timeGridWeek: { buttonText: "week" }
                        },
                        
                        initialView: 'dayGridMonth',

                        editable: true,
                        dayMaxEvents: true, // allow "more" link when too many events
                        navLinks: true,
                        events: <?php echo (isset($jadwal_sewa)) ? json_encode($jadwal_sewa) : null;?>, //array kegiatan -> objek kegiatan

                        eventTimeFormat: { // like '14:30:00'
                            // day: '2-digit',
                            // month: '2-digit',
                            // year: '4-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            meridiem: false
                        },

                        eventClick: function(info) {
                            //var mulai = info.event.start.format("DD-MM-YYYY");

                            alert('Kegiatan: ' + info.event.title + '\n' + 'Mulai: ' + info.event.start);
                            //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                            //alert('View: ' + info.view.type);

                            // change the border color just for fun
                            //info.el.style.borderColor = 'red';

                            //modal harusnya tapi ngga bisa
                            // Swal.fire({
                            //     text: "Are you sure you want to delete this event?",
                            //     icon: "warning",
                            //     showCancelButton: true,
                            //     buttonsStyling: false,
                            //     confirmButtonText: "Yes, delete it!",
                            //     cancelButtonText: "No, return",
                            //     customClass: {
                            //         confirmButton: "btn btn-primary",
                            //         cancelButton: "btn btn-active-light"
                            //     }
                            // }).then(function (result) {
                            //     if (result.value) {
                            //         arg.event.remove()
                            //     } else if (result.dismiss === "cancel") {
                            //         Swal.fire({
                            //             text: "Event was not deleted!.",
                            //             icon: "error",
                            //             buttonsStyling: false,
                            //             confirmButtonText: "Ok, got it!",
                            //             customClass: {
                            //                 confirmButton: "btn btn-primary",
                            //             }
                            //         });
                            //     }
                            // });
                        }
                                            
                    });
                    calendar.render();
                    });

                </script>
                <div id="calendar" style="width: 1000px;"></div>
            </div>
        </div>
    </div>
</div>