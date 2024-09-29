<?php
session_start();

$degree = "";
$studyField = "";
$institution = "";
$graduationYear = "";
$errorMessage = "";

if (isset($_SESSION["educationalInfo"])) {
    $degree = $_SESSION["educationalInfo"]["degree"];
    $studyField = $_SESSION["educationalInfo"]["studyField"];
    $institution = $_SESSION["educationalInfo"]["institution"];
    $graduationYear =  $_SESSION["educationalInfo"]["graduationYear"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["degree"]) || empty($_POST["studyField"]) || empty($_POST["institution"]) || empty($_POST["graduationYear"])) {
        $errorMessage .= "<p>Please fill all fields!</p>";
    } else {
        try {
            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,100}$/", $_POST["degree"])) {
                throw new Exception("<p>Please enter valid degree.</p>");
            }

            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,100}$/", $_POST["studyField"])) {
                throw new Exception("<p>Please enter valid study field.</p>");
            }

            if (!preg_match("/^[a-zA-Z'\\-\\s]{2,100}$/", $_POST["institution"])) {
                throw new Exception("<p>Please enter valid institution.</p>");
            }

            if (!preg_match("/^(19|20)\d{2}$/", $_POST["graduationYear"])) {
                throw new Exception("<p>Please enter a valid year.</p>");
            }

            $_SESSION["educationalInfo"] =
                [
                    "degree" => $_POST["degree"],
                    "studyField" => $_POST["studyField"],
                    "institution" => $_POST["institution"],
                    "graduationYear" => $_POST["graduationYear"]
                ];

            header("Location: work_info.php");
            exit();
        } catch (Exception $e) {
            $errorMessage .= "<p>" . $e->getMessage() . "</p>";
        }
    }
}
?>

<form action="educational_info.php" method="POST">
    <h1>Educational Information</h1>

    <label>Highest Degree Obtained</label>
    <input type="text" name="degree" value="<?php echo $degree; ?>" /><br>

    <label>Field of Study</label>
    <input type="text" name="studyField" value="<?php echo $studyField; ?>" /><br>

    <label>Name of Institution</label>
    <input type="text" name="institution" value="<?php echo $institution; ?>" /><br>

    <label>Year of Graduation</label>
    <input type="text" name="graduationYear" value="<?php echo $graduationYear; ?>" /><br>

    <a href="personal_info.php">
        <button type="button">Previous</button>
    </a>
    <button type="submit">Next</button>
    <?php echo $errorMessage ?>
</form>

<form action="logout.php" method="POST">
    <button type="submit">Logout</button>
</form>
