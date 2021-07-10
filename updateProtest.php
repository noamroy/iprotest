<?php
    include 'db.php';
    include "config.php";   
    if(!empty($_POST["prot_owner"])){
        $date=$_POST["prot_date"];
        $time=$_POST["prot_time"];        
        $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
        $query ="UPDATE tbl_87_protests SET prot_name= '".$_POST["prot_name"]."', 
        prot_address= '".$_POST["prot_address"]."', 
        prot_time= '".$combinedDT."', 
        prot_cause= '".$_POST["prot_cause"]."', 
        prot_notes= '".$_POST["prot_notes"]."', 
        prot_police= '".$_POST["prot_police"]."', 
        prot_status=3"." , 
        prot_owner=".$_POST["prot_owner"]." , 
        prot_publish_1='".$_POST["prot_share_1"]."', 
        prot_publish_2='".$_POST["prot_share_2"]."', 
        prot_publish_3='".$_POST["prot_share_3"]."', 
        prot_publish_4='".$_POST["prot_share_4"]."' 
        WHERE prot_id=".$_POST["prot_id"].";";
        echo "<h1>".$query."</h1>";
        $result = mysqli_query($connection , $query);
        if ($result){
          header ('location: '.HAGASHA_URL.'protestList.php?user_id='.$_POST["prot_owner"].'&page=3');
        }
    }
    else{
        if(!empty($_GET["user_id"])||!empty($_GET["prot_id"])) {
            $query ="SELECT * FROM tbl_87_users WHERE user_id=".$_GET["user_id"].";";
            $result = mysqli_query($connection , $query);
            $row = mysqli_fetch_array($result);
            $query ="SELECT * FROM tbl_87_protests WHERE prot_id=".$_GET["prot_id"].";";
            $result = mysqli_query($connection , $query);
            $prot_row = mysqli_fetch_array($result);
        }
        else{
            $message = "FORBIDDEN PLACE";
        }
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
        <title>updateProtest</title>
    </head>
    <body id="updateprotest">
        <?php if (!empty($message)) {echo $message;} ?>
        <header class="flexContainer">
            <img src="images/hum.png" class="dropbtn" id="hum" alt="hum" title="menu" herf=#>
            <div class="dropdown">
                <div id="myDropdown" class="dropdown-content">
                    <?php
                    echo '<a href="profile.php?user_id='.$row[0].'">Profile</a>';
                    echo '<a href="protestList.php?user_id='.$row[0].'&page=1">My Upcoming protests</a>';
                    echo '<a href="createProtest.php?user_id='.$row[0].'">Create Protest</a>';
                    echo '<a href="protestList.php?user_id='.$row[0].'&page=2">Search protest</a>';
                    ?>
                    <a href="index.php">Log out</a>
                </div>
            </div>
            <?php echo "<h4>HI, ".$row[2]."</h4>";?>
            <?php echo '<a href="homepage.php?user_id='.$row[0].'">';?>
                <section id="logo"></section>
            </a>
        </header>
        <div class="wrapper">
            <main id="test"> <!-- FIX -->
                <h1>Update Protest</h1>
                <?php echo '<form name="updateProtest" action="updateProtest.php?user_id='.$row[0].'&prot_id='.$prot_row[0].'" method="POST" autocomplete="on">';?>
                    <div class="mb-3 form-group">
                        <label class="form-label"> name
                            <?php echo'<input type="text" class="form-control" name="prot_name" value="'.$prot_row[1].'" require>';?>
                        </label>
                    </div>
                    <?php echo '<input type="hidden" name="prot_owner" value='.$_GET["user_id"].'>';?>
                    <?php echo '<input type="hidden" name="prot_id" value='.$prot_row[0].'>';?>
                    <?php echo '<input type="hidden" name="prot_police" value="'.$prot_row[6].'">';?>
                    <div class="mb-3">
                        <label class="form-label"> address
                            <?php echo'<input type="text" class="form-control" name="prot_address" value="'.$prot_row[2].'" require>';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php
                                $time = new DateTime($prot_row[3]);
                                $date = $time->format('Y-m-d');
                                $dts = new DateTime();
                                $dts = $dts->format('Y-m-d');
                                echo'<input type="date" class="form-control" name="prot_date" value="'.$date.'" min="'.$dts.'" require>';
                            ?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php
                                $time = $time->format('H:i');
                                echo'<input type="time" class="form-control" name="prot_time" value="'.$time.'" require>';
                            ?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> cause
                            <?php echo'<input type="text" class="form-control" name="prot_cause" value="'.$prot_row[4].'" >';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> notes
                            <?php echo'<textarea name="notes" class="form-control" rows="4">'.$prot_row[5].'</textarea>';?>
                        </label>
                    </div>
                    <h2> Share on: </h2>
                    <div class="form-check">
                        <label class="form-check-label">
                            <img src="images/facebook-icon.png">
                            <input class="form-check-input" type="checkbox" name="prot_share_1" value="facebook">
                        </label>
                        <label class="form-check-label">
                            <img src="images/whatsapp-icon.png">
                            <input class="form-check-input" type="checkbox" name="prot_share_2" value="whats_up">
                        </label>
                        <label class="form-check-label"> 
                            <img src="images/twitter-icon.png">
                            <input class="form-check-input" type="checkbox" name="prot_share_3" value="twitter">
                        </label>
                        <label class="form-check-label"> 
                            <img src="images/mail-icon.png">
                            <input class="form-check-input" type="checkbox" name="prot_share_4" value="mail">
                        </label>
                        <br>
                    </div>
                    <div class="buttomsFlexContainer">
                        <input class="btn btn-primary" id="submitbtn" type="submit" value="Submit">
                        <?php echo "<a href='protestList.php?user_id=".$_GET["user_id"]."&page=3'><buttom class='btn btn-primary' id='returnbtn'> Return </buttom></a>";?>
                    </div>
                </form>
            </main>
            <script>
                menu();
            </script>
            <footer>
            </footer>
        </div>
    </body> 
</html>
<?php
    mysqli_close($connection);
?>