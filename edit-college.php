<?php
    include_once("db.php");

    if(isset($_GET['id'])) {
        $collegeID = $_GET['id'];

        $sqlQuery = "SELECT * FROM colleges WHERE collid = :collegeID";
        $statement = $pdoConnect->prepare($sqlQuery);
        $statement->bindParam(":collegeID", $collegeID);
        $statement->execute();

        $collegeData = $statement->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['update-btn'])) {
        $fullname = $_POST['college-full'];
        $shortname = $_POST['college-short'];

        $sqlQuery1 = "UPDATE colleges SET collfullname = :fullname, collshortname = :shortname WHERE collid = :id;";
        $statement1 = $pdoConnect->prepare($sqlQuery1);
        $statement1->bindParam(":fullname", $fullname);
        $statement1->bindParam(":shortname", $shortname);
        $statement1->bindParam(":id", $collegeID);
        if($statement1->execute()) {
            echo "<script>alert('Update Successful!'); window.location='college-listing.php'</script>";
        } else {
            echo "<script>alert('Update Error!'); window.location='edit-college.php'</script>";
        }
    }

    if(isset($_POST['cancel-btn'])) {
        header('Location: college-listing.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update College Entry</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/edit-college.css">
</head>
<body>
    <div class="image-container">
        <img src="../usjr_app new/graphics/collentry.jpg" alt="">
    </div>
    <div class="entry-form">
        <form action="" method="post">
            <div class="entry-head">
                <h1>Update College Entry</h1>
            </div>
            <div class="input-fields">
                <p>College ID: <br> <input type="text" name="college-id" id="college-id" value="<?php echo $collegeData['collid']; ?>" disabled></p>
            </div>
            <div class="input-fields">
                <p>College Full Name: <br> <input type="text" name="college-full" id="college-full" value="<?php echo $collegeData['collfullname']; ?>"></p>
            </div>
            <div class="input-fields">
                <p>College Short Name: <br> <input type="text" name="college-short" id="college-short" value="<?php echo $collegeData['collshortname']; ?>"></p>
            <div class="buttons">
                <button name="cancel-btn">Cancel</button>
                <button name="update-btn">Update</button>
            </div>
        </form>
    </div>
</body>
</html>