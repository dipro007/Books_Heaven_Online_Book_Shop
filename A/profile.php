<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>User Profile Information System</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="assets/css/main.css" rel="stylesheet">


</head>
<body>

  <?php include 'header.php'; ?>

  <section>

    <div class="container">
      <strong style="font-size: 60px;" class="title">User Profile Information</strong>
    </div>
    
    
    <div class="profile-box box-left">

      <?php

        if(isset($_SESSION['prompt'])) {
          showPrompt();
        }


        $query = "SELECT * FROM user WHERE username = '".$_SESSION['username']."' AND password = '".$_SESSION['password']."'";

        ;

        if($result = mysqli_query($con, $query)) {

          $row = mysqli_fetch_assoc($result);

         
          echo "<div class='info'><span style='font-size: 30px'><b>User Name : </b>".$row['firstname']."   ".$row['lastname']."</span></div>";
          echo"<br></br>";
          echo "<div class='info'><span style='font-size: 30px'><b>Email : </b>".$row['email']."</span></div>";
          echo"<br></br>";
          echo "<div class='info'><span style='font-size: 30px'><b>Contact Number : </b>".$row['contactno']."</span></div>";
          echo"<br></br>";
          echo "<div class='info'><span style='font-size: 30px'><b>Paying Method : </b>".$row['paymethod']."</span></div>";
          echo"<br></br>";

          $query_date = "SELECT DATE_FORMAT(date_joined, '%d/%m/%Y') FROM user WHERE id = '".$_SESSION['userid']."'";
          $result = mysqli_query($con, $query_date);

          $row = mysqli_fetch_row($result);

          echo "<div class='info'><span style='font-size: 30px'><b>Purchase Date : </b>".$row[0]."</span></div>";

        } else {

          die("Error with the query in the database");

        }

      ?>
      
      <div class="options">
        <a style="font-size: 20px;" class="btn btn-success" href="changepassword.php">Change Password</a>
        <a style="font-size: 20px;" class="btn btn-warning" href="editprofile.php">Update Profile</a>
        <a style="font-size: 20px;"class="btn btn-dark" href="../crud/index.php">Buy Books</a>
      </div>

      
    </div>

  </section>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php


  } else {
    header("location:index.php");
    exit;
  }

  unset($_SESSION['prompt']);
  mysqli_close($con);

?>