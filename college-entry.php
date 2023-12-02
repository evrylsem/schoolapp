<?php
    include_once("db.php");

    if(isset($_POST['submit-btn'])) {
        $id = $_POST['college-id'];
        $fullname = $_POST['college-full'];
        $shortname = $_POST['college-short'];

        if(empty($id) || empty($fullname) || empty($shortname)) {
            echo "<script>alert('Please Fill In All Fields!');</script>";
        } else {
            $sqlQuery = "INSERT INTO colleges(collid, collfullname, collshortname) VALUES(:collid, :collfull, :collshort);";
            $statement = $pdoConnect->prepare($sqlQuery);
            $statement->bindParam(":collid", $id);
            $statement->bindParam(":collfull", $fullname);
            $statement->bindParam(":collshort", $shortname);
            if ($statement->execute()) {
                echo "<script>alert('College Successfully Added.');</script>";
            } else {
                echo "<script>alert('Error!');</script>";
            }
        }
    }

    if(isset($_POST["clear-btn"])) {
        header('Location: college-entry.php');
        exit();
    }

    if(isset($_POST["list-btn"])) {
        header('Location: college-listing.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Entry</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/college-entry.css">
</head>
<body>
    <div class="image-container">
        <img src="../usjr_app new/graphics/collegeentry.jpg" alt="">
    </div>
    <div class="entry-form">
        <form action="" method="post">
            <div class="entry-head">
                <h1>College Entry Form</h1>
            </div>
            <div class="input-fields">
                <p>College ID: <br> <input type="text" name="college-id" id="college-id"></p>
            </div>
            <div class="input-fields">
                <p>College Full Name: <br> <input type="text" name="college-full" id="college-full"></p>
            </div>
            <div class="input-fields">
                <p>College Short Name: <br> <input type="text" name="college-short" id="college-short"></p>
            <div class="buttons">
                <button name="clear-btn">Clear All</button>
                <button name="submit-btn">Submit</button>
            </div>
            <div class="list-link">
                <button name="list-btn" id="list-btn">View College List</button>
            </div>
        </form>
    </div>
</body>
</html>