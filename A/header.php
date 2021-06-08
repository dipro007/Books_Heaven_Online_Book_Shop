<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="img/name.png" width="60" height="60" alt="">
    </a>
  <a class="navbar-brand" href="index.php">Books Heaven Online Book Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php 
      if(isset($_SESSION['username'], $_SESSION['password'])) {
    ?>
    <ul class="navbar-nav mr-auto">
 
    </ul>
    <form class="form-inline my-2 my-lg-0" action="searchresults.php" method="GET">
      <input type="text" class="form-control" name="searchbox" id="searchbox" placeholder="Search student name here" required autocomplete="off">
      <button class="btn btn-info my-2 my-sm-0" type="submit" name="search" id="search-btn" value="Search">Search</button>
    </form>
    <a href="logout.php" class="btn btn-danger m-3 b-3 my-sm-0">Logout</a>
    <?php 
        } else {
          echo "<span class='not-logged'>Please login to get our service</span>";
        }

      ?>
  </div>
</nav>