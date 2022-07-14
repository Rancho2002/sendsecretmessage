<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "_dbconnect.php";
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $checksql="SELECT * FROM `users` where `useremail`='$email'";
    $result=mysqli_query($conn,$checksql);
    $num=mysqli_num_rows($result);
    // echo $num;
    if($num==1){
        if($pass==""){
            header("location: /secrethost/index.php/?login=wpass");
            exit;
        }

        $row=mysqli_fetch_assoc($result);
        if($pass==password_verify($pass,$row['password'])){
            session_start();
            $email=str_replace("<","&lt;",$email);
            $email=str_replace(">","&gt;",$email);
            $_SESSION['loggedin']=true;
            $_SESSION['email']=$email;
            $_SESSION['id']=$row['id'];
            $login="true";
            //! if login=true, redirect to index with user id same as userid in mysql database;
            header("location: /secrethost/index.php?login=".$login."&userid=".$row['userid']);
            exit();
        }
        else{
            header("location: /secrethost/index.php/?login=wpass");  
        }
    }
    else{
        header("location: /secrethost/index.php/?login=wemail");
    }
}


?>

