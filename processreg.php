<?php
    include_once("db.php");

    if(isset($_POST['back-btn'])) {
        header('Location: login.php');
    }

    if(isset($_POST['register-btn'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashedPass = password_hash($password, PASSWORD_BCRYPT);

        if(empty($username) || empty($password)) {
            echo "<script>alert('Please Fill In All Fields!'); window.location='login.php'</script>";
        } else {
            $sqlQuery = "SELECT * FROM users WHERE username = :username";
            $statement = $pdoConnect->prepare($sqlQuery);
            $statement->bindParam(":username", $username);
            $statement->execute();
            $userFind = $statement->fetch(PDO::FETCH_ASSOC);

            if($userFind) {
                echo "<script>alert('Username exists!'); window.location='reguser.php'</script>";
            } else {
                $sqlQuery = "INSERT INTO users(username, passwd) VALUES(:username, :passwrd);";
                $statement = $pdoConnect->prepare($sqlQuery);
                $statement->bindParam(":username", $username);
                $statement->bindParam(":passwrd", $hashedPass);
                $statement->execute();
                echo "<script>alert('Registration successful!'); window.location='login.php'</script>";
            }
            $pdoConnect = null;
            $statement = null;
        }
    }
?>