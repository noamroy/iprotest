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
        <meta charset="UTF-8"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
        <script src="js/scripts.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css"/>
        <title>createProtest</title>
    </head>
    <body id="createProtest">
        <div class="wrapper">
            <header class="flexContainer">
                <img src="images/hum.png" class="dropbtn" id="hum" alt="hum" title="menu" herf=#>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">My Upcoming protests</a>
                        <a href="create_protest.html">Create protest</a>
                        <a href="searchProtest.html">Search protest</a>
                        <a href="#">Log out</a>
                    </div>
                </div>
                <h4>HI, Dana</h4>
                <section id="logo"></section>
                <a href="index.html">
                    <img src="images/home.png" id="home" alt="home" title="home" herf=#>
                </a>
            </header>
            <main id="test">
                <h1>Create Protest</h1>
                <!-- TO FIX FORM DESTINATION BEFORE SENDING http://se.shenkar.ac.il/students/2020-2021/web1/dev_87/exercises/Shir_Noam_project/server.php-->
                <form name="createProtest" action="save_protest.php" method="GET" autocomplete="on">
                    <div class="mb-3 form-group required">
                        <label class="form-label"> 
                            <input type="text" class="form-control" name="prot_name" placeholder="Protest Name" >
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <input type="text" class="form-control" name="prot_address" placeholder="Address">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <input type="date" class="form-control" name="event_date" placeholder="Date">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <input type="time" class="form-control" name="event_time"  placeholder="Time">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <input type="text" class="form-control" name="cause" placeholder="Cause">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <textarea name="notes" class="form-control" placeholder="Notes" rows="4"></textarea>
                        </label>
                    </div>
                    <h2> Share on: </h2>
                    <div class="form-check">
                        <label class="form-check-label">
                            <img src="images/facebook-icon.png">
                            <input class="form-check-input" type="checkbox" name="share[]" value="facebook">
                        </label>
                        <label class="form-check-label">
                            <img src="images/whatsapp-icon.png">
                            <input class="form-check-input" type="checkbox" name="share[]" value="whats_up">
                        </label>
                        <label class="form-check-label"> 
                            <img src="images/twitter-icon.png">
                            <input class="form-check-input" type="checkbox" name="share[]" value="twitter">
                        </label>
                        <label class="form-check-label"> 
                            <img src="images/mail-icon.png">
                            <input class="form-check-input" type="checkbox" name="share[]" value="mail">
                        </label><br>
                    </div>
                    <div class="buttomsFlexContainer">
                        <input class="btn btn-primary" id="submitbtn" type="submit" value="Submit">
                        <a href='manageProtests.html'><buttom class="btn btn-primary" id="returnbtn"> Return </buttom></a>
                    </div>
                </form>
            </main>
        <script>
            menu();
        </script>
    <footer>
        
    </footer>
</body> 
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>

        
