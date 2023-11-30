<?php
    include_once("db.php");

    if(isset($_POST['login-btn'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($username) || empty($password)) {
            echo "<script>alert('Please Fill In All Fields!'); window.location='login.php'</script>";
        } else {
            $sqlQuery = "SELECT * FROM users WHERE username = :username";
            $statement = $pdoConnect->prepare($sqlQuery);
            $statement->bindParam(":username", $username);
            $statement->execute();
            $verify = $statement->fetch(PDO::FETCH_ASSOC);

            if($verify && password_verify($password, $verify['passwd'])) {
                echo "<script>alert('Login Successful!'); window.location='student-listing.php'</script>";
            } else {
                echo "<script>alert('Login Error!'); window.location='login.php'</script>";
            }
            $pdoConnect = null;
            $statement = null;
        }
    }
?>
