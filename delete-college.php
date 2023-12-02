<?php
    include_once('db.php');

    if(isset($_GET['id'])) {
        $collegeID = $_GET['id'];

        $sqlQuery = "SELECT * FROM colleges WHERE collid = :id;";
        $statement = $pdoConnect->prepare($sqlQuery);
        $statement->bindParam(":id", $collegeID);
        $statement->execute();

        $collegeData = $statement->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['yes-btn'])) {
        $sqlQuery1 = "DELETE FROM colleges WHERE collid = :id;";
        $statement1 = $pdoConnect->prepare($sqlQuery1);
        $statement1->bindParam(":id", $collegeID);
        $statement1->execute();
        header('Location: college-listing.php');
    }

    if(isset($_POST['no-btn'])) {
        header('Location: college-listing.php');
    }
?>

<html>
    <head>
        <title>Confirmation</title>
        <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    </head>
    <body>
        <form method="post">
            <div id="container">
                <p>Are you sure you want to delete college?</p>
                <div>
                    <button name="no-btn" id="no-btn">No</button>
                    <button name="yes-btn" id="yes-btn">Yes</button>
                </div>
            </div>
        </form>
    </body>
    <style>
        button {
            cursor: pointer;
        }
    </style>
</html>