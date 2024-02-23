<?php

require_once __DIR__.'/../helpers.php';

class ReservationManager {
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function getAvailableTimeSlots($date): array
    {
        return getAvailableTimeSlots($date, $this->connection);
    }
}