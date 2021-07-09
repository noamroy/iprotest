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
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="css/style.css"/>
        <script src="js/scripts.js"></script>
        <title>manageProtest</title>
    </head>
    <body id="manageProtest">
        <div class="wrapper">
            <header class="flexContainer">
                <img src="images/hum.png" class="dropbtn" id="hum" alt="hum" title="menu" herf=#>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="myUpcomingprotests.html">My Upcoming protests</a>      <!-- TO FIX! -->
                        <a href="create_protest.html">Create protest</a>                <!-- TO FIX! -->
                        <a href="searchProtest.html">Search protest</a>                 <!-- TO FIX! -->
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
                <h1>Manage Protests</h1>
                <?php
                    echo '<a href="new_protest.php?user_id='.$row[0].'">';
                ?>
                    <img src="images/add_icon.png" id="add_icon" title="add" alt="add">
                </a>
                <section id="chart" class="table">
                <?php
                    $query ="SELECT prot_id,prot_name,prot_address,prot_time,prot_status FROM tbl_87_protests 
                    WHERE prot_owner=".$_GET["user_id"]."
                    AND prot_status!=2
                    LIMIT 10;";
                    //echo $query; // can't start echo if header comer after it
                    $result = mysqli_query($connection , $query);
                    $n = $result->num_rows;                    
                    echo "<table class='table table-striped'>";
                    echo "<thead> <tr> <th scope='row'>Name</th> <th scope='row'>Location</th><th scope='row'>Date</th><th scope='row'>Status</th></tr></thead>";
                    echo "<tbody>";
                    for ($i=0; $i<$n; $i++) {    
                        $row = mysqli_fetch_array($result);
                        echo '<a href="protest.php?user_id='.$_GET["user_id"].' prot_id='.$row[0].'">'; //TO FIX!!!!!!!
                        echo "<tr> <th scope='row'>".$row[1]."</th> <td>".$row[2]."</td> <td>".$row[3]."</td>";
                        echo "<td>";
                        if ($row[4] == 3)
                            echo "Not checked";
                        elseif ($row[4] == 2)
                            echo "not relevant";
                        elseif ($row[4] == 1)
                            echo "approved";
                        elseif ($row[4] == 0)
                            echo "Decline";
                        echo "</td>";
                        echo "</tr>"; 
                        echo "</a>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                ?>
                </section>
            </main>
            <footer></footer>
        </div>
        <script>
        //createManageTable();
        menu();
        </script>
    </body>
</html>
<?php
  mysqli_close ($connection);
?>
