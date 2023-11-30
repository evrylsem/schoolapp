<?php
    include_once("db.php");

    $sqlQuery = "SELECT * FROM colleges;" ;
    $statement = $pdoConnect->prepare($sqlQuery);
    $statement->execute();

    if(isset($_POST['delete-btn'])) {
        $idToDelete = $_POST['selected-coll'];
        header("Location: delete-coll.php?id=$idToDelete");
        exit();
    }

    if(isset($_POST['edit-btn'])) {
        $idToEdit = $_POST['selected-coll'];
        header("Location: edit-coll.php?id=$idToEdit");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of College</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
</head>
<body>
    <div class="container">
        <div class="page-head">
            <h1>List of Colleges</h1>
        </div>
        <div class="pag-body">
            <form method="post" class="add-btn">
                <button name="add-btn">Add College</button>
                <button name="logout-btn">Logout</button>
            </form>
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
        </div>
    </div>
</body>
</html>