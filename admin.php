<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// if not session already started
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include_once __DIR__ . '/includes/db.php';

if (!isset($_SESSION['admin-logged']) || $_SESSION['admin-logged'] !== true) {
    // If not, redirect them to the login page
    if($_GET['login'] !== 'success') {
        header('Location: ' . $pageUrl . '/login.php');
        exit;
    }
}

// Number of items per page
$itemsPerPage = 10;

// Get current page from the query parameter
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Fetch reservations for the current page
try {
    $reservations = getReservations($page, $itemsPerPage);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}

function getReservations($page, $itemsPerPage)
{
    global $connection;

    // Calculate the offset based on the current page and items per page
    $offset = ($page - 1) * $itemsPerPage;

    // Fetch reservations using a query with LIMIT and OFFSET
    $query = "SELECT * FROM reservation LIMIT :limit OFFSET :offset";
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all rows as an associative array
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $reservations;
}

?>
<!doctype html>
<html lang="en" style="background-color: #000; padding-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>form</title>
    <!-- Bootstrap core CSS -->
    <link href="../form/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <style>
        .fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start{
          color: white;
          background: #3f366b;
        }

        a{
            color: inherit;
        }

        .bg-section {
            background: white;
            color: black;
        }
        .fc-daygrid-event{
            font-size: 16px;
            margin-bottom: 2px;
        }
        .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events{
            margin: 3px;
        }
    </style>
</head>
<body style="background-color: #000; padding-bottom: 0px;overflow-x: hidden;">
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12"><img style="width: 200px;" class="img-fluid mb-3" src="logo1-w.png">
                <div class="mobile">
                    <div class="hamburger-menu">
                        <div class="bar"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
            </div>
            <div class="mobile-nav hide">
                <ul>
                    <li><a href="/"><i class="fa fa-home"
                                                                                           aria-hidden="true"></i> HOME</a>
                    </li>
                    <li><a href="/about-us/"><i
                                    class="fa fa-file-text" aria-hidden="true"></i> About us</a></li>
                    <li data-bs-toggle="collapse" data-bs-target="#demo"><a class="dropdown-toggle"
                                                                            data-bs-toggle="dropdown"
                                                                            href="/packages/"><i
                                    class="fa fa-list" aria-hidden="true"></i> Packages<span
                                    class="et_mobile_menu_arrow"></span></a>
                    </li>
                    <ul id="demo" class="collapse">
                        <li><a href="#bowling">Bowling</a></li>
                        <li><a href="#pool">Pool</a></li>
                        <li><a href="#cosmic">Cosmic</a></li>
                        <li><a href="/birthday-fun/">Birthday
                                Fun</a></li>
                        <li><a href="/food-menu/">Food Menu</a></li>
                    </ul>

                    <li><a href="/blog/"><i class="fa fa-file-text"
                                                                                                aria-hidden="true"></i>
                            Blog</a></li>
                    <li><a href="/contact-us/"><i
                                    class="fa fa-file-text" aria-hidden="true"></i> Contact Us</a></li>

                </ul>
            </div>
        </div>
    </div>
</section>
<section class="bg-section">
    <div class="container">
        <div class="row">
            <div id="full-calendar">

            </div>
        </div>
    </div>
</section>
<footer id="main-footer">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 "><p><img class="img-fluid"
                                                    src="/wp-content/uploads/2024/01/logo1-w.png">
                </p>
                <p>We constantly have new projects on the go, so come on by and see what’s new!</p>
            </div>
            <div class="col-lg-3 col-md-3 px-lg-5"><h4 class="title">Quick Link</h4>

                <ul id="menu-footer" class="menu">
                    <li id="menu-item-291"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-291"><a
                                href="/home/">Home</a></li>
                    <li id="menu-item-290"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-290"><a
                                href="/about-us/">About us</a></li>
                    <li id="menu-item-289"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-289"><a
                                href="/packages/">Packages</a></li>
                    <li id="menu-item-288"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-288"><a
                                href="/blog/">Blog</a></li>
                    <li id="menu-item-287"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-287"><a
                                href="/contact-us/">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-3"><h4 class="title">Hours</h4>
                <p><b>Mon- Fir:</b> 12:00 PM – 12:00 AM</p>
                <p><b>Saturday:</b> 12:00 PM – 1:00 AM</p>
                <p><b>Sunday:</b> 12:00 PM – 7:00 PM</p>
            </div>
            <div class="col-lg-3 col-md-3 "><h4 class="title">Follow Us</h4>
                <div><a href="">
                        <div class="fb">
                            <i class="fa-brands fa-facebook-f"></i>
                        </div>
                    </a></div>
                <div><a href="">
                        <div class="insta">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                    </a></div>
                <div><a href="">
                        <div class="location">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </div>
                    </a></div>
            </div>
        </div>
    </div>


    <div id="footer-bottom">
        <div class="container clearfix">
            <ul class="et-social-icons">

                <li class="et-social-icon et-social-facebook">
                    <a href="#" class="icon">
                        <span>Facebook</span>
                    </a>
                </li>
                <li class="et-social-icon et-social-twitter">
                    <a href="#" class="icon">
                        <span>X</span>
                    </a>
                </li>
                <li class="et-social-icon et-social-instagram">
                    <a href="#" class="icon">
                        <span>Instagram</span>
                    </a>
                </li>

            </ul>
            <div id="footer-info">Copyright © 2024 Black Diamond Bowl &amp; Billiards - All Rights Reserved.</div>
        </div>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

<script>
    function today(){
        // return today date in the format of YYYY-MM-DD
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        let yyyy = today.getFullYear();
        return yyyy + '-' + mm + '-' + dd;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        let eventsCache = {};

            var calendarEl = document.getElementById('full-calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: today(),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // events: function (fetchInfo, successCallback, failureCallback) {
                //     let start = fetchInfo.startStr;
                //     let end = fetchInfo.endStr;
                //
                //     if (eventsCache[start] && eventsCache[start][end]) {
                //         successCallback(eventsCache[start][end]);
                //     } else {
                //         $.ajax({
                //             url: 'http://localhost/black-diamond/bookings.php',
                //             data: {
                //                 start: start,
                //                 end: end
                //             },
                //             success: function(events) {
                //                 if (!eventsCache[start]) {
                //                     eventsCache[start] = {};
                //                 }
                //                 eventsCache[start][end] = events;
                //                 console.log(events);
                //                 successCallback(events);
                //             }
                //         });
                //     }
                // },
                datesSet: function(dateInfo) {
                    console.log(dateInfo);
                    let start = dateInfo.startStr;
                    let end = dateInfo.endStr;

                    if (eventsCache[start] && eventsCache[start][end]) {
                        calendar.addEventSource(eventsCache[start][end]);
                    } else {
                        $.ajax({
                            url: '<?=$pageUrl?>/bookings.php',
                            data: {
                                start: start,
                                end: end
                            },
                            success: function(events) {
                                if (!eventsCache[start]) {
                                    eventsCache[start] = {};
                                }
                                eventsCache[start][end] = events.map(function(event) {
                                    return {
                                        title: event.name + ' - ' + event.email, // Combine name and email for the title
                                        start: event.date + 'T' + event.time, // Combine date and time for the start
                                        extendedProps: event, // Store the event data in the extendedProps property
                                        color: event.type === '' ? 'blue' : 'green', // Change the color based on the type
                                        textColor: 'white' // Set the text color to white for better visibility
                                    };
                                });

                                calendar.addEventSource(eventsCache[start][end]);
                            }
                        });
                    }
                },
                eventClick: function(info) {
                    var event = info.event;

                    console.log(info, event)

                    // Populate the modal with the event data
                    document.getElementById('event-title').textContent = event.extendedProps.name +'-'+event.extendedProps.phone;
                    // document.getElementById('event-name').textContent = 'Name: ' + event.extendedProps.name;
                    document.getElementById('event-email').textContent = event.extendedProps.email;
                    document.getElementById('event-date').textContent = event.extendedProps.date;
                    document.getElementById('event-time').textContent = event.extendedProps.time;
                    document.getElementById('event-duration').textContent =event.extendedProps.duration;
                    document.getElementById('event-number_of_guests').textContent = event.extendedProps.number_of_guests;
                    document.getElementById('event-pack').textContent = event.extendedProps.pack;
                    // document.getElementById('event-phone').textContent = 'Phone: ' + event.extendedProps.phone;
                    document.getElementById('event-quantity').textContent =  (event.extendedProps.quantity ? event.extendedProps.quantity : 'N/A');
                    document.getElementById('event-remember_me').textContent = (event.extendedProps.rememberMe ? 'Yes' : 'No');
                    document.getElementById('event-reservation_id').textContent = event.extendedProps.reservation_id;
                    document.getElementById('event-subscribe').textContent = (event.extendedProps.subscribe ? 'Yes' : 'No');
                    document.getElementById('event-type').textContent = (event.extendedProps.type ? event.extendedProps.type : 'N/A');
                    document.getElementById('event-message').textContent =  event.extendedProps.message;
                    document.getElementById('event-shoe-rental').textContent =  event.extendedProps.shoe_rental;

                    // Show the modal
                    document.getElementById('event-modal').showModal();
                }
            });

            calendar.render();
        // var calendarEl = document.getElementById('full-calendar');
        // var calendar = new FullCalendar.Calendar(calendarEl, {
        //     initialView: 'dayGridMonth',
        //     initialDate: today(),
        //     headerToolbar: {
        //         left: 'prev,next today',
        //         center: 'title',
        //         right: 'dayGridMonth,timeGridWeek,timeGridDay'
        //     },
        //     events: [
        //         {
        //             title: 'All Day Event',
        //             start: '2024-02-01'
        //         },
        //         {
        //             title: 'All Day Event2',
        //             start: '2024-02-01'
        //         },
        //         {
        //             title: 'Long Event',
        //             start: '2024-02-07',
        //             end: '2024-02-08'
        //         },
        //         {
        //             id: 999,
        //             title: 'Repeating Event',
        //             start: '2022-01-09T16:00:00'
        //         },
        //     ],
        //     eventClick: function (info) {
        //         alert('Event: ' + info.event.title);
        //     }
        // });
        //
        // calendar.render();
        // Show full calendar on the page
        // $('#full-calendar').fullCalendar({
        //     header: {
        //         left: 'prev,next today',
        //         center: 'title',
        //         right: 'month,basicWeek,basicDay',
        //     },
        //     defaultDate: today(),
        //     navLinks: true, // can click day/week names to navigate views
        //     editable: true,
        //     eventLimit: true, // allow "more" link when too many events
        //     events: [
        //         {
        //             title: 'All Day Event',
        //             start: '2022-01-01'
        //         },
        //         {
        //             title: 'Long Event',
        //             start: '2022-01-07',
        //             end: '2022-01-10'
        //         },
        //         {
        //             id: 999,
        //             title: 'Repeating Event',
        //             start: '2022-01-09T16:00:00'
        //         },
        //     ],
        //     eventClick: function (event) {
        //         alert('Event: ' + event.title);
        //     }
        // });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('event-modal').close();
        });
    });
</script>
<dialog id="event-modal" style="border: none; border-radius: 5px; width: 80%; max-width: 500px;">
    <header>
        <h4 id="event-title" style="margin: 0;"></h4>
        <h6 id="event-email" style="margin: 0;"></h6>
    </header>
    <div class="event-data">
        <!-- <p id="event-name"></p>
        <p id="event-email"></p> -->
        <p>
            <strong>Date: </strong>
            <span id="event-date"></span>
        </p>
        <p>
            <strong>Time: </strong>
            <span id="event-time"></span>
        </p>
        <p>
            <strong>Duration: </strong>
            <span id="event-duration"></span>
        </p>
        <p>
            <strong>Number of Guests: </strong>
            <span id="event-number_of_guests"></span>
        </p>
        <p>
            <strong>Type: </strong>
            <span id="event-type"></span>
        </p>
        <p>
            <strong>Pack: </strong>
            <span id="event-pack"></span>
        </p>
        <p>
            <strong>Quantity: </strong>
            <span id="event-quantity"></span>
        </p>
        <p>
            <strong>Reservation id: </strong>
            <span id="event-reservation_id"></span>
        </p>
        <p>
            <strong>Subscribe: </strong>
            <span id="event-subscribe"></span>
        </p>
        <p>
            <strong>Remember Me: </strong>
            <span id="event-remember_me"></span>
        </p>
        <p>
            <strong>Message: </strong>
            <span id="event-message"></span>
        </p>
        <p>
            <strong>Shoe Rental: </strong>
            <span id="event-shoe-rental"></span>
        </p>
    </div>
    <button id="close-modal" class="btn btn-secondary" style="display: block; margin: 0 auto; grid-column: span 2;">Close</button>
</dialog>













<style>
    .event-data{
        display: grid;
        grid-template-columns: auto auto;
        grid-gap: 10px;
    }

    dialog[open]::backdrop{
        backdrop-filter: blur(3px) contrast(.8);
    }
    dialog#event-modal {
        border: none;
        border-radius: 5px;
        width: 80%;
        max-width: 500px;
        backdrop-filter: blur(10px); /* Add this line to create a blur effect */

    }

    dialog#event-modal header{
        margin-bottom: 4px;
        padding-bottom: 4px;
        border-bottom: 2px solid gray;
    }
</style>

</body>
</html>
