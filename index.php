<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: php/personal_info.php');
    exit;
} else {
    header('Location: login_page.php');
    exit;
}
?>