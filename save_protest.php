<?php   //creating connection
    $dbhost = "182.50.133.173";
    $dbuser = "studDB21a";
    $dbpass = "stud21DB1!";
    $dbname = "studDB21a";

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //testing connection success
    if(mysqli_connect_errno()) {
        die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>msg to user</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
            rel="stylesheet">
        </head>
        <body>
            <div class="container">
                <h1>Save Protest Details</h1>
                <h2>protest saved</h2>
                <a href="products_list.php">click to see all protests</a>
            </div>
        </body>
    </html>


<?php
 //close DB connection
 mysqli_close($connection);
?>