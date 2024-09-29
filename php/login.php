<?php
session_start();

$username = "";
$password = "";
$rememberUser = false;
$errorMessage = "";

if (isset($_COOKIE["savedUser"])) {
    $username = $_COOKIE["savedUser"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $errorMessage .= "<p>Please fill all fields!</p>";
    } else {
        try {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $rememberUser = isset($_POST["remember"]);

            $authFile = "users.json";
            $users = json_decode(file_get_contents($authFile), true);

            $validUser = null;

            foreach ($users as $user) {
                if ($user["username"] === $username && password_verify($password, $user['password'])) {
                    $validUser = $user;
                    break;
                }
            }

            if ($validUser) {
                $_SESSION["username"] = $username;

                if ($rememberUser) {
                    $lifetime = 60 * 60 * 24 * 7;
                    setcookie("savedUser", $username, time() + $lifetime, "/");
                }

                header("Location: index.php");
                exit();
            } else {
                throw new Exception("<p>Incorrect credentials!</p>");
            }
        } catch (Exception $e) {
            $errorMessage .= "<p>" . $e->getMessage() . "</p>";
        }
    }
}

?>

<form action="" method="POST">
    <h1>Login</h1>

    <label>Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>" /><br>

    <label>Password</label>
    <input type="password" name="password" /><br>

    <label>Remember Me</label>
    <input type="checkbox" name="remember" /><br>

    <button type="submit">Login</button>
    <a href="register_page.php">
        <button type="button">Register</button>
    </a>
    <?php echo $errorMessage ?>
</form>
