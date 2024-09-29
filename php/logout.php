<?php
session_start();

session_unset();
session_destroy();

if (isset($_COOKIE['savedUser'])) {
    $lifetime = 60 * 60 * 24 * 7;
    setcookie("savedUser", $username, time() - $lifetime, "/");
}

header("Location: login.php");
exit();
?>

<form action="logout.php" method="POST">
    <button type="submit">Logout</button>
</form>