<?php

// Disallow direct access to this file
if (basename($_SERVER['SCRIPT_FILENAME']) === 'db.php') {
    die('This file cannot be accessed directly!');
}

$host = 'localhost';
$database = 'black-diamond';
$username = 'root';
$password = '';

$pageUrl = 'http://localhost/black-diamond';

if (!defined('MAIL_HOST')) define('MAIL_HOST', '');
if (!defined('MAIL_USERNAME')) define('MAIL_USERNAME', '');
if (!defined('MAIL_PASSWORD')) define('MAIL_PASSWORD', '');
if (!defined('MAIL_ENCRYPTION')) define('MAIL_ENCRYPTION', '');
if (!defined('MAIL_PORT')) define('MAIL_PORT', );
if (!defined('MAIL_FROM_ADDRESS')) define('MAIL_FROM_ADDRESS', '');
if (!defined('MAIL_FROM_NAME')) define('MAIL_FROM_NAME', 'Admin');
if (!defined('ADMIN_ADDRESS')) define('ADMIN_ADDRESS', 'test@admin.com');
if (!defined('ADMIN_NAME')) define('ADMIN_NAME', 'Admin');