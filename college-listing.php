<?php
    include_once("db.php");

    $sqlQuery = "SELECT * FROM colleges;";
    $statement = $pdoConnect->prepare($sqlQuery);
    $statement->execute();

    if(isset($_POST['delete-btn'])) {
        $idToDelete = $_POST['selected-coll'];
        header("Location: delete-college.php?id=$idToDelete");
        exit();
    }

    if(isset($_POST['edit-btn'])) {
        $idToEdit = $_POST['selected-coll'];
        header("Location: edit-college.php?id=$idToEdit");
        exit();
    }

    if(isset($_POST['add-btn'])) {
        header("Location: college-entry.php");
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
    <title>List of Colleges</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/college-listing.css">
</head>
<body>
    <div class="container">
        <div class="nav-container">
            <li id="students-link"><a href="student-listing.php">Students</a></li>
            <li id="colleges-link"><a href="college.php">Colleges</a></li>
            <li><a href="" id="programs-link">Programs</a></li>
            <li id="logout-link"><a href="login.php">Logout</a></li>
        </div> 
        <div class="page-body">
            <div class="page-head">
                <h1>List of Colleges</h1>
            </div>
            <div class="students">
                <table>
                    <thead>
                        <td>College ID</td>
                        <td>Full Name</td>
                        <td>Short Name</td>
                        <td colspan="2"></td>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                $id = $row['collid'];
                                $fullname = $row['collfullname'];
                                $shortname = $row['collshortname'];
                                echo "<td>$id</td>";
                                echo "<td>$fullname</td>";
                                echo "<td>$shortname</td>";
                                echo "<td class='buttons'>
                                        <form method='post'>
                                            <input type='hidden' name='selected-coll' value='$id'>
                                            <button id='edit-btn' name='edit-btn'><img src='../usjr_app new/graphics/edit-icon.png' alt=''></button>
                                        </form>
                                    </td>";
                                echo "<td class='buttons'>
                                        <form method='post'>
                                            <input type='hidden' name='selected-coll' value='$id'>
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
                    <button name="add-btn" id="add-btn">Add College</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>