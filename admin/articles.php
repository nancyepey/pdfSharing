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

  <?php include '../includes/hnav.php'; ?>

  <!-- main content -->

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
  <div class="container">
    <h3>News</h3>
    <!-- <div class="buttons">
    <a class='btn btn-primary' href='#' target='_blank'>+</a>
    </div> -->
    <!-- Trigger the modal with a button -->
      <!-- Button trigger modal -->
      <a class="btn btn-primary" style="text-decoration:none;" href="./add_article.php">
        +
      </a>

      <?php

        $get_news_query = "SELECT * FROM news ";
        $get_news = mysqli_query($conn, $get_news_query);

        ?>


      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Thumbnails</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Author</th>
              <!-- <th scope="col">Category</th> -->
              <th scope="col">Date</th>
              <th scope="col">View</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
          <?php

            

            //get size of the fetch result
            //$count = $get_users->rowCount();
            // echo $get_users->rowCount();
            $i = 1;
            //we need to values using a while loop
            while($row = mysqli_fetch_assoc($get_news)) {

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
            <tr>
              <td><?php echo $i; ?></td>
              <td>
                <img src="../uploads/images/<?= $new_thumb; ?>" height="100" width="200" alt="">
                
              </td>
              <td><?= $new_tten; ?></td>
              <td>
                <p>
                <?php echo $new_sden; ?>
                </p>
              </td>
              <td><?= $new_author; ?></td>
              <td><?= $new_date; ?></td>
              <td>
                <a href='./viewnew.php?new_id=<?= $new_id; ?>'>Views</a>
              </td>
              <td>
                <button type="button" class="btn btn-info " id="<?php echo $new_id; ?>">
                    <i class="fas fa-edit"></i>
                </button>

              </td>
              <td>
                <button type="button" class="btn btn-danger " id="<?php echo $new_id; ?>">
                    <i class="fas fa-trash"></i>
                </button>

              </td>
            </tr>
            <?php 
                $i++;
                } 
              ?>
            
          </tbody>
        </table>
      </div>
 </div>


      
  </main>

 



   
  <script src="https://kit.fontawesome.com/fa0f4f5b37.js" crossorigin="anonymous"></script>


<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
