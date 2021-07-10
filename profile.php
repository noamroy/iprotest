<?php
    include 'db.php';
    include "config.php";
    if(!empty($_POST["user_id"])) { //true if form was submitted
        $query ="UPDATE tbl_87_users SET
        user_pass= '".$_POST["user_pass"]."',
        user_address= '".$_POST["user_address"]."',
        user_phone= '".$_POST["user_phone"]."',
        user_facebook= '".$_POST["user_facebook"]."',
        user_twitter= '".$_POST["user_twitter"]."',
        user_mail= '".$_POST["user_mail"]."' 
        WHERE user_id=".$_POST["user_id"].";";
        echo "<h1>".$query."</h1>";
        $result = mysqli_query($connection , $query);
        if ($result){
          header ('location: '.LOCAL_URL.'homepage.php?user_id='.$_POST["user_id"]);  //SUBMIT FIX
        }
    }
    else{
        if(!empty($_GET["user_id"])){
            $query ="SELECT * FROM tbl_87_users WHERE user_id=".$_GET["user_id"].";";
            $result = mysqli_query($connection , $query);
            $row = mysqli_fetch_array($result);
        }
        else{
            $message = "FORBIDDEN PLACE";
        }
    }
?>
<?php
    
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
        <title>updateProfile</title>
    </head>
    <body id="createProtest">
        <?php if (!empty($message)) {echo $message;} ?>
        <div class="wrapper">
            <header class="flexContainer">
                <img src="images/hum.png" class="dropbtn" id="hum" alt="hum" title="menu" herf=#>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                    <?php
                            echo '<a href="profile.php?user_id='.$row[0].'>Profile</a>';
                            echo '<a href="protestList.php?user_id='.$row[0].'&page=1">My Upcoming protests</a>';
                            echo '<a href="createProtest.php?user_id='.$row[0].'">Create Protest</a>';
                            echo '<a href="protestList.php?user_id='.$row[0].'&page=2">Search protest</a>';
                        ?>
                            <a href="index.php">Log out</a>
                    </div>
                </div>
                <?php
                    echo "<h4>HI, ".$row[2]."</h4>";
                ?>
                <?php
                    echo '<a href="homepage.php?user_id='.$row[0].'">';
                ?>
                    <section id="logo"></section>
                </a>
            </header>
            <main>
                <h1>Profile</h1>
                <form action="#" method="post" id="frm">
                    <?php 
                        echo '<input type="hidden" name="user_id" value='.$row[0].'>';
                    ?>
                    <div class="mb-3">
                        <label for="loginName">Name</label>
                        <?php
                            echo '<input type="text" class="form-control" name="user_name" id="loginName" value="'.$row[2].'" disabled/>';
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="loginPass">Pass</label>
                        <?php
                            echo '<input type="password" class="form-control" name="user_pass" id="loginPass" value="'.$row[3].'" require/>';
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="loginAddress">Address</label>
                        <?php
                            echo '<input type="text" class="form-control" name="user_address" id="loginAddress" value="'.$row[4].'"/>';
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="loginPhone">Phone</label>
                        <?php
                            echo '<input type="tel" class="form-control" name="user_phone" id="loginPhone" value="'.$row[5].'"/>';
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="loginFacebook">Facebook</label>
                        <?php
                            echo '<input type="text" class="form-control" name="user_facebook" id="loginFacebook" value="'.$row[6].'"/>';
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="loginTwitter">Twitter</label>
                    <?php
                        echo '<input type="text" class="form-control" name="user_twitter" id="loginTwitter" value="'.$row[7].'"/>';
                    ?>
                    </div>
                    <div class="mb-3">
                        <label for="loginMail">Mail</label>
                        <?php
                            echo '<input type="email" class="form-control" name="user_mail" id="loginMail" value="'.$row[8].'"/>';
                        ?>
                    </div>
                    <div class="buttomsFlexContainer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <?php 
                            echo "<a href='homepage.php?user_id=".$_GET["user_id"]."><buttom class='btn btn-primary' id='returnbtn'> Return </buttom></a>";
                        ?>
                    </div>
                </form>
            </main>
        </div>
        <footer></footer>
    </body>
</html>
<?php
    mysqli_close($connection);
?>