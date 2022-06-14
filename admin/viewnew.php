<?php

include '../config.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['id'];

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
    <title>Articles</title>
    

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- chart js -->
    <style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,700");
@import url("https://fonts.googleapis.com/css?family=Lato:400,400i,700");

body {
  font-family: Lato, sans-serif;
}

.container {
  display: grid;
  grid-template-columns: 4rem 3fr 1fr 2rem;
  margin-top: 2rem;
  grid-column-gap: 2rem;
}

.header {
  grid-column: 2 / 5;
}


.header .subheading {
  text-transform: uppercase;
  letter-spacing: 0.1rem;
  font-size: smaller;
  color: #455A64;
}

.content {
  grid-column: 2 / 3;
  text-align: justify;
  font-size: 1.1rem;
  line-height: 1.4;
}

.content .poster-image {
  width: 100%;
  object-fit: cover;
}

.aside .heading {
  margin: 0;
  font-weight: 600;
}


@media only screen and (max-width: 600px) {
  .container {
    grid-template-columns: 2rem 3fr 1fr 2rem;
  }
  .content {
    grid-column: 2 / 4;
  }
  .aside {
    grid-column: 2 / 4;
  }
}

.card {
  height: 5rem;
  display: flex;
  align-items: center;
  text-transform: capitalize;
  margin: 1rem 0;
  cursor: pointer;
}

.card img {
  height: 100%;
  width: 40%;
  margin-right: 0.5rem;
}

.card p {
  margin: 0;
}

.card .title {
  font-size: 0.8rem;
}

.card .author {
  font-size: small;
}


</style> 

  </head>
  <body>
    
  <?php include '../includes/header.php'; ?>

  <?php 
  include '../includes/hnav.php';
  include './functions.php';

  
    if(isset($_GET['new_id'])) {
        
        $the_new_id = escape($_GET['new_id']);
        
    }



    //getting a particular new id
    $query = "SELECT * FROM news WHERE id = $the_new_id ";
    //
    $select_new_by_id= mysqli_query($conn, $query);

    //we need to values using a while loop
    while($row = mysqli_fetch_assoc($select_new_by_id)) {
        //cat_categories table
        //news table
        $new_id            = $row['id'];
        $new_thumb         = $row['thumbnail'];
        $new_tten          = $row['title_en'];
        $new_ttfr         = $row['title_fr'];
        $new_cnfr          = $row['content_fr'];
        $new_cnen         = $row['content_en'];
        $new_sdfr         = $row['short_desc_fr'];
        $new_sden         = $row['short_desc_en'];
        $new_start         = $row['state'];
        $new_valid         = $row['validated'];
        $new_author         = $row['author'];
        $new_translator         = $row['translator'];
        $new_date          = $row['created_on'];

       
   ?>


<div class="container" style="margin-top:10rem;">
    <div class="row">
        <div class="col-12"></div>
        
</div>

<main class="container">
  <header class="header">
    <h1 class="heading"><?php echo $new_tten; ?></h1>
    <p><?php echo $new_author; ?> <span><?php echo $new_date; ?></span></p>
    <br>
  </header>
  <section class="content">
    <img src='../uploads/images/<?php echo $new_thumb; ?>' alt='large-image' class="poster-image">
    <br>
    <p style="padding:10px;">
    <?php echo $new_cnen; ?>
    <br>
    </p>
    <?php } ?>
</section>
  <aside class="aside">
    <h4 class="heading">Other Articles you might Enjoy</h4>
    <div class="card">
      <img src='https://images.unsplash.com/photo-1457269315919-3cfc794943cd?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=2c42c1cac3092204f4c1afdca4d44e99' alt=''>
      <div>
        <p class="heading title">The big subtext</p>
        <p class="author">Mathews</p>
      </div>
    </div>
    <div class="card">
      <img src='https://images.unsplash.com/photo-1528640936814-4460bc015292?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=66812b5fda04c80ff762c8a920f562f3' alt=''>
      <div>
        <p class="heading title">The bug subtext</p>
        <p class="author">Harsha</p>
      </div>
    </div>
  </aside>
  
</main>

 



<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
