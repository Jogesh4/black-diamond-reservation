<?php

error_reporting(E_ALL); ini_set('display_errors', 1);

// if not session already started
if(session_status() !== PHP_SESSION_ACTIVE ) session_start();  
include_once __DIR__ . '/includes/db.php';

if (!isset($_SESSION['admin-logged']) || $_SESSION['admin-logged'] !== true) {
    // If not, redirect them to the login page

    // header('Location: '.$pageUrl.'/login.php');
    // exit;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            color: #333;
        }

        .message {
            word-wrap: break-word; /* Older browsers */
            word-break: break-word;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h1>Admin Page - Reservations</h1>

<?php if (empty($reservations)): ?>
    <p>No reservations found.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Number of Guests</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Subscribe</th>
            <th>Remember Me</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?php echo htmlspecialchars($reservation['date']); ?></td>
                <td><?php echo htmlspecialchars($reservation['time']); ?></td>
                <td><?php echo htmlspecialchars($reservation['number_of_guests']); ?></td>
                <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                <td><?php echo htmlspecialchars($reservation['phone']); ?></td>
                <td class="message"><?php echo htmlspecialchars($reservation['message']); ?></td>
                <td><?php echo $reservation['subscribe'] ? 'Yes' : 'No'; ?></td>
                <td><?php echo $reservation['remember_me'] ? 'Yes' : 'No'; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination controls -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        Page <?php echo $page; ?>

        <?php if (count($reservations) == $itemsPerPage): ?>
            <?php
            // Check if there is a next page
            $nextPageReservations = getReservations($page + 1, $itemsPerPage);
            if (!empty($nextPageReservations)): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

</body>
</html>
