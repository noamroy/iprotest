<?php
    include 'db.php';
    include "config.php";
    if(!empty($_GET["user_id"])||!empty($_GET["prot_id"])) {
      if(!empty($_GET["join"])) {
        $stat = $_GET["join"];
        if ($stat == 1){
            $query ="INSERT INTO tbl_87_connect (prot_id, user_id)
            VALUES (".$_GET["prot_id"].",".$_GET["user_id"].");";
            $result = mysqli_query($connection , $query);
        }
        elseif ($stat == 2) {
            $query ="DELETE FROM tbl_87_connect WHERE 
            prot_id =".$_GET["prot_id"]." AND 
            user_id =".$_GET["user_id"].";";
            $result = mysqli_query($connection , $query);
        }
      }
      $query ="SELECT * FROM tbl_87_users WHERE user_id="
        .$_GET["user_id"]
        .";";
      $prot = $_GET["prot_id"];
      $result = mysqli_query($connection , $query);
      $row = mysqli_fetch_array($result);
      $query ="SELECT * FROM tbl_87_protests WHERE prot_id=".$_GET["prot_id"].";";
      $result = mysqli_query($connection , $query);
      $prot_row = mysqli_fetch_array($result);
      if(is_array($row)&&is_array($prot_row)) {
      } else {
        $message = "FORBIDDEN PLACE";
      }
    }
    else{
        $message = "FORBIDDEN PLACE";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css"/>
        <script src="js/scripts.js"></script>
        <?php
        echo "<title>".$prot_row[1]."</title>";
    ?>    
    </head>
    <body id="protestPage">
        <?php if (!empty($message)) {echo $message;} ?>
        
            <header class="flexContainer">
                <img src="images/hum.png" class="dropbtn" id="hum" alt="hum" title="menu" herf=#>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                    <?php
                            echo '<a href="#">Profile</a>';
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
            <div class="wrapper">
            <main>  
                <?php
                    echo "<h1>".$prot_row[1]."</h1>";
                    echo "<section><p>".$prot_row[4]."</p></section>";
                ?>
                <section class="details">
                    <section>
                        <img src="images/locaionicon.png" class="smallPic" id="" alt="location" title="location">
                        <?php echo $prot_row[2]?>
                    </section>
                    <section>
                        <img src="images/attendence icon.png" class="smallPic" id="" alt="location" title="location">
                        <?php 
                            $query ="SELECT COUNT(*) FROM tbl_87_connect WHERE prot_id='".$_GET["prot_id"]."';";
                            $result = mysqli_query($connection , $query);
                            $result = mysqli_fetch_array($result);
                            echo $result[0];
                        ?>
                    </section>
                    <section>
                        <img src="images/clockicon.png" class="smallPic" id="" alt="location" title="location">
                        <?php echo $prot_row[3]?>
                    </section>
                </section>
                <section class='flexContainer'>
                    <?php
                    echo "<a href='homepage.php?user_id=".$_GET["user_id"]."'><button type='button' class='btn btn-info'> Return </button></a>";
                ?>
                    <a href='#'><button type="button" class="btn btn-info"> Forum </button></a>
                    <a href='#'><button type="button" class="btn btn-info"> Share </button></a>
                </section>
                <section>
                    <?php
                        $query ="SELECT * FROM tbl_87_connect WHERE prot_id=".$_GET["prot_id"]." AND
                            user_id=".$_GET["user_id"].";";
                        $result = mysqli_query($connection , $query);
                        $check = mysqli_fetch_array($result);
                        if ($row[1]==2){
                            echo '<a href="updatePolice.php?user_id='.$_GET["user_id"].
                            '&prot_id='.$_GET["prot_id"].'">';
                            echo '<button type="button" class="btn btn-join" id="joinbtn">Permission Protest</button>';
                            echo "</a";
                        }
                        elseif ($prot_row[8]==$_GET["user_id"]){
                            echo '<a href="updateProtest.php?user_id='.$_GET["user_id"].
                            '&prot_id='.$_GET["prot_id"].'">';
                            echo '<button type="button" class="btn btn-join" id="joinbtn">Manage Protest</button>';
                            echo "</a>";
                        }
                        elseif(is_array($check)){
                            echo "<a href='protestDetails.php?user_id=".$_GET["user_id"].
                            "&prot_id=".$_GET["prot_id"].
                            "&join=2'>";
                            echo '<button type="button" class="btn btn-join" id="joinbtn">Leave Protest</button>';
                            echo "</a>";
                        }
                        else {
                            echo "<a href='protestDetails.php?user_id=".$_GET["user_id"].
                            "&prot_id=".$_GET["prot_id"].
                            "&join=1'>";
                            echo '<button type="button" class="btn btn-join" id="joinbtn">Join Protest</button>';
                            echo "</a>";
                        }
                        
                    ?>
                </section>
                <section class="Instructions">
                    <section>
                        <h2>Police Instructions</h2>
                        <p> 
                            <?php echo $prot_row[6]?>
                        </p>
                    </section>
                    <section>
                        <h2>Manager Instructions</h2>
                        <p>
                            <?php echo $prot_row[5]?>
                        </p>
                    </section>
                </section>      
            </main>
            <footer></footer>
        </div>
        <script>
            menu();
        </script>
    </body>
</html>
<?php
  mysqli_close ($connection);
?>