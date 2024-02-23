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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /><script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
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
              <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
<li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/about-us/"><i class="fa fa-file-text" aria-hidden="true"></i> About us</a></li>
<li data-bs-toggle="collapse" data-bs-target="#demo"><a class="dropdown-toggle" data-bs-toggle="dropdown" href="https://wordpressmu-603031-4219011.cloudwaysapps.com/packages/"><i class="fa fa-list" aria-hidden="true"></i> Packages<span class="et_mobile_menu_arrow"></span></a>
</li>
    <ul id="demo" class="collapse">
      <li><a href="#bowling">Bowling</a></li>
	<li><a href="#pool">Pool</a></li>
	<li><a href="#cosmic">Cosmic</a></li>
	<li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/birthday-fun/">Birthday Fun</a></li>
	<li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/food-menu/">Food Menu</a></li>
	</ul>
  
<li ><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/blog/"><i class="fa fa-file-text" aria-hidden="true"></i> Blog</a></li>
<li ><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/contact-us/"><i class="fa fa-file-text" aria-hidden="true"></i> Contact Us</a></li>

				</ul>
          </div>
        </div>
</div></section>

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
<footer id="main-footer">
				
            <div class="container">
                <div class="row">
                   <div class="col-lg-3 col-md-3 "><p><img class="img-fluid" src="https://wordpressmu-603031-4219011.cloudwaysapps.com/wp-content/uploads/2024/01/logo1-w.png"></p>
            <p>We constantly have new projects on the go, so come on by and see what’s new!</p>
            </div>
           <div class="col-lg-3 col-md-3 px-lg-5"><h4 class="title">Quick Link</h4>
            
            <ul id="menu-footer" class="menu">
            <li id="menu-item-291" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-291"><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/home/">Home</a></li>
            <li id="menu-item-290" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-290"><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/about-us/">About us</a></li>
            <li id="menu-item-289" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-289"><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/packages/">Packages</a></li>
            <li id="menu-item-288" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-288"><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/blog/">Blog</a></li>
            <li id="menu-item-287" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-287"><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/contact-us/">Contact Us</a></li>
            </ul></div>
            
            <div class="col-lg-3 col-md-3"><h4 class="title">Hours</h4>			
                <p><b>Mon- Fir:</b> 12:00 PM – 12:00 AM</p>
            <p><b>Saturday:</b> 12:00 PM – 1:00 AM</p>
            <p><b>Sunday:</b> 12:00 PM – 7:00 PM</p>
                    </div>
					<div class="col-lg-3 col-md-3 "><h4 class="title">Follow Us</h4>
               <div><a href=""><div class="fb">
    <i class="fa-brands fa-facebook-f"></i>
   </div></a></div>
  <div><a href=""> <div class="insta">
    <i class="fa-brands fa-instagram"></i>
   </div></a></div>
 <div> <a href=""> <div class="location">
   <i class="fa-brands fa-linkedin-in"></i>
   </div></a></div>
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
            
            </ul><div id="footer-info">Copyright © 2024 Black Diamond Bowl &amp; Billiards - All Rights Reserved.</div>					</div>
                            </div>
                        </footer>






        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
</body>
</html>
