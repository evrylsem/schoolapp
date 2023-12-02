<?php
    include_once("db.php");

    if(isset($_GET['id'])) {
        $programID = $_GET['id'];

        $sqlQuery = "SELECT * FROM programs WHERE progid = :programID";
        $statement = $pdoConnect->prepare($sqlQuery);
        $statement->bindParam(":programID", $programID);
        $statement->execute();

        $programData = $statement->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['update-btn'])) {
        $fullname = $_POST['program-full'];
        $shortname = $_POST['program-short'];
        $collid = $_POST['college'];

        $sqlQuery1 = "UPDATE programs SET progfullname = :fullname, progshortname = :shortname, progcollid = :collid WHERE progid = :id;";
        $statement1 = $pdoConnect->prepare($sqlQuery1);
        $statement1->bindParam(":fullname", $fullname);
        $statement1->bindParam(":shortname", $shortname);
        $statement1->bindParam(":collid", $collid);
        $statement1->bindParam(":id", $programID);
        if($statement1->execute()) {
            echo "<script>alert('Update Successful!'); window.location='program-listing.php'</script>";
        } else {
            echo "<script>alert('Update Error!');</script>";
        }
    }

    if(isset($_POST['cancel-btn'])) {
        header('Location: program-listing.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Program Entry</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/edit-program.css">
</head>
<body>
    <div class="image-container">
        <img src="../usjr_app new/graphics/collentry.jpg" alt="">
    </div>
    <div class="entry-form">
        <form action="" method="post">
            <div class="entry-head">
                <h1>Update Program Entry</h1>
            </div>
            <div class="input-fields">
                <p>Program ID: <br> <input type="text" name="program-id" id="program-id" value="<?php echo $programData['progid']; ?>" disabled></p>
            </div>
            <div class="input-fields">
                <p>Program Full Name: <br> <input type="text" name="program-full" id="program-full" value="<?php echo $programData['progfullname']; ?>"></p>
            </div>
            <div class="input-fields">
                <p>Program Short Name: <br> <input type="text" name="program-short" id="program-short" value="<?php echo $programData['progshortname']; ?>"></p>
            </div>
            <div class="input-fields">
                <p>College Name: <br>
                    <select name="college" id="college">
                        <option value="">Select College</option>
                        <?php
                            $sqlQuery2 = "SELECT * FROM colleges;";
                            $statement2 = $pdoConnect->prepare($sqlQuery2);
                            $statement2->execute();

                            while($row = $statement2->fetch(PDO::FETCH_ASSOC)) {
                                $collegeid = $row['collid'];
                                $collegename = $row['collfullname'];
                                $selected = ($collegeid == $programData['progcollid']) ? 'selected' : '';
                                echo "<option value='$collegeid' $selected>$collegename</option>";
                            }
                        ?>
                    </select>
                </p>
            </div>
            <div class="buttons">
                <button name="cancel-btn">Cancel</button>
                <button name="update-btn">Update</button>
            </div>
        </form>
    </div>
</body>
</html>