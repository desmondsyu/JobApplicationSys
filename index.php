<?php
if (isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Job Application</title>
</head>

<body>
    <form>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>

        <div class="tab">
            <h1>Personal Information</h1>
            <label>Full Name</label>
            <input type="text" name="fullName" /><br>

            <label>Email Address</label>
            <input type="text" name="email" /><br>

            <label>Phone Number</label>
            <input type="text" name="phone" /><br>

            <?php echo $errorMessage ?>
        </div>

        <div class="tab">
            <h1>Educational Information</h1>

            <label>Highest Degree Obtained</label>
            <input type="text" name="degree" /><br>

            <label>Field of Study</label>
            <input type="text" name="studyField" /><br>

            <label>Name of Institution</label>
            <input type="text" name="institution" /><br>

            <label>Year of Graduation</label>
            <input type="text" name="graduationYear" /><br>

            <?php echo $errorMessage ?>
        </div>

        <div class="tab">
            <h1>Work Experience Information</h1>

            <label>Previous Job Title</label>
            <input type="text" name="jobTitle" /><br>

            <label>Company Name</label>
            <input type="text" name="company" /><br>

            <label>Years of Experience</label>
            <input type="text" name="experience" /><br>

            <label>Key Responsibilities</label>
            <input type="text" name="responsibilities" /><br>

            <?php echo $errorMessage ?>
        </div>

        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>


    </form>
</body>

</html>