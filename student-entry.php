<?php
    include_once("db.php");

    if(isset($_POST['college'])) {
        $college_id = $_POST['college'];
        $sqlQuery2 = "SELECT * FROM programs WHERE progcollid = :collegeid";
        $progstatement = $pdoConnect->prepare($sqlQuery2);
        $progstatement->bindParam(":collegeid", $college_id);
        $progstatement->execute();

        while($row = $progstatement->fetch(PDO::FETCH_ASSOC)) {
            $progid = $row['progid'];
            $progname = $row['progfullname'];
            echo "<option value='$progid'>$progname</option>";
        }
        exit();
    }

    if(isset($_POST['submit-btn'])) {
        $id = $_POST['student-id'];
        $firstname = $_POST['first-name'];
        $middlename = $_POST['mid-name'];
        $lastname = $_POST['last-name'];
        $collid = $_POST['college-dept'];
        $program = $_POST['program'];
        $year = $_POST['year'];

        if(empty($id) || empty($firstname) || empty($middlename) || empty($lastname) || empty($year)) {
            echo "<script>alert('Please Fill In All Fields!'); window.location='student-entry.php'</script>";
        } else {
            $sqlQuery = "INSERT INTO students(studid, studfirstname, studmidname, studlastname, studcollid, studprogid, studyear) VALUES(:studid,:firstname,:middlename,:lastname,:college,:program,:yeartook);";
            $statement = $pdoConnect->prepare($sqlQuery);
            $statement->bindParam(":studid", $id);
            $statement->bindParam(":firstname", $firstname);
            $statement->bindParam(":middlename", $middlename);
            $statement->bindParam(":lastname", $lastname);
            $statement->bindParam(":college", $collid);
            $statement->bindParam(":program", $program);
            $statement->bindParam(":yeartook", $year);
            if ($statement->execute()) {
                echo "<script>alert('Student Successfully Added.');</script>";
            } else {
                echo "<script>alert('Error!');</script>";
            }
        }
    }

    if(isset($_POST["clear-btn"])) {
        header('Location: student-entry.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Entry Form</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/student-entry.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="image-container">
                <img src="../usjr_app new/graphics/school1.jpg" alt="">
            </div>
            <div class="entry-form">
                <div class="entry-head">
                        <h1>Student Entry Form</h1>
                </div>
                <div class="input-fields">
                    <p>Student ID: <br> <input type="text" name="student-id" id="student-id"></p>
                    
                </div>
                <div class="input-fields">
                    <p>First Name: <br> <input type="text" name="first-name" id="first-name"></p>
                </div>
                <div class="input-fields">
                    <p>Middle Name: <br> <input type="text" name="mid-name" id="mid-name"></p>
                </div>
                <div class="input-fields">
                    <p>Last Name: <br> <input type="text" name="last-name" id="last-name"></p>
                </div>
                <div class="input-fields">
                    <p>College: <br>
                        <select name="college-dept" id="college-dept">
                            <option value="" disabled>Select College</option>
                            <?php
                                $sqlQuery = "SELECT * from colleges;";
                                $collstatement = $pdoConnect->prepare($sqlQuery);
                                $collstatement->execute();

                                while($row = $collstatement->fetch(PDO::FETCH_ASSOC)) {
                                    $collegeid = $row['collid'];
                                    $collegename = $row['collfullname'];
                                    echo "<option value='$collegeid'>$collegename</option>";
                                }
                            ?>
                        </select>
                    </p>
                </div>
                <div class="input-fields">
                    <p>Program: <br>
                        <select name="program" id="program">
                            <option value="" disabled>Select Program</option>
                        </select>
                    </p>
                </div>
                <div class="input-fields">
                    <p>Year: <br> <input type="text" name="year" id="year"></p>
                </div>
                <div class="buttons">
                    <button name="clear-btn">Clear All</button>
                    <button name="submit-btn">Submit</button>
                </div>
                <a href="student-listing.php">View All Students</a>
            </div>
        </form>
    </div>
</body>
<script>
            $(document).ready(function(){
                $('#college-dept').change(function(){
                    var college = $("#college-dept").val();
                    $.ajax({
                        method: 'POST',
                        url: 'student-entry.php',
                        data: {college: college },
                        success: function(response){
                            $('#program').html(response);
                        }
                    });
                });

                $('button[name="clear-btn"]').on('click', function(){
                    $('form')[0].reset();
                });
            });
        </script>
</html>