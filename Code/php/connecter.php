<?php
session_start();
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    header("Location: ./login.php");
    exit;
}
?>