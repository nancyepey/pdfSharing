<?php

include '../config.php';
include_once 'functions.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../login.php');
}

if(isset($_POST['adduser'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $username = $_POST['uname'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = md5($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    $role = $_POST['role'];
    $role = filter_var($role, FILTER_SANITIZE_STRING);
 
    
    //getting media
    $image = $_FILES['upload_image']['name'];
    $image_tmp_name = $_FILES['upload_image']['tmp_name'];
    $image_size = $_FILES['upload_image']['size'];
    $image_folder = 'uploaded_img/'.$image;
   
 
    $updatedon = date('d-m-y h:i:s'); //date time
 
    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);
 
    if($select->rowCount() > 0){
       $message[] = 'user already exist!';
    }else{
       if($pass != $cpass){
          $message[] = 'confirm password not matched!';
       }elseif($image_size > 2000000){
          $message[] = 'image size is too large!';
       }else{
          $insert = $conn->prepare("INSERT INTO `users`(username, name, email, password, role, image, created_on) VALUES(?,?,?,?,?,?,?)");
          $insert->execute([$username,$name, $email, $cpass, $role, $image, $updatedon]);
          if($insert){
             move_uploaded_file($image_tmp_name, $image_folder);
             $message[] = 'User created succesfully!';
             
          }
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
    <title>Dashboard </title>

    
    

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

  
    
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="../logout.php">Sign out</a>
      </div>
    </div>
  </header>

  <?php include '../includes/hnav.php'; ?>



  <!-- main content -->

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

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
      
  <div class="container" style="margin-right: 40px;">
    <h2>USERS</h2>
    <!-- <div class="buttons">
    <a class='btn btn-primary' href='#' target='_blank'>+</a>
    </div> -->
    <!-- Trigger the modal with a button -->
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpdfmodal">
        +
      </button>

      <?php

        //ADD USER
        

      ?>

      <!-- Add User Modal -->
      <div class="modal fade" id="addpdfmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addpdfmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <!-- form -->
              <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="addpdfmodalLabel">Add User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <div class="mb-3">
                  <label for="uname" class="form-label">Username</label>
                  <input type="text" class="form-control" autocomplete="off" id="uname" name="uname" placeholder="enter username" required>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="enter username" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                </div>
                <div class="mb-3">
                  <label for="pass" class="form-label">Password</label>
                  <input type="password" autocomplete="off" placeholder="enter your password" class="form-control" name="pass" required>
                </div>
                <div class="mb-3">
                  <label for="cpass" class="form-label">Confirm Password</label>
                  <input type="password"  placeholder="confirm password" class="form-control" name="cpass" required>
                </div>
                <div class="form-group">
                  <label for="image">Upload Profile Pic</label>
                  <div class="custom-file">
                    <input type="file" name="upload_image" class="custom-file-input" id="image" required>
                    <label for="image" class="custom-file-label">Choose File</label>
                  </div>
                  <small class="form-text text-muted">Max Size 3mb</small>
	            </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role" id="role">
                        <option selected>Select Role</option>
                        <option value="1">Administrator</option>
                        <option value="2">Manager</option>
                        <option value="3">Writer</option>
                        <option value="3">Translator</option>
                    </select>
                </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              
              <input type="submit" value="Add User" class="btn btn-primary" name="adduser">
            </div>

            </form>
          </div>
        </div>
      </div>
      <!-- Add User Modal END-->

      <div class="table-responsive">

        <?php

        //PDO
        $get_users = $conn->prepare("SELECT * FROM `users`");
        $get_users->execute();
        $fetch_users = $get_users->fetch(PDO::FETCH_ASSOC);

        ?>
          
        <table class="table table-striped table-sm">

          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Image</th>
              <th scope="col">User</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Date</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <!-- get users -->
			<?php

            

            //get size of the fetch result
            $count = $get_users->rowCount();
            // echo $get_users->rowCount();
            $i = 1;
            for($i = 1; $i < ($count +1);  $i++) {

                
            }


            ?>
            <tr>
                
              <td><?php echo $i; ?></td>
              <td>
                  
                  <img src="../uploads/images/<?= $fetch_users['image']; ?>" class="rounded-circle" alt="Profile Image" width="25" height="25">
                </td>
              <td><?= $fetch_users['username']; ?></td>
              <td><?= $fetch_users['name']; ?></td>
              <td><?= $fetch_users['email']; ?></td>
              <td><?= $fetch_users['role']; ?></td>
              <td><?= $fetch_users['created_on']; ?></td>
              <td>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editusermodal">
                    <i class="fas fa-edit"></i>
                </button>
              </td>
              <td>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteusermodal">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
              </td>

              <?php //} ?>
            </tr>
            
          </tbody>
        </table>
      </div>
 </div>

 <!-- Edit User Modal -->
 <div class="modal fade" id="editusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editusermodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <!-- form -->
              <form action="post">
            <div class="modal-header">
              <h5 class="modal-title" id="editusermodalLabel">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <div class="mb-3">
                  <label for="uname" class="form-label">Username</label>
                  <input type="text" class="form-control" id="uname" placeholder="" value="<?= $fetch_users['username']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="" value="<?= $fetch_users['name']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="image">Old Profile Pic</label>
                  <div class="custom-file">
                    <input type="hidden" name="old_image" value="<?= $fetch_users['image']; ?>">
                    <input type="file" name="upload_image" class="custom-file-input" accept="image/jpg, image/jpeg, image/png">
                  </div>
	              </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" id="role" disabled>
                        <option selected><?= $fetch_users['role']; ?></option>
                        <option value="1">Administrator</option>
                        <option value="2">Manager</option>
                        <option value="3">Writer</option>
                        <option value="3">Translator</option>
                    </select>
                </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              
              <input type="submit" value="Edit User" class="btn btn-primary" name="submit">
            </div>

            </form>
          </div>
        </div>
      </div>
      <!-- Edit User Modal END-->


      <!-- DELETE User Modal -->
        <div class="modal fade" id="deleteusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteusermodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- form -->
                    <form action="post">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteusermodalLabel">Delete <?= $fetch_users['username']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="mb-3">
                            <label for="uname" class="form-label">Are you show you want to delete <?= $fetch_users['username']; ?></label>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                    <input type="submit" value="Delete User" class="btn btn-danger" name="submit">
                    </div>

                    </form>
                </div>
                </div>
            </div>
      <!-- DELETE User Modal END-->


      
  </main>

 



   


<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/fa0f4f5b37.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
