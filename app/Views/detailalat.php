<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="column">
            </div><div class="card mb-3">
              <img src="<?php echo base_url() ?>uploads/5ea50f43831c2.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?= $alat['nama'] ?></h5>
                <p class="card-text"><?= $alat['deskripsi'] ?></p>
                <p class="card-text mb-5">Biaya sewa : <b><?= $alat['biaya_sewa']?></b></p>
                <a class="btn btn-primary" href="/fasilitas/sewaalat/<?= $alat['id'] ?>">Sewa Alat</a>
                <p class="card-text mb-2">Jadwal Sewa : </p>
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
                            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                        nowIndicator: true,
                        now: TODAY + "T09:25:00", // just for demo

                        views: {
                            dayGridMonth: { buttonText: "month" },
                            timeGridWeek: { buttonText: "week" },
                            timeGridDay: { buttonText: "day" }
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
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,
                    
                        nowIndicator: true,
                        now: TODAY, // just for demo

                        views: {
                        dayGridMonth: { buttonText: "month" },
                        timeGridWeek: { buttonText: "week" },
                        timeGridDay: { buttonText: "day" }
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