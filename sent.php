<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <title>iSecret</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/secret/assets/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/secret/assets/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/secret/assets/favicon/favicon-16x16.png">
<link rel="manifest" href="/secret/assets/favicon/site.webmanifest">
</head>

<body>
  <!-- //! Included navbar and its component -->
  <?php
  include "assets/_header.php"

  ?>

  <?php
  //! already creating url attaching "userid" in address bar, before writing below line;
  $userid = $_GET['userid'];
  ?>
  <div class="container">
    <h1 class="display-3 mx-0">Send secret message to me: </h1>
    <h3 class="mx-1">
      <marquee> I will never come to know who sent me this message</marquee>
    </h3>
    <!-- //! creating dynamic link for users in address bar, so that post request can be made -->
    <form action="/secret/index.php/?sent=true&userid=<?php echo $userid ?>" method="POST">
      <input type="hidden" name="userid" value=" <?php echo $userid ?> ">
      <div class="form-group">
        <label for="message"><b><i>Enter message</i></b></label>
        <textarea class="form-control" id="message" name="message" rows="6"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <hr>
    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      include "assets/_dbconnect.php";

      $sql = "SELECT * FROM `message` where `user_id`='$userid'";
      $result = mysqli_query($conn, $sql);
      $num=mysqli_num_rows($result);
//! Fetching all the messages for a particular user;
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="media">
          <img src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" class="mr-3" width="35px" alt="anonymous user">
          <div class="media-body">
            <h5 class="mt-0">Sent at ' . $row['sent'] . '</h5>
            <p>' . $row['message'] . '</p>
          </div>
          </div>';
      }
      if($num==0){
        echo '<hr>
        <div class="container text-center">
        <h3>No messages are sent till now</h3>
        <p>Ask your friend to send message by sharing this url : <a href="/secret/sent.php/?userid='.$userid.'" class="alert-link">"/secret/sent.php/?userid='.$userid.'"</a></p>
        </div>
        ';
      }
    } 
    //! giving user message how they can see there message or create link;
    else {
      echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">You are not logged in!</h1>
    <p class="lead">This website requires sign in to show you the messages sent to you, although you can send message to others without signin.</p>
  </div>
</div>';
    }
    ?>


  </div>
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