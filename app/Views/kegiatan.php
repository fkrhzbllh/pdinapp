<!-- ======= Judul Section ======= -->
<section id="background-hitam-atas" class="d-flex align-items-center">
    <div class="container">
        <div class="text-center">
            <h2 class="text-light my-4">Kegiatan</h2>
            <p class="text-light lh-base">
                Informasi terkait semua kegiatan yang dilakukan di Pusat Desain
                Industri Nasional adalah sebagai berikut.
            </p>
        </div>
    </div>
</section>
<!-- End Hero -->

<!-- ======= isi Section ======= -->
<section id="isi-section">
    <div class="container p-3">
        <div class="bg-light rounded-5 p-5" id="">
            <div class="row">
                <div class="col-12">
                    <div id="calendar"></div>
                    <!-- Modal Kegiatan Detail -->
                    <div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-black border border-0">
                                    <h1 class="modal-title fs-4 text-white" id="exampleModalLabel">
                                        Detail Kegiatan
                                    </h1>

                                    <button type="button" class="btn-close bg-secondary me-1" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="bg-danger w-100" style="height: 4px"></div>
                                <div class="modal-body">
                                    <div class="row p-2">
                                        <h4 id="judul_kegiatan" class="">-</h4>
                                    </div>
                                    <div class="row p-2">
                                        <div class="col-12 col-lg-6 ps-1">
                                            <!-- jenis kegiatan -->
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-balloon"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary mt-0 pt-0">Jenis Kegiatan:</small>
                                                    <p class="p-0 fw-bold mb-1" id="jenis_kegiatan">-</p>
                                                </div>
                                            </div>
                                            <!-- Tipe Kegiatan -->
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-activity"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary">Tipe Kegiatan:</small>
                                                    <p class="p-0 fw-bold mb-1" id="tipe_kegiatan">-</p>
                                                </div>
                                            </div>
                                            <!-- Waktu Kegiatan -->
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-calendar-event"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary">Waktu Kegiatan:</small>
                                                    <p class="p-0 fw-bold mb-1" id="tgl_mulai">
                                                        -
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Lokasi Kegiatan -->
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-geo-alt"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary">Lokasi Kegiatan:</small>
                                                    <p class="p-0 fw-bold mb-1" id="tempat">
                                                        -
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Link Pendaftaran -->
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-link-45deg"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary">Link Pendaftaran:</small>
                                                    <div id="link-pendaftaran-modal-kegiatan" class="p-0 fw-bold mb-1">
                                                        <a href="" class="" id="link_pendaftaran" target="_blank">
                                                            -
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Link Virtual -->
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-link-45deg"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary">Link Virtual:</small>
                                                    <div id="link-virtual-modal-kegiatan" class="p-0 fw-bold mb-1">
                                                        <a href="" class="" id="link_virtual" target="_blank">
                                                            -
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Poster Kegiatan -->
                                        <div class="col-12 col-lg-6 ps-1 mb-4">
                                            <div class="row p-0 m-0 mb-1">
                                                <div class="col-1 m-0 p-0 align-self-start">
                                                    <div class="text-center">
                                                        <i class="bi bi-image"
                                                            style="font-size: 14px; color: 8c8c8c"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                                    <small class="mb-1 text-secondary">Poster kegiatan:</small>
                                                    <img src="" alt="" class="img-fluid object-fit-cover rounded-3 mt-2"
                                                        id="poster" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            // initialView: 'listWeek',
            selectable: true,
            events: <?php  echo json_encode($kegiatan)?> , //array kegiatan -> objek kegiatan

            eventClick: function(arg) {
                const formatter2 = new Intl.DateTimeFormat('id-ID', {
                    // dateStyle: "full",
                    // timeStyle: "long",
                    weekday: "long",
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    timeZoneName: "short",
                    timeZone: "Asia/Jakarta",
                });
                const mulai = formatter2.format(arg.event.start);
                $('.modal-body').find('#judul_kegiatan').text(arg.event.title);
                $('.modal-body').find('#jenis_kegiatan').text(arg.event.extendedProps
                    .jenis_kegiatan);
                $('.modal-body').find('#tipe_kegiatan').text(arg.event.extendedProps.tipe_kegiatan);
                $('.modal-body').find('#tgl_mulai').text(mulai);
                $('.modal-body').find('#tempat').text(arg.event.extendedProps.tempat);
                $('.modal-body').find('#link_pendaftaran').text(arg.event.extendedProps
                    .link_pendaftaran);
                $('.modal-body').find('#link_pendaftaran').attr("href", arg.event.extendedProps
                    .link_pendaftaran);
                $('.modal-body').find('#link_virtual').text(arg.event.extendedProps.link_virtual);
                $('.modal-body').find('#link_virtual').attr("href", arg.event.extendedProps
                    .link_virtual);
                $('.modal-body').find('#poster').attr('src', arg.event.extendedProps.poster);
                $('#modalKegiatan').modal('toggle');
            },
            editable: true,
            dayMaxEvents: false,
        });
        calendar.render();
    });
</script>

<!-- <script>
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
        aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

        nowIndicator: true,
        now: TODAY + "T09:25:00", // just for demo

        views: {
            dayGridMonth: {
                buttonText: "month"
            },
            timeGridWeek: {
                buttonText: "week"
            },
        },

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        navLinks: true,
        events: [

        ],

        eventContent: function(info) {
            var element = $(info.el);

            if (info.event.extendedProps && info.event.extendedProps.description) {
                if (element.hasClass("fc-day-grid-event")) {
                    element.data("content", info.event.extendedProps.description);
                    element.data("placement", "top");
                    KTApp.initPopover(element);
                } else if (element.hasClass("fc-time-grid-event")) {
                    element.find(".fc-title").append("<div class=", fc - description, ">" + info.event
                        .extendedProps.description + "</div>");
                } else if (element.find(".fc-list-item-title").lenght !== 0) {
                    element.find(".fc-list-item-title").append("<div class=", fc - description, ">" + info
                        .event.extendedProps.description + "</div>");
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
                dayGridMonth: {
                    buttonText: "month"
                },
                timeGridWeek: {
                    buttonText: "week"
                },
            },

            initialView: 'dayGridMonth',

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            events: <?php //echo json_encode($kegiatan)?> , //array
kegiatan -> objek kegiatan

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
// text: "Are you sure you want to delete this event?",
// icon: "warning",
// showCancelButton: true,
// buttonsStyling: false,
// confirmButtonText: "Yes, delete it!",
// cancelButtonText: "No, return",
// customClass: {
// confirmButton: "btn btn-primary",
// cancelButton: "btn btn-active-light"
// }
// }).then(function (result) {
// if (result.value) {
// arg.event.remove()
// } else if (result.dismiss === "cancel") {
// Swal.fire({
// text: "Event was not deleted!.",
// icon: "error",
// buttonsStyling: false,
// confirmButtonText: "Ok, got it!",
// customClass: {
// confirmButton: "btn btn-primary",
// }
// });
// }
// });
}

});
calendar.render();
});
</script> -->

<?php //d($kegiatan);
	//foreach($kegiatan as $k){
	//echo json_encode($k).',';};
	//echo json_encode($kegiatan);?>