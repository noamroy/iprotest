<?php
    include 'db.php';
    include "config.php";
    if(!empty($_GET["user_id"])) { //true if form was submitted
      $query ="SELECT * FROM tbl_87_users WHERE user_id='"
        .$_GET["user_id"]
        ."';";
      echo $query; // can't start echo if header comer after it
      $result = mysqli_query($connection , $query);
      $row = mysqli_fetch_array($result); 
      if(is_array($row)) {
        //$message = 'success';
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/scripts.js"></script>
        <link rel="stylesheet" href="css/style.css"/>
        <title>homePage</title>
    </head>
    <body id="homePage">
        <div class="wrapper">
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
            <main>
                <?php
                    echo "<h1>HI, ".$row[2]."</h1>";
                ?>
                <section class="container">
                    <section>
                        <a href="">
                            <h2>Navigate to protest</h2>
                        </a>
                    </section>
                    <section>
                        <?php
                            echo '<a href="protestList.php?user_id='.$row[0].'&page=1">';
                        ?>
                            <h2 >My Upcoming protests</h2>
                        </a>
                    </section>
                    <section>
                        <?php
                            echo '<a href="protestList.php?user_id='.$row[0].'&page=2">';
                        ?>
                            <h2>Search protest</h2>
                        </a>
                    </section>
                    <section>
                        <?php
                            echo '<a href="protestList.php?user_id='.$row[0].'&page=3">';
                        ?>
                            <h2>Manage protests</h2>
                        </a>
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
