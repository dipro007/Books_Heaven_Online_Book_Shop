<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $oldpass = clean($_POST['oldpass']);
    $newpass = clean($_POST['newpass']);
    $confirmpass = clean($_POST['confirmpass']);

    $query = "SELECT password FROM user WHERE password = '$oldpass'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {

      if($newpass == $confirmpass) {

        $query = "UPDATE user SET password = '$newpass' WHERE id='".$_SESSION['userid']."'";

        if($result = mysqli_query($con, $query)) {

          $_SESSION['prompt'] = "Password updated.";
          $_SESSION['password'] = $newpass;
          header("location:profile.php");
          exit;

        } else {

          die("Error with the query");

        }

      } else {

        $_SESSION['errprompt'] = "The new passwords you entered does not match!";;

      }

    } else {

      $_SESSION['errprompt'] = "You have entered a wrong old password!";

    }

  }

  if(isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>User Password Upate System</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/main.css" rel="stylesheet">

	
</head>
<body>

  <?php include 'header.php'; ?>

  <section>
    
    <div class="container">
      <strong style="font-size:50px;" class="title">Change Password</strong>
    </div>
    

    <div class="edit-form box-left clearfix">

      <?php 
        if(isset($_SESSION['errprompt'])) {
          showError();
        }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">


        <div class="form-group">
          <label style="font-size: 20px;" for="oldpass">Current Password</label>
          <input type="password" class="form-control" name="oldpass" placeholder="Enter Current Password" required>
        </div>


        <div class="form-group">
          <label style="font-size: 20px;" for="newpass">New Password</label>
          <input type="password" class="form-control" name="newpass" placeholder="Enter New Password" required>
        </div>

        <div class="form-group">
          <label style="font-size: 20px;" for="confirmpass">Confirm Password</label>
          <input type="password" class="form-control" name="confirmpass" placeholder="Confirm Password" required>
        </div>

        <div class="form-footer">
          <a style="font-size: 20px;" class="btn btn-primary" href="profile.php">Back to Profile</a>
          <input style="font-size: 20px;" class="btn btn-success" type="submit" name="update" value="Update Password">
        </div>
        

      </form>
    </div>

  </section>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php

  } else {
    header("location:profile.php");
  }

  unset($_SESSION['errprompt']);
  mysqli_close($con);

?>