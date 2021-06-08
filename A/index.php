<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['login'])) {

    $uname = clean($_POST['username']);
    $pword = clean($_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$uname' AND password = '$pword'";

    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_assoc($result);

      $_SESSION['userid'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['password'] = $row['password'];

      header("location:profile.php");
      exit;

    } else {

      $_SESSION['errprompt'] = "Incorrect username or password!";

    }

  }

  if(!isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Online Book Shop User login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/main.css" rel="stylesheet">


</head>
<body>

  <?php include 'header.php'; ?>
  <section class="blurry"></section>

  <section class="center-text">
    
    <h1 style="font-size:70px"><b>Log in</b></h1>
    

    <div class="login-form box-center">
      <?php 

        if(isset($_SESSION['prompt'])) {
          showPrompt();
        }

        if(isset($_SESSION['errprompt'])) {
          showError();
        }

      ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
        </div>

        <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        
        <a style="color: white;font-size:20px;", href="register.php">Don't have an account?</a>
        <input style="font-size:20px" class="btn btn-danger" type="submit" name="login" value="Log in">

      </form>
    </div>

  </section>

<footer>


</footer>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php

  } else {
    header("location:profile.php");
    exit;
  }

  unset($_SESSION['prompt']);
  unset($_SESSION['errprompt']);

  mysqli_close($con);

?>