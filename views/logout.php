<?php
// // Start or resume the session
session_start();

// Unset all session variables
// $_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to another page if needed
header("Location: home.php");
exit; // Ensure that subsequent code is not executed after the redirect
?>
