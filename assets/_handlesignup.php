<?php

$user=rand(1,100);
$str=password_hash($user,PASSWORD_DEFAULT);
$rand=substr($str,10,6);


//! if any user sign up, he send a post request and then we take the email, password and confirm password via post super variable and handle signup page which I use my to send post request;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "_dbconnect.php";
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];

    $sql="Select * from `users`";
    $result=mysqli_query($conn,$sql);
    // $row=mysqli_num_rows($result)+1;

    $existsql="SELECT * FROM `users` where `useremail`='$email'";
    $existRes=mysqli_query($conn,$existsql);
    $num=mysqli_num_rows($existRes);
    if($num>0){
        $signup="exist";
    }
    else{
        if($pass==""){
            header("location: /secrethost/index.php/?signup=notmatch");
            exit;
        }
        else if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`userid`,`useremail`, `password`, `created`) VALUES ('$rand','$email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            $signup="true";
        }
        else
        $signup="notmatch";
    }

//! redirecting to index.php, attaching "signup" and "userid" in address bar with a value of total number of columns in mysql database+1, so that GET request can be accessed;

header("location: /secrethost/index.php/?signup=".$signup);
}

?>