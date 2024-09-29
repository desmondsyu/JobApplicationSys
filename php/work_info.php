<?php
session_start();

$jobTitle = "";
$company = "";
$experience = "";
$responsibilities = "";
$errorMessage = "";

if (isset($_SESSION["workInfo"])) {
    $jobTitle = $_SESSION["workInfo"]["jobTitle"];
    $company = $_SESSION["workInfo"]["company"];
    $experience = $_SESSION["workInfo"]["experience"];
    $responsibilities =  $_SESSION["workInfo"]["responsibilities"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["jobTitle"]) || empty($_POST["company"]) || empty($_POST["experience"]) || empty($_POST["responsibilities"])) {
        $errorMessage .= "<p>Please fill all fields!</p>";
    } else {
        try {
            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,100}$/", $_POST["jobTitle"])) {
                throw new Exception("<p>Please enter valid degree.</p>");
            }

            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,100}$/", $_POST["company"])) {
                throw new Exception("<p>Please enter valid study field.</p>");
            }

            if (!preg_match("/^\d{1,2}$/", $_POST["experience"])) {
                throw new Exception("<p>Please enter valid institution.</p>");
            }

            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,200}$/", $_POST["responsibilities"])) {
                throw new Exception("<p>Please enter responsibilities.</p>");
            }

            $_SESSION["workInfo"] =
                [
                    "jobTitle" => $_POST["jobTitle"],
                    "company" => $_POST["company"],
                    "experience" => $_POST["experience"],
                    "responsibilities" => $_POST["responsibilities"]
                ];

            header("Location: review.php");
            exit();
        } catch (Exception $e) {
            $errorMessage .= "<p>" . $e->getMessage() . "</p>";
        }
    }
}
?>

<form action="work_info.php" method="POST">
    <h1>Work Experience Information</h1>

    <label>Previous Job Title</label>
    <input type="text" name="jobTitle" value="<?php echo $jobTitle; ?>" /><br>

    <label>Company Name</label>
    <input type="text" name="company" value="<?php echo $company; ?>" /><br>

    <label>Years of Experience</label>
    <input type="text" name="experience" value="<?php echo $experience; ?>" /><br>

    <label>Key Responsibilities</label>
    <input type="text" name="responsibilities" value="<?php echo $responsibilities; ?>" /><br>

    <a href="educational_info.php">
        <button type="button">Previous</button>
    </a>
    <button type="submit">Next</button>
    <?php echo $errorMessage ?>
</form>