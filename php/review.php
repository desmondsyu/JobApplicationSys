<?php
session_start();

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $applicationData = [
            "personalInfo" => $_SESSION["personalInfo"],
            "educationalInfo" => $_SESSION["educationalInfo"],
            "workInfo" => $_SESSION["workInfo"],
        ];

        $applicationFile = "../applications.json";
        $applications = json_decode(file_get_contents($applicationFile), true);

        $applications[] = $applicationData;

        file_put_contents($applicationFile, json_encode($applications));

        $errorMessage .= "<p>Application submitted! Email sent to " . $_SESSION["personalInfo"]["email"] . "</p>";
        
        mail($_SESSION["personalInfo"]["email"], "Submit Confirmation", "Application submitted!");

    } catch (Exception $e) {
        $errorMessage .= "<p>" . $e->getMessage() . "</p>";
    }
}
?>

<form action="review.php" method="POST">
    <h1>Review</h1>

    <div>
        <h2>Personal Information</h2>
        <a href="personal_info.php">
            <button type="button">Edit</button>
        </a>
    </div>

    <label>Full Name</label>
    <input type="text" name="fullName" value="<?php echo $_SESSION["personalInfo"]["fullName"]; ?>" disabled /><br>

    <label>Email Address</label>
    <input type="text" name="email" value="<?php echo $_SESSION["personalInfo"]["email"]; ?>" disabled /><br>

    <label>Phone Number</label>
    <input type="text" name="phone" value="<?php echo $_SESSION["personalInfo"]["phone"]; ?>" disabled /><br>

    <div>
        <h2>Educational Information</h2>
        <a href="educational_info.php">
            <button type="button">Edit</button>
        </a>
    </div>

    <label>Highest Degree Obtained</label>
    <input type="text" name="degree" value="<?php echo $_SESSION["educationalInfo"]["degree"]; ?>" disabled /><br>

    <label>Field of Study</label>
    <input type="text" name="studyField" value="<?php echo $_SESSION["educationalInfo"]["studyField"]; ?>" disabled /><br>

    <label>Name of Institution</label>
    <input type="text" name="institution" value="<?php echo $_SESSION["educationalInfo"]["institution"]; ?>" disabled /><br>

    <label>Year of Graduation</label>
    <input type="text" name="graduationYear" value="<?php echo $_SESSION["educationalInfo"]["graduationYear"]; ?>" disabled /><br>

    <div>
        <h2>Work Experience Information</h2>
        <a href="work_info.php">
            <button type="button">Edit</button>
        </a>
    </div>


    <label>Previous Job Title</label>
    <input type="text" name="jobTitle" value="<?php echo $_SESSION["workInfo"]["jobTitle"]; ?>" disabled /><br>

    <label>Company Name</label>
    <input type="text" name="company" value="<?php echo $_SESSION["workInfo"]["company"]; ?>" disabled /><br>

    <label>Years of Experience</label>
    <input type="text" name="experience" value="<?php echo $_SESSION["workInfo"]["experience"]; ?>" disabled /><br>

    <label>Key Responsibilities</label>
    <input type="text" name="responsibilities" value="<?php echo $_SESSION["workInfo"]["responsibilities"]; ?>" disabled /><br>

    <a href="work_info.php">
        <button type="button">Previous</button>
    </a>
    <button type="submit">Submit</button>
    <?php echo $errorMessage ?>
</form>

<form action="logout.php" method="POST">
    <button type="submit">Logout</button>
</form>