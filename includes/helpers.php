<?php


function getReservationsForDate($date, PDO $connection)
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

    $stmt = $connection->prepare('SELECT * FROM reservation WHERE date = :date');
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    // log execute query
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Store the result in the cache
//    $_SESSION[$cacheKey] = $reservations;

    // Return the reservations
    return $reservations;
}


function getAvailableTimeSlots($date, PDO $connection, $onlyAvailable = false)
{
    // Get all reservations for the given date
    $date = date('Y-m-d', strtotime($date));
    $reservations = getReservationsForDate($date, $connection);

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
        if (in_array($timeSlot, $bookedTimeSlots)) {
            if (!$onlyAvailable) {
                $reservation = array_filter($reservations, function ($reservation) use ($timeSlot) {
                    return date('H:i', strtotime($reservation['time'])) === $timeSlot;
                });
                $reservation = array_shift($reservation);
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
