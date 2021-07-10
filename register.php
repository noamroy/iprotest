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
          header ('location: '.HAGASHA_URL.'index.php');  //SUBMIT FIX
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
    <script src="js/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <title>Register</title>
  </head>
  <body id = "register">
    <header class="flexContainer">
      <section id="logo"></section>
    </header>
    <div class="wrapper">
      <main>
        <h1>Register</h1>
        <form action="#" method="post" id="frm">
          <div class="mb-3 form-group required">
            <label><b>Enter Type of user: </b>&nbsp;</label>              
            <input type="radio" name="loginType" value="user" checked>
            <label for="user">user&nbsp;</label>
            <input type="radio" name="loginType" value="government">
            <label for="user">government</label>
          </div>
          <div class="mb-3">
            <label for="loginName"></label>
            <input type="text" class="form-control" name="loginName" id="loginName" placeholder="Enter Name" require/>
          </div>
          <div class="mb-3">
            <label for="loginPass"></label>
            <input type="password" class="form-control" name="loginPass" id="loginPass" placeholder="Enter Password" require/>
          </div>
          <div class="mb-3">
            <label for="loginAddress"></label>
            <input type="text" class="form-control" name="loginAddress" id="loginAddress" placeholder="Enter Address" />
          </div>
          <div class="mb-3">
            <label for="loginPhone"></label>
            <input type="tel" class="form-control" name="loginPhone" id="loginPhone" placeholder="Enter Phone Number" />
          </div>
          <div class="mb-3">
            <label for="loginFacebook"></label>
            <input type="text" class="form-control" name="loginFacebook" id="loginFacebook" placeholder="Enter Facebook" />
          </div>
          <div class="mb-3">
            <label for="loginTwitter"></label>
            <input type="text" class="form-control" name="loginTwitter" id="loginTwitter" placeholder="Enter Twitter" />
          </div>
          <div class="mb-3">
            <label for="loginMail"></label>
            <input type="email" class="form-control" name="loginMail" id="loginMail" placeholder="Enter Mail" require/>
          </div>
          <div class="buttomsFlexContainer">
            <button type="submit" class="btn btn-primary">Register</button>
            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>  
          </div>  
          <p>         
            <a href="index.php">Have an Account? Login Now!</a>
          </p>
        </form>
      </main>
    </div>
    <footer></footer>
  </body>
</html>
<?php
  mysqli_close ($connection);
?>