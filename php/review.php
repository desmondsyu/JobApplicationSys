<?php
session_start();

$errorMessage = "";

// if ($_SERVER["REQUEST_METHOD"] == "GET") {
// $fullName = $_SESSION["personalInfo"]["fullName"];
// $email = $_SESSION["personalInfo"]["email"];
// $phone = $_SESSION["personalInfo"]["phone"];

// $degree = $_SESSION["educationalInfo"]["degree"];
// $studyField = $_SESSION["educationalInfo"]["studyField"];
// $institution = $_SESSION["educationalInfo"]["institution"];
// $graduationYear =  $_SESSION["educationalInfo"]["graduationYear"];

// $jobTitle = $_SESSION["workInfo"]["jobTitle"];
// $company = $_SESSION["workInfo"]["company"];
// $experience = $_SESSION["workInfo"]["experience"];
// $responsibilities =  $_SESSION["workInfo"]["responsibilities"];
// }

?>

<form action="review.php" method="GET">
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
    "
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

    <button type="button">Previous</button>
    <button type="submit">Submit</button>
    <?php echo $errorMessage ?>
</form>