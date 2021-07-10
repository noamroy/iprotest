<?php
    include 'db.php';
    include "config.php";
    if(!empty($_GET["user_id"])) {
        $query ="SELECT * FROM tbl_87_users WHERE user_id=".$_GET["user_id"].";";
        $result = mysqli_query($connection , $query);
        $row = mysqli_fetch_array($result);
        $strJsonFileContents = file_get_contents("protest1.json");
        $array = json_decode($strJsonFileContents, true);
    }
    else{
        $message = "FORBIDDEN PLACE";
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
        <link rel="stylesheet" href="css/style2.css"/>
        <title>jsonProtest</title>
    </head>
    <body id="createProtest">
        <?php if (!empty($message)) {echo $message;} ?>
        <div class="wrapper">
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
            <main id="test"> <!-- FIX -->
                <h1>Create Protest</h1>
                <?php echo '<form name="createProtest" action="createProtest.php?user_id="'.$row[0].' method="POST" autocomplete="on">';?>
                    <div class="mb-3 form-group">
                        <label class="form-label"> 
                            <?php echo'<input type="text" class="form-control" name="prot_name" value="'.($array["protest"]["name"]).'" require>';?>
                        </label>
                    </div>
                    <?php echo '<input type="hidden" name="prot_owner" value='.$_GET["user_id"].'>';?>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php echo'<input type="text" class="form-control" name="prot_address" value="'.($array["protest"]["address"]).'" require>';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php
                            $dts = new DateTime();
                            $dts = $dts->format('Y-m-d');
                            echo'<input type="date" class="form-control" name="prot_date" value="'.($array["protest"]["date"]).'" min="'.$dts.'" require>';
                            ?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php echo'<input type="time" class="form-control" name="prot_time" value="'.($array["protest"]["time"]).'" require>';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php echo'<input type="text" class="form-control" name="prot_cause" value="'.($array["protest"]["cause"]).'" >';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php echo'<textarea name="notes" class="form-control" rows="4">'.($array["protest"]["notes"]).'</textarea>';?>
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
                        </label><br>
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
</body> 
</html>
<?php
    mysqli_close($connection);
?>