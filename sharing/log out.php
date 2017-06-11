<?php
session_start();

session_unset($_SESSION['logged on']);
header("Location: index.php");
?>
