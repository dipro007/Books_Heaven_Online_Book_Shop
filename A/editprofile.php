<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $fname = clean($_POST['firstname']);
    $lname = clean($_POST['lastname']);
    $email = clean($_POST['email']);
    $paymethod = clean($_POST['paymethod']);
    $cnumber = clean($_POST['contactno']);

    $query = "UPDATE user SET firstname = '$fname', lastname = '$lname', email = '$email', paymethod = '$paymethod', contactno = '$cnumber'
    WHERE id='".$_SESSION['userid']."'";

    if($result = mysqli_query($con, $query)) {

      $_SESSION['prompt'] = "Profile Updated";
      header("location:profile.php");
      exit;

    } else {

      die("Error with the query");

    }

  }

  if(isset($_SESSION['username'], $_SESSION['password'])) {

    $qry = mysqli_query($con,"SELECT * FROM user where id = {$_SESSION['userid']} ");
    $data = mysqli_fetch_array($qry);
    extract($data);

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Update User Information System</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/main.css" rel="stylesheet">


    
</head>
<body>

  <?php include 'header.php'; ?>

  <section>
    
    <div class="container">
      <strong style="font-size: 50px;" class="title">Update User Profile</strong>
    </div>
    

    <div class="edit-form box-left clearfix">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <?php 
            $query = "SELECT contactno FROM user WHERE id = '".$_SESSION['userid']."'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_row($result);

          ?>
        <div class="form-group">
          <label style="font-size: 20px;">Contact Number : </label>

          <input type="text" class="form-control" name="contactno" value="<?php echo $contactno ?>" placeholder="Contact No." required>
          

        </div>


        <div class="form-group">
          <label style="font-size: 20px;" for="firstname">First Name</label>
          <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name" required>
        </div>


        <div class="form-group">
          <label style="font-size: 20px;" for="lastname">Last Name</label>
          <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name" required>
        </div>


        <div class="form-group">
          <label style="font-size: 20px;" for="email">Email</label>


          <input type="text" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Email" required>
          

        </div>


        <div class="form-group">
          <label style="font-size: 20px;" for="paymethod">Paying Method</label>

          <select class="form-control" name="paymethod">
            <option <?php echo $paymethod == 'COD' ? "selected": ""; ?>>Cash of delivary</option>
            <option <?php echo $paymethod == 'B' ? "selected": ""; ?>>Bkash</option>
            <option <?php echo $paymethod == 'R' ? "selected": ""; ?>>Rocket</option>
            <option <?php echo $paymethod == 'N' ? "selected": ""; ?>>Nagad</option>
          </select>

        </div>
        
        <div class="form-footer">
          <a class="btn btn-primary" style="font-size: 20px;" href="profile.php">Back to Profile</a>
          <input class="btn btn-warning" style="font-size: 20px;" type="submit" name="update" value="Update Profile">
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

  mysqli_close($con);

?>