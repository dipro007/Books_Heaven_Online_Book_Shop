<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';


  if(isset($_POST['register'])) {

    $uname = clean($_POST['username']); 
    $pword = clean($_POST['password']); 
    $contactno = clean($_POST['contactno']); 
    $fname = clean($_POST['firstname']); 
    $lname = clean($_POST['lastname']); 
    $email = clean($_POST['email']); 
    $paymethod = clean($_POST['paymethod']); 
    

    $query = "SELECT username FROM user WHERE username = '$uname'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) == 0) {

      $query = "SELECT contactno FROM user WHERE contactno = '$contactno'";
      $result = mysqli_query($con,$query);

      if(mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO user (username, password, contactno, firstname, lastname, email, paymethod, date_joined)
        VALUES ('$uname', '$pword', '$contactno', '$fname', '$lname', '$email', '$paymethod', NOW())";

        if(mysqli_query($con, $query)) {

          $_SESSION['prompt'] = "Registered Successfully!!!";
          header("location:index.php");
          exit;

        } else {

          die("Error with the query");

        }

      } else {

        $_SESSION['errprompt'] = "That User number already exists in system!";

      }

    } else {

      $_SESSION['errprompt'] = "Username already exists in system!";

    }
  } 

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Online Book Shop User Signup</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/main.css" rel="stylesheet">

	
    
</head>
<body>

  <?php include 'header.php'; ?>

  <section class="center-text">
    
    <h1 style="font-size:70px"><b>Registration</b></h1>
    

    <div class="registration-form box-center clearfix">

    <?php 
        if(isset($_SESSION['errprompt'])) {
          showError();
        }
    ?>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="row">
          <div class="account-info col-sm-3">
          
          
            

          </div>

          <div class="personal-info col-sm-6">
            
            
              <legend style="color: white;font-size: 30px;"><b>Buyer Infomation</b></legend>


              <div class="form-group">
                <label style="color: white;", for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
              </div>



              <div class="form-group">
                <label style="color: white;", for="firstname" >First Name </label>
                <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
              </div>

              <div class="form-group">
                <label style="color: white;", for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
              </div>

              <div class="form-group">
                <label style="color: white;", for="email">Email</label>
                <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email" required>
              </div>

              <div class="form-group">
                <label style="color: white;", for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>


              <div class="form-group">
                <label style="color: white;", for="password">Confirm Password</label>
                <input type="password" class="form-control" name="password" placeholder="Re-enter Password" required>
              </div>
              
              <div class="form-group">
                <label style="color: white;", for="contactno">Contact Number</label>
                <input type="text" class="form-control" name="contactno" placeholder="User Contact Number" required>
              </div>

              
                  
                  
                </select>

              </div>

              <div class="form-group">
                <label style="color: white;", for="paymethod">Payment Method</label>

                <select class="form-control" name="paymethod">
                  <option>Cash on delivary</option>
                  <option>Bkash</option>
                  <option>Rocket</option>
                  <option>Nagad</option>
                  
                </select>

              </div>

            
            

          </div>
          <div class="account-info col-sm-3">
          
          
            

          </div>
        </div>

        
        
        <a style="color: white;font-size:20px;", href="index.php">Return to Log in</a>
        <input style="font-size: 20px;" class="btn btn-danger" type="submit" name="register" value="Sign up">



      </form>
    </div>

  </section>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	
</body>
</html>

<?php 

  unset($_SESSION['errprompt']);
  mysqli_close($con);

?>