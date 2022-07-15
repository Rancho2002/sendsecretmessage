<?php
include "assets/_dbconnect.php";
date_default_timezone_set('Asia/Kolkata');
$delete=false;
if(isset($_GET['deleteAll'])){
  $id=$_GET['userid'];
  $sql="DELETE FROM `message` WHERE `user_id`='$id'";
  $result=mysqli_query($conn,$sql);
  $delete=true;
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
  <!-- //! Included navbar and its component -->
  <?php
  include "assets/_header.php";

  if($delete){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You have deleted all messages.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
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
    <form action="/secrethost/index.php/?sent=true&userid=<?php echo $userid ?>" method="POST">
      <input type="hidden" name="userid" value="<?php echo $userid ?>">
      <div class="form-group">
        <label for="message"><b><i>Enter message</i></b></label>
        <textarea class="form-control" id="message" name="message" rows="6"></textarea>
      </div>
      <button type="submit" class="btn btn-success mb-3">Submit</button>
    </form>
    
    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

      echo '<hr>
      <a class="'.$_GET['userid'].' btn  btn-danger delete" id="delete">Delete all messages</a>

    <hr>';
      $sql = "SELECT * FROM `message` where `user_id`='$userid'";
      $result = mysqli_query($conn, $sql);
      $num=mysqli_num_rows($result);
//! Fetching all the messages for a particular user;
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="media" id="message">
          <img src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" class="mr-3" width="35px" alt="anonymous user">
          <div class="media-body">
            <h5 class="mt-0">Sent at ' . $row['sent'] . '</h5>
            <p>' . $row['message'] . '</p>
          </div>
          </div>
          <hr>';
      }
      if($num==0){
        echo '<hr>
        <div class="container text-center">
        <h3>No messages are sent till now</h3>
        <p>Ask your friend to send message by sharing this url : <a href="/secrethost/sent.php/?userid='.$userid.'" class="alert-link">"/secrethost/sent.php/?userid='.$userid.'"</a></p>
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
  <?php
include "assets/_footer.php";
  ?>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js" integrity="sha512-1zzZ0ynR2KXnFskJ1C2s+7TIEewmkB2y+5o/+ahF7mwNj9n3PnzARpqalvtjSbUETwx6yuxP5AJXZCpnjEJkQw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    user=0;
    listItem=document.getElementsByClassName("delete");
    Array.from(listItem).forEach((element) =>{
      element.addEventListener("click",(e)=>{
        user=e.target.className[0];
        for(i=1;i<6;i++){
          user+=e.target.className[i];
        }
        console.log(user);
      })
    })
    document.getElementById("delete").addEventListener("click",()=>{
      if(confirm("Are you sure you want to delete all notes?")){
        window.location.href=`/secrethost/sent.php/?deleteAll=true&userid=${user}`;
      }
      else{
        alert("Delete all cancelled");
      }
    })

  </script>
</body>

</html>