<?php
    include 'db.php';
    include "config.php";
    if(!empty($_POST["loginName"])) { //true if form was submitted
      $query ="SELECT * FROM tbl_87_users WHERE user_name='"
        .$_POST["loginName"]
        ."' and user_pass='"
        .$_POST["loginPass"]
        ."';";
      echo $query; // can't start echo if header comer after it
      $result = mysqli_query($connection , $query);
      $row = mysqli_fetch_array($result); 
      if(is_array($row)) {
        //$message = 'success';
        header ('location: http://localhost/iprotest/homepage.php?user_id='.$row[0]); // SUBMIT FIX
      } else {
        $message = "Invalid Username or Password!";
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
    <title>Login</title>
  </head>
  <body id = "login">
    <div class="wrapper">
      <header class="flexContainer">
        <section id="logo"></section>
      </header>
      <main>
        <h1>LOGIN</h1>
        <section class="container">
          <form action="#" method="post" id="frm">
            <div class="form-group">
              <label for="loginMail">App name: </label>
              <input type="text" class="form-control" name="loginName" id="loginName" placeholder="Enter Name" />
            </div>
            <div class="form-group">
              <label for="loginPass">Password: </label>
              <input type="password" class="form-control" name="loginPass" id="loginPass" placeholder="Enter Password" />
            </div>
            <button type="submit" class="btn btn-primary">Log Me In</button>
            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>   
          </form>
          <a href="register.php"><button class="btn btn-secondary">Register</button></a>
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
