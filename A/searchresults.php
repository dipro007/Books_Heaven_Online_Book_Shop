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

	<title>Search Result - Student Information System</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/main.css" rel="stylesheet">


    
</head>
<body>

  <?php include 'header.php'; ?>

  <section>

    <?php 

      if(isset($_GET['search'])) {

        $s = clean($_GET['searchbox']);

        $query = "SELECT contactno, firstname, lastname, email, paymethod, DATE_FORMAT(date_joined, '%d/%m/%Y') as date_joined, CONCAT(firstname, ' ', lastname) as fullname 
        FROM user WHERE CONCAT(firstname, ' ', lastname) = '$s' OR firstname = '$s' OR lastname = '$s' ORDER BY date_joined DESC LIMIT 5";
    ?>

    <div class="container">
      <strong style="font-size: 50px;" class="title">Here search results for "<?php echo $s; ?>"!</strong>


    


    <?php

        if($result = mysqli_query($con, $query)) {

          if(mysqli_num_rows($result) == 0) {

            echo "<p>No results matches to your info!</p>";
            echo "</div>";

          } else {
            echo "</div>";
            echo "<ul class='profile-results'>";

            while($row = mysqli_fetch_assoc($result)) {

          ?>

              <li>
                <div class="result-box box-left">
                  <div class='info'><span style="font-size: 30px;"><b>Contact Number : </b><?php echo $row['contactno']; ?></span></div>
                  <br></br>
                  <div class='info'><span style="font-size: 30px;"><b>User Name: </b><?php echo $row['firstname']. "  ".$row['lastname']; ?></span></div>
                  <br></br>
                  <div class='info'><span style="font-size: 30px;"><b>Email : </b><?php echo $row['email']; ?></span></div>
                  <br></br>
                  <div class='info'><span style="font-size: 30px;"><b>Payment Method : </b><?php echo $row['paymethod']; ?></span></div>
                  <br></br>
                  <div class='info'><span style="font-size: 30px;"><b>Date Joined : </b><?php echo $row['date_joined']; ?></span></div>
                  
                </div>
              </li>

          <?php

            }

            echo "</ul>";

          }

        } else {
          die("Error with the query");
        }

      }

    ?>
  
          <div>
          <a " class="btn btn-primary" style="font-size: 20px;" href="profile.php">Back to Profile</a>
          </div>

  </section>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</body>
</html>

<?php 

  } else {
    header("location:index.php");
    exit;
  }

  mysqli_close($con);

?>