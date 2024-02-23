<?php

global $connection;
include_once __DIR__ . '/includes/db.php';

// Get the start and end dates from the request parameters
$start = $_GET['start'];
$end = $_GET['end'];

// Prepare a query to fetch the events from the database
$query = 'SELECT * FROM reservation WHERE date >= :start AND date <= :end';
$stmt = $connection->prepare($query);

// Bind the start and end dates to the query
$stmt->bindParam(':start', $start);
$stmt->bindParam(':end', $end);

// Execute the query
$stmt->execute();

// Fetch all rows as an associative array
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Return the events as a JSON response
header('Content-Type: application/json');
echo json_encode($events);