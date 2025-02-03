<?php
session_start();  // Start the session

 
// Destroy the session
session_destroy();

echo 'Session destroyed';  // Send a response
?>
