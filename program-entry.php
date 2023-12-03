<?php
    include_once("db.php");

    if(isset($_POST['submit-btn'])) {
        $id = $_POST['program-id'];
        $fullname = $_POST['program-full'];
        $shortname = $_POST['program-short'];
        $collid = $_POST['college'];

        if(empty($id) || empty($fullname) || empty($shortname)) {
            echo "<script>alert('Please Fill In All Fields!');</script>";
        } else {
            $sqlQuery = "INSERT INTO programs(progid, progfullname, progshortname, progcollid) VALUES(:id, :progfull, :progshort, :collid);";
            $statement = $pdoConnect->prepare($sqlQuery);
            $statement->bindParam(":id", $id);
            $statement->bindParam(":progfull", $fullname);
            $statement->bindParam(":progshort", $shortname);
            $statement->bindParam(":collid", $collid);
            if ($statement->execute()) {
                echo "<script>alert('Program Successfully Added.');</script>";
            } else {
                echo "<script>alert('Error!');</script>";
            }
        }
    }

    if(isset($_POST["clear-btn"])) {
        header('Location: program-entry.php');
        exit();
    }

    if(isset($_POST["list-btn"])) {
        header('Location: program-listing.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Entry Form</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/program-entry.css">
</head>
<body>
    <div class="image-container">
        <img src="../usjr_app new/graphics/collentry.jpg" alt="">
    </div>
    <div class="entry-form">
        <form action="" method="post">
            <div class="entry-head">
                <h1>Program Entry Form</h1>
            </div>
            <div class="input-fields">
                <p>Program ID: <br> <input type="text" name="program-id" id="program-id"></p>
            </div>
            <div class="input-fields">
                <p>Program Full Name: <br> <input type="text" name="program-full" id="program-full"></p>
            </div>
            <div class="input-fields">
                <p>Program Short Name: <br> <input type="text" name="program-short" id="program-short"></p>
            </div>
            <div class="input-fields">
                <p>College Name: <br>
                    <select name="college" id="college">
                        <option value=""></option>
                        <option value="" disabled>Select College</option>
                        <?php
                            $sqlQuery2 = "SELECT * FROM colleges;";
                            $statement2 = $pdoConnect->prepare($sqlQuery2);
                            $statement2->execute();
                            $college = $statement2->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($college as $row) {
                                $collegeid = $row['collid'];
                                $collegename = $row['collfullname'];
                                echo "<option value='$collegeid'>$collegename</option>";
                            }
                        ?>
                    </select>
                </p>
            </div>
            <div class="buttons">
                <button name="clear-btn">Clear All</button>
                <button name="submit-btn">Submit</button>
            </div>
            <div class="list-link">
                <button name="list-btn" id="list-btn">View Program List</button>
            </div>
        </form>
    </div>
</body>
</html>