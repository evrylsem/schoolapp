<?php
    include_once("db.php");

    $sqlQuery = "SELECT studid, studlastname, studfirstname, studmidname, collfullname, progfullname, studyear FROM students
                INNER JOIN colleges ON studcollid = collid
                INNER JOIN programs ON studprogid = progid";
    $statement = $pdoConnect->prepare($sqlQuery);
    $statement->execute();

    if(isset($_POST['delete-btn'])) {
        $idToDelete = $_POST['selected-stud'];
        header("Location: delete-confirm.php?id=$idToDelete");
        exit();
    }

    if(isset($_POST['edit-btn'])) {
        $idToEdit = $_POST['selected-stud'];
        header("Location: edit-student.php?id=$idToEdit");
        exit();
    }

    if(isset($_POST['add-btn'])) {
        header("Location: student-entry.php");
    }

    if(isset($_POST['logout-btn'])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Students</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/student-listing.css">
</head>
<body>
    <div class="container">
        <div class="page-head">
            <h1>Student Listing</h1>
        </div>
        <div class="pag-body">
            <form method="post" class="add-btn">
                <button name="add-btn">Add Student</button>
                <button name="logout-btn">Logout</button>
            </form>
            <div class="students">
                <table>
                    <thead>
                        <td>Student ID</td>
                        <td>Last Name</td>
                        <td>First Name</td>
                        <td>Middle Name</td>
                        <td>College</td>
                        <td>Program Enrolled</td>
                        <td>Year</td>
                        <td colspan="2"></td>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                $id = $row['studid'];
                                $firstname = $row['studfirstname'];
                                $middlename = $row['studmidname'];
                                $lastname = $row['studlastname'];
                                $college = $row['collfullname'];
                                $program = $row['progfullname'];
                                $year = $row['studyear'];
                                echo "<td>$id</td>";
                                echo "<td>$lastname</td>";
                                echo "<td>$firstname</td>";
                                echo "<td>$middlename</td>";
                                echo "<td id='college-cell'>$college</td>";
                                echo "<td id='program-cell'>$program</td>";
                                echo "<td>$year</td>";
                                echo "<td class='buttons'>
                                        <form method='post'>
                                            <input type='hidden' name='selected-stud' value='$id'>
                                            <button id='edit-btn' name='edit-btn'><img src='../usjr_app new/graphics/edit-icon.png' alt=''></button>
                                        </form>
                                    </td>";
                                echo "<td class='buttons'>
                                        <form method='post'>
                                            <input type='hidden' name='selected-stud' value='$id'>
                                            <button id='delete-btn' name='delete-btn'><img src='../usjr_app new/graphics/delete-icon.png' alt=''></button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>