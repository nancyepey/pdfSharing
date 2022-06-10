<?php

include '../config.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
           
$name =  $_SESSION['name'] ;
$email =  $_SESSION['email'];
$role =  $_SESSION['role'];
$pic =  $_SESSION['pic'] ;
$date =  $_SESSION['date'] ;

if(!isset($user_id)){
   header('location:../login.php');
} 

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    
    

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style> -->



    
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- chart js -->
   

  </head>
  <body>
    
  <?php include '../includes/header.php'; ?>

  
  
<div class="container-fluid">
  <div class="row">
    <!-- sidebar -->
    <?php include '../includes/hnav.php'; ?>

    <!-- main content -->
<br>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
    <?php 
        echo "<br>";
        echo $user_id;
        echo "<br>";
        echo $username ;
        echo "<br>";
                  
        echo $name  ;
        echo "<br>";
        echo $email  ;
        echo "<br>";
        echo $role  ;
        echo "<br>";
        echo $pic  ;
        echo "<br>";
        echo $date  ;
    ?>

      
    </main>
  </div>
</div>


 



</div>


    <script src="../js/bootstrap.bundle.min.js"></script>
  
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
