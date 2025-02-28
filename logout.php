<?php
require_once 'functions.php'; // Include helper functions 
session_destroy(); // Destroy the session to log out the user
header("Location: index.php"); // Redirect to the home page 
exit;
