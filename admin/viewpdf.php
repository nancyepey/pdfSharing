<?php

include '../config.php';
include_once 'functions.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];

if(!isset($user_id)){
   header('location:../login.php');
}

$showgroup = "";

if(isset($_POST['addcat'])) {

  // get fields
  $group = escape($_POST['group']);
  $year = escape($_POST['year']);
  $author = $username;
  $name = strval($year). ' '. $group;
  //for datetime
  date_default_timezone_set("Africa/Douala"); //to specify time with respect to my zone
  $CurrentTime =time(); //current time in seconds
  //strftime is string format time
  //$DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime); //mostly use when we have to apply sql format
  $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime); 
  $created_on = $DateTime;
  $updated_on = $DateTime;

  //getting up some validations
  if(empty($group)) {
    $message[] = "Group Can not be empty";
  } elseif (empty($year)) {

    $message[] = "year Can not be empty";

  } elseif ($author == '') {
    $message[] = "Author Can not be empty";
  } elseif ($name == '') {
    $message[] = "Name Can not be empty";

  } else {

    // $message[] =  $group. ' '. $year. ' '. $author. ' '.$name. ' '.$created_on. ' '. $updated_on;

    // creating the query
    $query = "INSERT INTO category(name, groupe, year, createdby, created_on, updated_on) VALUES('$name' ,'$group', '$year', '$author', '$created_on', '$updated_on')";
    //sending the query to the database
    $create_cat_query = mysqli_query($conn, $query);
    confirmQuery($create_cat_query);
    if($create_cat_query) {
      $message[] = "Category created successfully";
    } else {
      $message[] = "Please try again an error occured!";
    }
  }

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
    <title>PDF</title>


    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <style>
      * {box-sizing: border-box}
      body {font-family: "Lato", sans-serif;}

      /* Style the tab */
      .tab {
        float: left;
        /* background-color: #f1f1f1; */
        width: 30%;
        height: 100px;
      }

      .heading {
        /* background-color: #f1f1f1; */
        padding: 5px;
      }

      /* Style the buttons inside the tab */
      .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 12px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ddd;
      }

      /* Create an active/current "tab button" class */
      .tab button.active {
        background-color: #ccc;
        /* background-color: #00BFFF; */
      }

      /* Style the tab content */
      .tabcontent {
        float: left;
        padding: 0px 12px;
        width: 70%;
        border-left: none;
        height: 300px;
      }
    </style>
   

  </head>
  <body>
    
  <?php include '../includes/header.php'; ?>

  <?php include '../includes/hnav.php'; ?>

  <!-- main content -->

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
  <div class="container" style="margin-right: 40px;">
    <?php
      if(isset($message)){
          foreach($message as $message){
              echo '
              <div class="message">
                  <span>'.$message.'</span>
                  <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
              </div>
              ';
          }
      }
    ?>
    <h2>PDFS</h2>
    <!-- <div class="buttons">
    <a class='btn btn-primary' href='#' target='_blank'>+</a>
    </div> -->
    <!-- Trigger the modal with a button -->
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpdfmodal">
        + PDF
      </button>

      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcatmodal">
        + Category
      </button>

      <!-- Add PDF Modal -->
      <div class="modal fade" id="addpdfmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addpdfmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addpdfmodalLabel">Add File</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <form method="post">
                <div class="mb-3">
                  <label for="name" class="form-label">Title</label>
                  <input type="text" class="form-control" id="name" placeholder="">
                </div>
                <div class="form-group">
                  <label for="image">Upload Image</label>
                  <div class="custom-file">
                    <input type="file" name="upload_image" class="custom-file-input" id="image">
                    <label for="image" class="custom-file-label">Choose File</label>
                  </div>
                  <small class="form-text text-muted">Max Size 3mb</small>
	              </div>
                <div class="mb-3">
                  <label for="category" class="form-label">Category</label>
                  <input type="text" class="form-control" id="category" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Add File</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Add category Modal -->
      <div class="modal fade" id="addcatmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addcatmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addcatmodalLabel">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- form -->
            <form method="post">
              <div class="modal-body">
                <!-- group -->
                <div class="row g-3 align-items-center mb-2">
                  <div class="col-auto">
                    <label for="inputgroup" class="col-form-label">Group</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-select form-control" name="group" aria-label="Default select example">
                      <option selected>Select Group</option>
                      <option value="white oils price structure">White Oils Price Structure</option>
                      <option value="structure des prix produits blanc">Structure des prix produits blanc</option>
                    </select>
                  </div>
                  <!-- <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                      Must be 8-20 characters long.
                    </span>
                  </div> -->
                </div>
                <!-- year -->
                <div class="row g-3 align-items-center mb-2">
                  <div class="col-auto ">
                    <label for="inputyear" class="col-form-label" style="padding-right: 10px;">Year</label>
                  </div>
                  <div class="col-auto">
                    <input type="number" id="inputyear" name="year" class="form-control" aria-describedby="yearHelpInline">
                  </div>
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" value="Add Category" class="btn btn-primary" name="addcat">
              </div>
            </form>
          </div>
        </div>
      </div>

      
 </div>

 <!-- display -->
 <div class="container" style="margin-right: 40px; margin-top: 20px;">

   <div class="cat">
          <?php

          // getting the categories
          $get_cats_query = "SELECT * FROM category ";
          $get_cats = mysqli_query($conn, $get_cats_query);
          $i = 1;
          while($row = mysqli_fetch_assoc($get_cats)) {
            // category table
            $cat_id = $row['id'];
            $cat_name = $row['name'];
            $cat_group = $row['groupe'];
            $cat_year = $row['year'];
            $cat_createdby = $row['createdby'];
            $cat_createdon = $row['created_on'];
            $cat_updatedon = $row['updated_on'];

            if($cat_group == "white oils price structure") {
              $showgroup = "<h6>EN PDF</h6>";
            } elseif($cat_group == "structure des prix produits blanc") {
              $showgroup = "<h6>FR PDF</h6>";
            }

          
          ?>
     <div class="tab">
        <div class="heading">
    
          <!-- <h6>EN PDF</h6> -->

          <!-- table category and pdf -->
            <?php
              
            ?>
          <h6><?= $showgroup; ?></h6>
        </div>
        <!-- <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">london</button> -->
        <button class="tablinks" onclick="openCity(event, '<?= $cat_name; ?>')"><?= $cat_name; ?></button>
      </div>
      
      <div id="<?= $cat_name; ?>" class="tabcontent">
        <h3>London</h3>
        <p>London is the capital city of England.</p>
        <p><?= $cat_year; ?></p>
      </div>

      <!-- <div id="Paris" class="tabcontent">
        <h3>Paris</h3>
        <p>Paris is the capital of France.</p> 
      </div>

      <div id="Tokyo" class="tabcontent">
        <h3>Tokyo</h3>
        <p>Tokyo is the capital of Japan.</p>
      </div> -->
      <?php } ?>
    </div>

 </div>


      
  </main>

 


  <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
  </script>
   


<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
