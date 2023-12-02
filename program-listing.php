<?php
    include_once("db.php");

    $sqlQuery = "SELECT progid, progfullname, progshortname, collshortname FROM programs
                 INNER JOIN colleges on progcollid = collid;";
    $statement = $pdoConnect->prepare($sqlQuery);
    $statement->execute();

    if(isset($_POST['delete-btn'])) {
        $idToDelete = $_POST['selected-prog'];
        header("Location: delete-program.php?id=$idToDelete");
        exit();
    }

    if(isset($_POST['edit-btn'])) {
        $idToEdit = $_POST['selected-prog'];
        header("Location: edit-program.php?id=$idToEdit");
        exit();
    }

    if(isset($_POST['add-btn'])) {
        header("Location: program-entry.php");
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
    <title>List of Programs</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/program-listing.css">
</head>
<body>
    <div class="container">
        <div class="nav-container">
            <li id="students-link"><a href="student-listing.php">Students</a></li>
            <li id="colleges-link"><a href="college-listing.php">Colleges</a></li>
            <li id="programs-link"><a href="program-listing.php">Programs</a></li>
            <li id="logout-link"><a href="login.php">Logout</a></li>
        </div> 
        <div class="page-body">
            <div class="page-head">
                <h1>List of Programs</h1>
            </div>
            <div class="programs">
                <table>
                    <thead>
                        <td>Program ID</td>
                        <td>Full Name</td>
                        <td>Short Name</td>
                        <td>College Name</td>
                        <td colspan="2"></td>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                $id = $row['progid'];
                                $fullname = $row['progfullname'];
                                $shortname = $row['progshortname'];
                                $collshortname = $row['collshortname'];
                                echo "<td>$id</td>";
                                echo "<td>$fullname</td>";
                                echo "<td>$shortname</td>";
                                echo "<td>$collshortname</td>";
                                echo "<td class='buttons'>
                                        <form method='post'>
                                            <input type='hidden' name='selected-prog' value='$id'>
                                            <button id='edit-btn' name='edit-btn'><img src='../usjr_app new/graphics/edit-icon.png' alt=''></button>
                                        </form>
                                    </td>";
                                echo "<td class='buttons'>
                                        <form method='post'>
                                            <input type='hidden' name='selected-prog' value='$id'>
                                            <button id='delete-btn' name='delete-btn'><img src='../usjr_app new/graphics/delete-icon.png' alt=''></button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="btn-container">
                <form method="post" class="add-btn">
                    <button name="add-btn" id="add-btn">Add Program</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>