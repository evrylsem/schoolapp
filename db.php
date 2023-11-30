<?php
    $host = "localhost";
    $dbname = "usjr";
    $dbUsername = "root";
    $dbPassword = "root";

    try {
        $pdoConnect = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }
?>