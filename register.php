<?php
    include 'db.php';
    include "config.php";
    if(!empty($_POST["loginType"])) { //true if form was submitted
      $query ="SELECT * FROM tbl_87_users WHERE user_name='"
        .$_POST["loginName"]
        ."' or user_mail='"
        .$_POST["loginMail"]
        ."';";
      echo $query; // can't start echo if header comer after it
      $result = mysqli_query($connection , $query);
      $row = mysqli_fetch_array($result); 
      if(is_array($row)) {
        $message = 'Username or email already been used!';
      } else {
        $type=0;
        if ($_POST["loginType"]=='user'){
          $type=1;
        } else {
          $type=2;
        }
        $query ="INSERT INTO tbl_87_users (user_type,user_name,user_pass,user_address,user_phone,user_facebook,user_twitter,user_mail) VALUES ('"
        .$type."','"
        .$_POST["loginName"]."','"
        .$_POST["loginPass"]."','"
        .$_POST["loginAddress"]."','"
        .$_POST["loginPhone"]."','"
        .$_POST["loginFacebook"]."','"
        .$_POST["loginTwitter"]."','"
        .$_POST["loginMail"]."');";
        $result = mysqli_query($connection , $query);
        if ($result){
          //$message = 'success';
          header ('location: http://localhost/iprotest/index.php');
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Register</title>
  </head>
  <body id = "login">
    <div class="wrapper">
      <header class="flexContainer">
        <section id="logo"></section>
      </header>
      <main>
        <h1>Register</h1>
        <section class="container">
          <form action="#" method="post" id="frm">
            <div class="form-group">
              <label>Enter Type of user: (required)</label>              
              <input type="radio" name="loginType" value="user" checked>
              <label for="user">user</label><br>
              <input type="radio" name="loginType" value="government">
              <label for="user">government</label><br>
            </div>
            <div class="form-group">
              <label for="loginName">App name: (required)</label>
              <input type="text" class="form-control" name="loginName" id="loginName" placeholder="Enter Name" require/>
            </div>
            <div class="form-group">
              <label for="loginPass">Password: (required)</label>
              <input type="password" class="form-control" name="loginPass" id="loginPass" placeholder="Enter Password" require/>
            </div>
            <div class="form-group">
              <label for="loginAddress">Enter Address: </label>
              <input type="text" class="form-control" name="loginAddress" id="loginAddress" placeholder="Enter Address" />
            </div>
            <div class="form-group">
              <label for="loginPhone">Enter Phone Number: </label>
              <input type="tel" class="form-control" name="loginPhone" id="loginPhone" placeholder="Enter Phone Number" />
            </div>
            <div class="form-group">
              <label for="loginFacebook">Enter Facebook: </label>
              <input type="text" class="form-control" name="loginFacebook" id="loginFacebook" placeholder="Enter Facebook" />
            </div>
            <div class="form-group">
              <label for="loginTwitter">Enter Twitter: </label>
              <input type="text" class="form-control" name="loginTwitter" id="loginTwitter" placeholder="Enter Twitter" />
            </div>
            <div class="form-group">
              <label for="loginMail">Enter Mail: (required)</label>
              <input type="email" class="form-control" name="loginMail" id="loginMail" placeholder="Enter Mail" require/>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>   
          </form>
          <a href="index.php"><button class="btn btn-secondary">Return</button></a>
        </section>
      </main>
      <footer></footer>
    </div>
    <div class="container">
    </div>
  </body>
</html>
<?php
  mysqli_close ($connection);
?>