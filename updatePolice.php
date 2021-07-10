<?php
    include 'db.php';
    include "config.php";   
    if(!empty($_POST["prot_status"])){
        echo "<h1>".$_POST["prot_status"]."</h1>";
        if ($_POST["prot_status"] == "Approved"){
            $stat = 1;
        }
        elseif ($_POST["prot_status"] == "Deny"){
            $stat = 0;
        }
        elseif ($_POST["prot_status"] == "reapproved"){
            $stat = 3;
        }
        $query ="UPDATE tbl_87_protests SET 
        prot_police='".$_POST["prot_police"]."', 
        prot_status=".$stat.
        " WHERE prot_id=".$_GET["prot_id"].";"; 
        echo "<h1>".$query."</h1>";
        $result = mysqli_query($connection , $query);
        if ($result){
          header ('location: '.HAGASHA_URL.'protestList.php?user_id='.$_GET["user_id"].'&page=4');          
        }
    }
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
        <title>updatepolice</title>
    </head>
    <body id="updatepolice">
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
            <main>
                <h1>Update Protest</h1>
                <?php echo '<form name="updateProtest" action="updatePolice.php?user_id='.$row[0].'&prot_id='.$prot_row[0].'" method="POST" autocomplete="on">';?>
                    <div class="mb-3 form-group">
                        <label class="form-label"> name
                            <?php echo'<input type="text" class="form-control" name="prot_name" value="'.$prot_row[1].'" disabled>';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> police notes- PLEASE FILL
                            <?php echo '<input type="text"  class="form-control" name="prot_police" value="'.$prot_row[6].'">';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> address
                            <?php echo'<input type="text" class="form-control" name="prot_address" value="'.$prot_row[2].'" disabled>';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php
                                $time = new DateTime($prot_row[3]);
                                $date = $time->format('Y-m-d');
                                $dts = new DateTime();
                                $dts = $dts->format('Y-m-d');
                                echo'<input type="date" class="form-control" name="prot_date" value="'.$date.'" min="'.$dts.'" disabled>';
                            ?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?php
                                $time = $time->format('H:i');
                                echo'<input type="time" class="form-control" name="prot_time" value="'.$time.'" disabled>';
                            ?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> cause
                            <?php echo'<input type="text" class="form-control" name="prot_cause" value="'.$prot_row[4].'" disabled>';?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> notes
                            <?php echo'<textarea name="notes" class="form-control" rows="4" disabled>'.$prot_row[5].'</textarea>';?>
                        </label>
                    </div>
                    <div class="mb-3 form-group required">
                        <label><b>Permission: </b>&nbsp;<br></label>            
                        <label> <input type="radio" name="prot_status" value="Approved">Approved</label>
                        <label for="user"><input type="radio" name="prot_status" value="Deny"> Deny</label>
                        <label for="user"><input type="radio" name="prot_status" value="reapproved" checked> Fix</label> 
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