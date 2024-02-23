<?php


function getReservationsForDate($date, PDO $connection) {
    // Use the date as the cache key
    $cacheKey = "reservations_$date";

    // Check if the reservations are already stored in the cache
    if (isset($_SESSION[$cacheKey])) {
        // Return the cached reservations
        return $_SESSION[$cacheKey];
    }

    $stmt = $connection->prepare('SELECT * FROM reservation WHERE date = :date');
    $stmt->execute(['date' => $date]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Store the result in the cache
    $_SESSION[$cacheKey] = $reservations;

    // Return the reservations
    return $reservations;
}


function getAvailableTimeSlots($date, PDO $connection, $onlyAvailable = false) {
    // Get all reservations for the given date
    $reservations = getReservationsForDate($date, $connection);

    // Define a list of all possible time slots
    $secondInHalfHour = 30 * 60;
    $allTimeSlots = range(strtotime('09:00'), strtotime('22:00'), $secondInHalfHour);
    $allTimeSlots = array_map(function ($time) {
        return date('H:i', $time);
    }, $allTimeSlots);

    $bookedTimeSlots = array_column($reservations, 'time');

    $finalTimeSlots = [];
    foreach ($allTimeSlots as $timeSlot) {
        if (in_array($timeSlot, $bookedTimeSlots)) {
            if(!$onlyAvailable){
                $reservation = array_filter($reservations, function($reservation) use ($timeSlot) {
                    return $reservation['time'] === $timeSlot;
                });
                $reservation = array_shift($reservation);
                $finalTimeSlots[] = [
                    'available' => false,
                    'time' => $timeSlot,
                    'name' => $reservation['name'],
                    'email' => $reservation['email'],
                    'phone' => $reservation['phone']
                ];
            }
        } else {
            $finalTimeSlots[] = [
                'available' => true,
                'time' => $timeSlot
            ];
        }
    }

    return $finalTimeSlots;
}
