<?php

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
        <img src="../usjr_app new/graphics/studentry.jpg" alt="">
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
                <p>College Name: <br> <input type="text" name="college-name" id="college-name"></p>
            </div>
            <div class="input-fields">
                <p>College Abbreviation: <br> <input type="text" name="college-abbrv" id="college-abbrv"></p>
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