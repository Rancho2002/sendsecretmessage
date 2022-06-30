<?php

 //! Starting session here so that I not have to write below line again and again

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="">iSecret</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<li class="nav-item active">
<a class="nav-link" href="">Home</a>
</li>
</ul>';


//! displaying user name in navbar after he logged in;

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<p class="text-light my-0">Welcome <span class="font-weight-bold mr-3">'.$_SESSION['email'].'</span></p>
    <a class="btn btn-success" href="/secret/assets/_logout.php">Logout</a>';

}

//! else displaying login and signup button;

else{
    echo '<button type="button" class="btn btn-success " data-toggle="modal" data-target="#signupmodal">Signup</button>
    <button type="button" class="btn btn-success ml-3 " data-toggle="modal" data-target="#loginmodal">Login</button>';
  }

echo '</div>
</nav>';

//! also including signup and login modal forms;
include "_signup.php";
include "_login.php";
?>
