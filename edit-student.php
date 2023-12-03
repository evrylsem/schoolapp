<?php
    include_once("db.php");

    if(isset($_GET['id'])) {
        $studentID = $_GET['id'];

        $sqlQuery2 = "SELECT * FROM students WHERE studid = :studentID";
        $statement2 = $pdoConnect->prepare($sqlQuery2);
        $statement2->bindParam(":studentID", $studentID);
        $statement2->execute();

        $studentData = $statement2->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['update-btn'])) {
        $firstname = $_POST['first-name'];
        $middlename = $_POST['mid-name'];
        $lastname = $_POST['last-name'];
        $coll = $_POST['college-dept'];
        $prog = $_POST['program'];
        $year = $_POST['year'];

        $sqlQuery1 = "UPDATE students SET studfirstname = :firstname, studmidname = :midname, studlastname = :lastname, studcollid = :collid, studprogid = :progid, studyear = :studyear WHERE studid = :id;";
        $statement1 = $pdoConnect->prepare($sqlQuery1);
        $statement1->bindParam(":firstname", $firstname);
        $statement1->bindParam(":midname", $middlename);
        $statement1->bindParam(":lastname", $lastname);
        $statement1->bindParam(":collid", $coll);
        $statement1->bindParam(":progid", $prog);
        $statement1->bindParam(":studyear", $year);
        $statement1->bindParam(":id", $studentID);
        if($statement1->execute()) {
            echo "<script>alert('Update Successful!'); window.location='student-listing.php'</script>";
        } else {
            echo "<script>alert('Update Error!'); window.location='edit-student.php'</script>";
        }
    }

    if(isset($_POST['cancel-btn'])) {
        header('Location: student-listing.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Entry</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/edit-student.css">
</head>
<body>
    <div class="image-container">
        <img src="../usjr_app new/graphics/studentry.jpg" alt="">
    </div>
    <div class="entry-form">
        <form action="" method="post">
            <div class="entry-head">
                <h1>Update Student Entry</h1>
            </div>
            <div class="input-fields">
                <p>Student ID: <br> <input type="text" name="student-id" id="student-id" value="<?php echo $studentData['studid']; ?>" disabled></p>
            </div>
            <div class="input-fields">
                <p>First Name: <br> <input type="text" name="first-name" id="first-name" value="<?php echo $studentData['studfirstname']; ?>"></p>
            </div>
            <div class="input-fields">
                <p>Middle Name: <br> <input type="text" name="mid-name" id="mid-name" value="<?php echo $studentData['studmidname']; ?>"></p>
            </div>
            <div class="input-fields">
                <p>Last Name: <br> <input type="text" name="last-name" id="last-name" value="<?php echo $studentData['studlastname']; ?>"></p>
            </div>
            <div class="input-fields">
                <p>College: <br>
                    <select name="college-dept" id="college-dept" onchange="programsDropdown()">
                        <option value=""></option>
                        <option value="" disabled>Select College</option>
                        <?php
                            $sqlQuery1 = "SELECT * from colleges;";
                            $statement1 = $pdoConnect->prepare($sqlQuery1);
                            $statement1->execute();
                            $collegeFetch = $statement1->fetchAll(PDO::FETCH_ASSOC);

                            $collid = $studentData['studcollid'];

                            foreach ($collegeFetch as $row) {
                                $collegeid = $row['collid'];
                                $collegename = $row['collfullname'];
                                $selected = ($collegeid == $collid) ? 'selected' : '';
                                echo "<option value='$collegeid' $selected>$collegename</option>";
                            }
                        ?>
                    </select>
                </p>
            </div>
            <div class="input-fields">
                <p>Program: <br>
                    <select name="program" id="program">
                        <option disabled>Select Program</option>
                        <?php
                            $sqlQuery2 = "SELECT * FROM programs;";
                            $statement2 = $pdoConnect->prepare($sqlQuery2);
                            $statement2->execute();
                            $programFetch = $statement2->fetchAll(PDO::FETCH_ASSOC); 

                            $programid = $studentData['studprogid'];

                            foreach ($programFetch as $row) {
                                $progid = $row['progid'];
                                $progname = $row['progfullname'];
                                $selected = ($progid == $programid) ? 'selected' : '';
                                echo "<option value='$progid' $selected>$progname</option>";
                            }
                        ?>
                    </select>
                </p>
            </div>
            <div class="input-fields">
                <p>Year: <br> <input type="text" name="year" id="year" value="<?php echo $studentData['studyear']; ?>"></p>
            </div>
            <div class="buttons">
                <button name="cancel-btn">Cancel</button>
                <button name="update-btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    var listPrograms = <?php echo json_encode($programFetch); ?>;

    function programsDropdown () {
        var collegeSelect = document.getElementById('college-dept');
        var programSelect = document.getElementById('program');

        programSelect.innerHTML = "<option value='' disabled>Select Program</option>";

        var filtered = listPrograms.filter(function(program) {
            return program.progcollid == collegeSelect.value;
        });

        filtered.forEach(function(program) {
            var option = document.createElement('option');
            option.value = program.progid;
            option.text = program.progfullname;
            programSelect.add(option);
        });
    }
</script>
</html>