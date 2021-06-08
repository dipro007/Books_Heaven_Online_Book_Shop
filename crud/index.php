<?php

require_once ("../crud/php/component.php");
require_once ("../crud/php/operation.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Book Store</title>

   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="style.css">

</head>
<body>

<main>
    <div class="container text-center">
        <h1 class="py-4 bg-dark text-light rounded">
        <a class="navbar-brand" href="#">
        <img src="img/name.png" width="80" height="80" alt="img">
      <h1 style="color:white;font-size:60px;">Books Heaven Online Book Store</h1>

        <div class="d-flex justify-content-center">
            <form action="" method="post" class="w-50">
                <div class="pt-2">
                    <?php inputElement("ID", "book_id",setID()); ?>
                </div>
                <div class="pt-2">
                    <?php inputElement("Book Tittle", "book_name",""); ?>
                </div>
                <div class="row pt-2">
                    <div class="col">
                        <?php inputElement("Book Author", "book_publisher",""); ?>
                    </div>
                    <div class="col">
                        <?php inputElement("Book Price", "book_price",""); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                        <?php buttonElement("btn-create","btn btn-success","<span>Add</span>","create","data-toggle='tooltip' data-placement='bottom' title='Create'"); ?>
                        <?php buttonElement("btn-read","btn btn-info","<span>Refresh</span>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                        <?php buttonElement("btn-update","btn btn-warning","<span>Update</span>","update","data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
                        <?php buttonElement("btn-delete","btn btn-danger","<span>Delete</span>","delete","data-toggle='tooltip' data-placement='bottom' title='Delete'"); ?>
                        <?php deleteBtn();?>
                </div>
            </form>
        </div>

       
        <div class="d-flex table-data">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Book Tttle</th>
                        <th>Book Author</th>
                        <th>Book Price</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php


                   if(isset($_POST['read'])){
                       $result = getData();

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>

                               <tr>
                                   <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                                   <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_name']; ?></td>
                                   <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_publisher']; ?></td>
                                   <td data-id="<?php echo $row['id']; ?>"><?php echo '$' . $row['book_price']; ?></td>
                                   <td ><i class="fas fa-edit btnedit" data-id="<?php echo $row['id']; ?>"></i></td>
                               </tr>

                   <?php
                           }

                       }
                   }


                   ?>
                </tbody>
            </table>
        </div>
        


    </div>
</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="../crud/php/main.js"></script>

<div style="text-align: center;padding: 30px;">
<span style="color:black; font-size: 30px;">Done Shopping?</span>
<br>  <br>
<a style="font-size: 20px;"class="btn btn-dark" href="../A1/index.php">Back to Home</a>
</div>


</body>
</html>