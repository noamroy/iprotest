<?php
    include 'db.php';
    include "config.php";
    if(!empty($_GET["user_id"])||!empty($_GET["page"])) {
      $query ="SELECT * FROM tbl_87_users WHERE user_id='"
        .$_GET["user_id"]
        ."';";
      $page = $_GET["page"];
      $result = mysqli_query($connection , $query);
      $row = mysqli_fetch_array($result);
      if(is_array($row)) {
      } else {
        $message = "FORBIDDEN PLACE";
      }
    }
    else{
        $message = "FORBIDDEN PLACE";
    }
    if(!empty($_GET["event_counter"])){
        $counter = $_GET["event_counter"];
    }
    else{
        $counter = 10;
    }
    $query ="UPDATE tbl_87_protests SET prot_status=2 WHERE prot_time < CURRENT_TIMESTAMP;";
    $result = mysqli_query($connection , $query);

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <script src="js/scripts.js"></script>
        <?php
            echo "<title>";
            if ($page == 1)
                echo "myUpcomingProtests";
            elseif ($page == 2)
                echo "searchProtests";
            elseif ($page == 3)
                echo "manageProtests";
            echo "</title>";
        ?>
    </head>
    <body id="manageProtest">
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
                    echo "<h1>";
                    if ($page == 1)
                        echo "My Upcoming Protests";
                    elseif ($page == 2)
                        echo "Search Protests";
                    elseif ($page == 3)
                        echo "Manage Protests";
                    echo "</h1>";
                ?>
               
                <section id="chart" class="table">
                <?php
                    if ($page == 1 && $row[1] == 1){
                        $query ="SELECT prot_id,prot_name,prot_address,prot_time,prot_status FROM tbl_87_protests 
                        WHERE prot_id=(SELECT prot_id FROM tbl_87_connect WHERE user_id=".$_GET['user_id'].") 
                        AND prot_status=1 "."
                        LIMIT ".$counter.";";
                    }
                    elseif ($page == 2 || ($page == 1 && $row[1] == 2)){
                        $query ="SELECT prot_id,prot_name,prot_address,prot_time,prot_status FROM tbl_87_protests 
                        WHERE prot_status=1 LIMIT ".$counter.";";
                    }
                    elseif ($page == 3){
                        $query ="SELECT prot_id,prot_name,prot_address,prot_time,prot_status FROM tbl_87_protests 
                        WHERE prot_owner=".$_GET["user_id"]."
                        AND prot_status!=2
                        LIMIT ".$counter.";";
                    }
                    elseif ($page == 4){
                        $query ="SELECT prot_id,prot_name,prot_address,prot_time,prot_status FROM tbl_87_protests 
                        WHERE prot_status=3 LIMIT ".$counter.";";
                    }                  
                    $result = mysqli_query($connection , $query);
                    if (!empty($result)){
                        $n = $result->num_rows;            
                    }
                    else{
                        $n = 0;
                    }
                    ?>
                     <?php
                    if ($page == 3){
                        echo '<a href="createProtest.php?user_id='.$row[0].'">';
                        echo '<img src="images/add_icon.png" id="add_icon" title="add" alt="add">';
                        echo '</a>';
                    }
                ?>
                    <table class='table table-striped'>
                        <thead> 
                            <tr>
                                <th scope='row'>Name</th>
                                <th scope='row'>Location</th>
                                <th scope='row'>Date</th>
                                <th scope='row'>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for ($i=0; $i<$n; $i++) {    
                                    $row = mysqli_fetch_array($result);
                                    echo "<tr> ".
                                            "<th scope='row'>".
                                                "<a href='protestDetails.php?user_id=".$_GET["user_id"]."&prot_id=".$row[0]."'>".$row[1]."</a>".
                                            "</th>".
                                            "<td>".$row[2]."</td>".
                                            "<td>".$row[3]."</td>";
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
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        $counter = $counter+10;
                        if($n==$counter){
                            echo "<a href='protestList.php?user_id=".$_GET["user_id"]."&page=".$page."&event_counter=".$counter."'><button type='button'>More protests</button></a>";
                        }
                    ?>
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