<?php

date_default_timezone_set('Asia/Kolkata');

$loginE="undefine";
$sign="undefine";
$sent="undefine";
$logout="undefine";
$pass="undefine";

if($_SERVER['REQUEST_METHOD']=='POST'){
  include "assets/_dbconnect.php";
  $userid=$_POST['userid'];
  $message=$_POST['message'];
  $date=date("F j, Y, g:i a");  

  //! To avoid hacking in website, as < this is now changed into &lt; no one can inject js code now.
  $message=str_replace("<","&lt;",$message);
  $message=str_replace(">","&gt;",$message);

  $sql="INSERT INTO `message` ( `message`,`user_id`, `sent` ) VALUES ( '$message', '$userid' , '$date')";
  $result=mysqli_query($conn,$sql);
}

//! To giving a login based message, I am using get request variables login and same with others too;
if(isset($_GET['login'])){
    $loginE=$_GET['login'];
}
if(isset($_GET['signup'])){
    $sign=$_GET['signup'];
}
if(isset($_GET['sent'])){
    $sent=$_GET['sent'];
}
if(isset($_GET['logout'])){
  $logout=$_GET['logout'];
}


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <title>iSecret</title>
  <link rel="apple-touch-icon" sizes="180x180" href="https://assets.dryicons.com/uploads/icon/svg/8859/cdf7ad61-0549-4442-a349-d17717288163.svg">
<link rel="icon" type="image/png" sizes="32x32" href="https://assets.dryicons.com/uploads/icon/svg/8859/cdf7ad61-0549-4442-a349-d17717288163.svg">
<link rel="icon" type="image/png" sizes="16x16" href="https://assets.dryicons.com/uploads/icon/svg/8859/cdf7ad61-0549-4442-a349-d17717288163.svg">

<link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php
//! Included navbar and its components
include "assets/_header.php";


//! giving user alert for particular scenario
if($loginE=="wpass"){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Wrong Password.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

if($loginE=="wemail"){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Email doesnot exist. Try to signup.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
if($sign=="notmatch"){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Password did not match or password field is empty.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
if($sign=="exist"){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Email already exists. Try to <span class="text-primary" type="button" data-toggle="modal" data-target="#loginmodal">sign in</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
if($sign=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You successfully created account to iSecret. You can <span class="text-primary" type="button" data-toggle="modal" data-target="#loginmodal">login</span> now.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
if($logout=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You logout from iSecret successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
if($loginE=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You log into your iSecret account successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
if($sent=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your message sent successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

echo '<div class="container">';

//! Creating dynamic secret link for user and making it visible so that it can be sharable;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $userid=$_GET['userid'];
    echo '<div class="alert alert-success" role="alert">
  <h4 class="alert-heading display-3">Congrats!</h4>
  <p>You successfully logged into iSecret!</p>
  <hr>
  Share this website <a href="/secrethost/sent.php/?userid='.$userid.'" class="alert-link">"/secrethost/sent.php/?userid='.$userid.'"</a> to your friends or visit to see the messages sent to you. Have Fun!!
</div>';
}

//! giving user message how they can share link to others;
else{
    echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">You are not logged in!</h1>
    <p class="lead font-weight-bolder"><span class="text-primary" data-toggle="modal" data-target="#signupmodal" type="button">Create an account</span> and <span class="text-primary" type="button" data-toggle="modal" data-target="#loginmodal">sign in</span> to send your own secret link or ask a friend to share their unique link to send message!</p>
  </div>
</div>';
}



  

?>


</div>
<?php 
include "assets/_footer.php"
?>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
</body>

</html>