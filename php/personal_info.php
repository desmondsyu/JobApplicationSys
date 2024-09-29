<?php
session_start();

$fullName = "";
$email = "";
$phone = "";
$errorMessage = "";

if (isset($_SESSION["personalInfo"])) {
    $fullName = $_SESSION["personalInfo"]["fullName"];
    $email = $_SESSION["personalInfo"]["email"];
    $phone = $_SESSION["personalInfo"]["phone"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullName"]) || empty($_POST["email"]) || empty($_POST["phone"])) {
        $errorMessage .= "<p>Please fill all fields!</p>";
    } else {
        try {
            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,100}$/", $_POST["fullName"])) {
                throw new Exception("<p>Please enter a name.</p>");
            }

            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["email"])) {
                throw new Exception("<p>Please enter a valid email address.</p>");
            }

            if (!preg_match("/^\d{10}$/", $_POST["phone"])) {
                throw new Exception("<p>Please enter a valid phone number.</p>");
            }

            $_SESSION["personalInfo"] =
                [
                    "fullName" => $_POST["fullName"],
                    "email" => $_POST["email"],
                    "phone" => $_POST["phone"]
                ];

            header("Location: educational_info.php");
            exit();
        } catch (Exception $e) {
            $errorMessage .= "<p>" . $e->getMessage() . "</p>";
        }
    }
}
?>

<form action="personal_info.php" method="POST">
    <h1>Personal Information</h1>
    <label>Full Name</label>
    <input type="text" name="fullName" value="<?php echo $fullName; ?>" /><br>

    <label>Email Address</label>
    <input type="text" name="email" value="<?php echo $email; ?>" /><br>

    <label>Phone Number</label>
    <input type="text" name="phone" value="<?php echo $phone; ?>" /><br>

    <button type="submit">Next</button>
    <?php echo $errorMessage ?>
</form>