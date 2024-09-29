<?php
$username = "";
$email = "";
$password = "";
$errorMessage = "";

// handle post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        $errorMessage .= "<p>Please fill all fields!</p>";
    } else {
        try {
            // validate
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["email"])) {
                throw new Exception("<p>Please enter a valid email address.</p>");
            }
            if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $_POST["password"])) {
                throw new Exception("<p>The password is too weak! Please enter a stronger password.</p>");
            }

            // write value, hash password
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $authFile = "users.json";
            $users = json_decode(file_get_contents($authFile), true);

            if (!empty($users)) {
                foreach ($users as $user) {
                    if ($user["username"] === $username) {
                        throw new Exception("<p>User already exists!</p>");
                    }
                }
            }

            // wirte values to file
            $newUser = ["username" => $username, "email" => $email, "password" => $password];
            $users[] = $newUser;

            file_put_contents($authFile, json_encode($users));
            $errorMessage .= "<p>Registration successful</p>";
        } catch (Exception $e) {
            $errorMessage .= "<p>" . $e->getMessage() . "</p>";
        }
    }
}
?>


<form action="" method="POST">
    <h1>Register</h1>
    <label>Username</label>
    <input type="text" name="username" /><br>

    <label>Email</label>
    <input type="text" name="email" /><br>

    <label>Password</label>
    <input type="password" name="password" /><br>
    <p>
        <button type="submit">Register</button>
        <a href="index.php">
            <button type="button">Login</button>
        </a>
        <?php echo $errorMessage ?>
        
</form>