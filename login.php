<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
if(session_status() !== PHP_SESSION_ACTIVE ) session_start();  
include_once __DIR__ . '/includes/env.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Here you would typically check the username and password against a database
    // For simplicity, we're just checking against hardcoded values
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['admin-logged'] = 'true';
        header('Location: '.$pageUrl.'/admin.php?login=success');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .login-form {
            width: 300px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: 0;
            color: white;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-form">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
    </html>