<?php

error_reporting(E_ALL); ini_set('display_errors', 1);
// if not session already started
if(session_status() !== PHP_SESSION_ACTIVE ) session_start();
include_once __DIR__ . '/includes/db.php';

unset($_SESSION['form_errors']);

/**
 * @var PDO $connection
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formUrl = $pageUrl. '/form.php?type=' . $_POST['type']. '&pack=' . $_POST['pack'];
    $errors = validateFormData($_POST);

    if(count($errors)){
        $_SESSION['form_errors'] = $errors;
        header('Location: '. $formUrl.'&success=0');
        exit();
    }

    $date = $_POST['date'];
    $time = $_POST['time'];
    $type = $_POST['type'];
    $pack = $_POST['pack'];
    $numberOfGuests = $_POST['number_of_guests'];
    $duration = $_POST['duration'];
    $shoeRentals = isset($_POST['shoe_rentals']) ? 1 : 0;
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;
    $rememberMe = isset($_POST['remember_me']) ? 1 : 0;

    $sql = "INSERT INTO reservation (date, time, type, pack, number_of_guests, duration, quantity, shoe_rental, name, email, phone, message, subscribe, remember_me) VALUES (:date, :time, :type, :pack, :numberOfGuests, :duration, :quantity, :shoeRental, :name, :email, :phone, :message, :subscribe, :rememberMe)";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":time", $time);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":pack", $pack);
    $stmt->bindParam(":numberOfGuests", $numberOfGuests);
    $stmt->bindParam(":duration", $duration);
    $stmt->bindParam(":quantity", $quantity);
    $stmt->bindParam(":shoeRental", $shoeRentals);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":message", $message);
    $stmt->bindParam(":subscribe", $subscribe);
    $stmt->bindParam(":rememberMe", $rememberMe);

    $stmt->execute();

    $_SESSION['form_success'] = 'Your reservation has been successfully submitted!';
    header('Location: '. $formUrl.'&success=1');
    exit();
}

function validateFormData($data): array
{
    unset($_SESSION['form_errors']);
    $errors = [];

    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Example: Validate date format (YYYY-MM-DD)
    if (empty($data['date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date'])) {
        $errors['date'] = 'Please enter a valid date, format: YYYY-MM-DD.';
    }

    // Example: Validate time format (HH:mm)
    if (empty($data['time']) || !preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $data['time'])) {
        $errors['time'] = 'Please enter a valid time, format: HH:mm.';
    }

    // Example: Validate number of guests (positive integer)
    if (empty($data['number_of_guests']) || !is_numeric($data['number_of_guests']) || $data['number_of_guests'] <= 0) {
        $errors['number_of_guests'] = 'Please enter a valid number of guests.';
    }

    // Example: Validate name (non-empty string)
    if (empty($data['name'])) {
        $errors['name'] = 'Please enter your name.';
    }

    // Example: Validate phone number format
    if (!empty($data['phone']) && !preg_match('/^\d{10}$/', $data['phone'])) {
        $errors['phone'] = 'Please enter a valid 10-digit phone number.';
    }

    // Example: Validate message length
    if (strlen($data['message']) > 255) {
        $errors['message'] = 'Please enter a message with less than 255 characters.';
    }

//    if (isset($data['subscribe']) && $data['subscribe'] != 1) {
//        $errors['subscribe'] = 'Please accept the terms and conditions.';
//    }
//
//    // Example: Validate checkbox for remember_me
//    if (isset($data['remember_me']) && $data['remember_me'] != 1) {
//        $errors['remember_me'] = 'Please accept the terms and conditions.';
//    }

    $_SESSION['form_errors'] = $errors;

    return $errors;
}

header('Location: /');
exit();