<?php
// Start the session
session_start();

// Destroy all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: /sample/index.php");
exit();
?>
