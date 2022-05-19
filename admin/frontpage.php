<?php

include '../config.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];

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

  <?php include '../includes/hnav.php'; ?>

  <!-- main content -->

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
  <div class="container" style="margin-right: 40px;">
      
  <style>
      

      .fill {
          background-image: url('https://source.unsplash.com/random/150x150');
          position: relative;
          height: 150px;
          width: 150px;
          top: 5px;
          left: 5px;
          cursor: pointer;
      }

      .hold {
          border: solid 5px #ccc;
      }

      .empty {
          display: inline-block;
          height: 200px;
          width: 100%;
          margin: 10px;
          /* border: solid 3px salmon; */
          border: 1px dashed salmon;
          background: white;
      }

      .starter {
          display: inline-block;
          height: 200px;
          width: 100%;
          margin: 10px;
          /* border: solid 3px salmon; */
          border: 1px dashed salmon;
          background: white;
      }

      .hovered {
          background: #f4f4f4;
          border-style: dashed;
      }

      #selectblock {
          margin-left:100px;
          
          
          
      }

      #selectblock button {
          top: 50%;
          left: 50%;
          text-align: center;
          margin-top:100px;
          margin-right: 50px;
      }

      .disblock {
        width: 100%;
        height: 25px;
        top: 50%;
        text-align:center;
        border: solid 2px salmon;
        padding-bottom: 2px;
        padding-top: 0px;
        margin-bottom: 4px;
      }

      .form-check {
        width: 100%;
        height: 25px;
        top: 50%;
        text-align:center;
        border: solid 2px #6CB4EE;
        padding-bottom: 2px;
        padding-top: 0px;
        margin-bottom: 4px;
      }

  </style>


  <div class="container-fluid">
      
      
      <div class="container">
          <div class="row">
              <h5>
                  Add Blocks
              </h5>
          </div>
          <div class="row">
              <div class="starter">
                  <!-- <div class="fill" draggable="true"> </div> -->
                  <div id="selectblock">
                      
                     
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Select Block
                      </button>


                  </div>
              </div>

              <!-- <div class="empty">
                  <div class="fill" draggable="true"> </div>
                  
              </div> -->

              <!-- <div class="empty">
                  
              </div>

              <div class="empty">
              </div>

              <div class="empty">
              </div>

              <div class="empty">
              </div> -->
          </div>
      </div>

  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Avaible Blocks</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">

                <!-- <div class="disblock">
                  block name
                </div> -->
                
                <?php
                    $block_dir = "blocks";
                    // Sort in ascending order - this is default
                    $blockarray = scandir($block_dir);
                    foreach ($blockarray as $block) {
                      if (str_contains($block, '.php')) {
                      
                        echo "
                          <div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='name[]' value='' id='defaultCheck1'>
                            <label class='form-check-label' for='defaultCheck1'>
                              $block
                            </label>
                          </div>
                              ";
                      }
                      
                    }
                    // echo "----------- <br>";
                    // print_r($blockarray);
                ?>

            </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Add</button>
          </div>
          </div>
      </div>
  </div>
   
  
  
  
  
  <script>
      const fill = document.querySelector('.fill');
      const empties = document.querySelectorAll('.empty');

      // Fill listeners
      fill.addEventListener('dragstart', dragStart);
      fill.addEventListener('dragend', dragEnd);

      // Loop through empty boxes and add listeners
      for (const empty of empties) {
      empty.addEventListener('dragover', dragOver);
      empty.addEventListener('dragenter', dragEnter);
      empty.addEventListener('dragleave', dragLeave);
      empty.addEventListener('drop', dragDrop);
      }

      // Drag Functions

      function dragStart() {
      this.className += ' hold';
      setTimeout(() => (this.className = 'invisible'), 0);
      }

      function dragEnd() {
      this.className = 'fill';
      }

      function dragOver(e) {
      e.preventDefault();
      }

      function dragEnter(e) {
      e.preventDefault();
      this.className += ' hovered';
      }

      function dragLeave() {
      this.className = 'empty';
      }

      function dragDrop() {
      this.className = 'empty';
      this.append(fill);
      }

  </script>
  
      
 </div>


      
  </main>

 



   


<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
