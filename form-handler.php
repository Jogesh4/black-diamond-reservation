<?php

error_reporting(E_ALL); ini_set('display_errors', 1);
// if not session already started
if(session_status() !== PHP_SESSION_ACTIVE ) session_start();
include_once __DIR__ . '/includes/db.php';

unset($_SESSION['form_errors']);
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once(__DIR__.'/vendor/PHPMailer/src/Exception.php');
require_once(__DIR__.'/vendor/PHPMailer/src/PHPMailer.php');
require_once(__DIR__.'/vendor/PHPMailer/src/SMTP.php');


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

    $message = file_get_contents(__DIR__.'/includes/template_reservation_email.php');
    $mail_variables = array();
    $mail_variables['name'] = $name;
    $mail_variables['email'] = $email;
    $mail_variables['phone'] = $phone;
    $mail_variables['date'] = $date;
    $mail_variables['time'] = $time;
    $mail_variables['type'] = $type;
    $mail_variables['pack'] = $pack;
    $mail_variables['number_of_guests'] = $numberOfGuests;
    $mail_variables['duration'] = $duration;
    $mail_variables['shoe_rentals'] = $shoeRentals;
    $mail_variables['quantity'] = $quantity;
    $mail_variables['message'] = $message;
    $mail_variables['subscribe'] = $subscribe;
    $mail_variables['remember_me'] = $rememberMe;
    $mail_variables['APP_NAME'] = $_ENV['APP_NAME'];

    $subject = 'New Reservation from ' . $name . ' for ' . $type . ' ' . $pack;
    foreach ($mail_variables as $key => $value) {
        $message = str_replace('{{ ' . $key . ' }}', $value, $message);
    }

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $mail->addAddress(ADMIN_ADDRESS, ADMIN_NAME);

        $mail->isHTML();
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
    } catch (Exception $e) {

        // for public use
        $_SESSION['ERRORS']['status'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;

        // for development use
        // $_SESSION['STATUS']['mailstatus'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;

        // Save log to file if mail failed to send
        $log = date('Y-m-d H:i:s') . ' - ' . $mail->ErrorInfo . PHP_EOL.
            'Subject: ' . $subject . PHP_EOL;
        // if file does not exist, create it
        if (!file_exists(__DIR__.'/logs/mail.log')) {
            file_put_contents(__DIR__.'/logs/mail.log', '');
        }

        file_put_contents(__DIR__.'/logs/mail.log', $log, FILE_APPEND);
    }

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