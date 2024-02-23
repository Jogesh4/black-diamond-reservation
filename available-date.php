<?php

$date = $_GET['date'] ?? date('Y-m-d');

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/classes/ReservationManager.php';

global  $connection;
include_once  __DIR__ . '/includes/db.php';

$reservationManager = new ReservationManager($connection);
$availableTimeSlots = $reservationManager->getAvailableTimeSlots($date);

// Return formatted JSON response
header('Content-Type: application/json');
$finalResponse = [];
$finalResponse['date'] = $date;
$finalResponse['timeSlots'] = $availableTimeSlots;
echo json_encode($finalResponse);

exit();