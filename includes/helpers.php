<?php


function getReservationsForDate($date, $type, PDO $connection)
{
    // Use the date as the cache key
//    $cacheKey = "reservations_$date";
//
//    // Check if the reservations are already stored in the cache
//    if (isset($_SESSION[$cacheKey])) {
//        // Return the cached reservations
//        return $_SESSION[$cacheKey];
//    }

    $date = date('Y-m-d', strtotime($date)); // Convert the date to 'Y-m-d' format

    $stmt = $connection->prepare('SELECT * FROM reservation WHERE date = :date AND type = :type');
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':type', $type);
    $stmt->execute();

    // log execute query
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Store the result in the cache
//    $_SESSION[$cacheKey] = $reservations;

    // Return the reservations
    return $reservations;
}


function getAvailableTimeSlots($date, $type,  PDO $connection, $onlyAvailable = false)
{
    // Get all reservations for the given date
    $date = date('Y-m-d', strtotime($date));
    $reservations = getReservationsForDate($date, $type, $connection);

    // Define a list of all possible time slots
    $secondInHour = 60 * 60;
    $allTimeSlots = range(strtotime('09:00'), strtotime('22:00'), $secondInHour);
    $allTimeSlots = array_map(function ($time) {
        return date('H:i', $time);
    }, $allTimeSlots);

    $bookedTimeSlots = array_column($reservations, 'time');
    $bookedTimeSlots = array_map(function ($time) {
        return date('H:i', strtotime($time));
    }, $bookedTimeSlots);

    $bookedTimeSlots = array_unique($bookedTimeSlots);

    $finalTimeSlots = [];
    foreach ($allTimeSlots as $timeSlot) {
        if (isSlotReserved($timeSlot, $reservations)) {
            if (!$onlyAvailable) {
                $reservation = reservationAt($timeSlot, $reservations);
                $formattedTime = date('h:i A', strtotime($timeSlot));
                $finalTimeSlots[] = [
                    'available' => false,
                    'time' => $timeSlot,
                    'formattedTime' => $formattedTime,
                    'name' => $reservation['name'],
                    'email' => $reservation['email'],
                    'phone' => $reservation['phone']
                ];
            }
        } else {
            $formattedTime = date('h:i A', strtotime($timeSlot));
            $finalTimeSlots[] = [
                'available' => true,
                'time' => $timeSlot,
                'formattedTime' => $formattedTime
            ];
        }
    }

    return $finalTimeSlots;
}

function isSlotReserved($timeSlot, $reservations){
    $timeSlot = date('H:i', strtotime($timeSlot));
    $reservedTimeSlot = [];
    foreach ($reservations as $reservation) {
        $durationInHours = $reservation['duration'] ?? 1;

        for ($i = 0; $i < $durationInHours; $i++) {
            $reservedTimeSlot[] = date('H:i', strtotime($reservation['time']) + $i * 60 * 60);
        }
    }

    return in_array($timeSlot, $reservedTimeSlot);
}

function reservationAt($timeSlot, $reservations){
    $timeSlot = date('H:i', strtotime($timeSlot));
    $foundReservation = null;
    foreach ($reservations as $reservation) {
        $reservedSlots = [];
        $durationInHours = $reservation['duration'] ?? 1;

        for ($i = 0; $i < $durationInHours; $i++) {
            $reservedSlots[] = date('H:i', strtotime($reservation['time']) + $i * 60 * 60);
        }

        if (in_array($timeSlot, $reservedSlots)) {
            $foundReservation = $reservation;
            break;
        }
    }

    return $foundReservation;
}

function isSlotBooked($timeSlot, $bookedTimeSlots){
    // it should check the duration too
    $timeSlotBooked = [];

    foreach ($bookedTimeSlots as $bookedTimeSlot) {
        // Add it to the booked time slots
        $bookedTimeSlot = date('H:i', strtotime($bookedTimeSlot));
        $duration = 1;
    }
}
