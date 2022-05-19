<?php

include '../config.php';
include_once 'functions.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['id'];

if(!isset($user_id)){
   header('location:../login.php');
}



 if(isset($_POST['adduser'])) {

  //getting the name
  $name = escape($_POST['name']);

  //getting the username
  $username = escape($_POST['uname']);

  //getting the email
  $email = escape($_POST['email']);

  //getting the password
  $pass = md5(escape($_POST['pass']));

  //getting the confirm password
  $cpass = md5(escape($_POST['cpass']));

  //getting the role
  $role = escape($_POST['role']);

  //getting the state status
  $user_status = intval(escape($_POST['status']));

  //assigning the date() fxn to the user date variable and passing the format or assigning the format d-m-y
  //$user_created_on = date('d-m-y');
  //$user_updated_on = date('d-m-y');


  //for datetime
  date_default_timezone_set("Africa/Douala"); //to specify time with respect to my zone
  $CurrentTime =time(); //current time in seconds
  //strftime is string format time
  //$DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime); //mostly use when we have to apply sql format
  $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime); 
  $user_created_on = $DateTime;
  $user_updated_on = $DateTime;

  //checking if the user exist
  // $check_user_query = "SELECT * FROM users WHERE username = $username ";
  // $check_user = mysqli_query($conn, $check_user_query);
  //Get the number of rows in the result set
  // $user_exist = mysqli_num_rows($check_user);
  //
  $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['uname']."'");
  // if(mysqli_num_rows($check_user)) {
  //     exit('This username already exists');
  // }


  //getting up some validations
  if(empty($name)) {
      $message[] = "Name Can not be empty";
  }elseif (empty($username)) {

      $message[] = "Username Can not be empty";

  }elseif (empty($email)) {

      $message[] = "Email Can not be empty";

  }elseif (empty($pass)) {

    $message[] = "Password Can not be empty";

  }elseif (empty($cpass)) {

    $message[] = "Confirm Password Can not be empty";

  }elseif (empty($role)) {

      $message[] = "Role Can not be empty";

  }elseif (empty($user_status)) {

    $message[] = "Status Can not be empty";

  }elseif ($pass != $cpass) {

    $message[] = "confirm password not matched!";

  }elseif (mysqli_num_rows($check_user)) {

  $message[] = "User Already Exist!";

  }else {


      //getting media

      //setting defaults
      $file_image = '';


      //getting the image
      // File upload path
      $targetDir_img = "../uploads/images/";
      // $file_image = basename($_FILES["file"]["name"]);
      // $file_image = basename($_FILES["image"]["name"]);
      $file_image = basename(escape($_FILES['upload_image']['name']));
      $targetFilePath_img = $targetDir_img . $file_image;
      $fileType_img = pathinfo($targetFilePath_img,PATHINFO_EXTENSION);

      if(!empty($_FILES["upload_image"]["name"])) {
          // Allow certain file formats IMAGES
          $allowTypes_img = array('jpg','png','jpeg','gif');
           //
          if(in_array($fileType_img, $allowTypes_img)){
              // Upload file to server
              if(move_uploaded_file($_FILES["upload_image"]["tmp_name"], $targetFilePath_img)){

                  //query to add post
                  $query = "INSERT INTO users(username, name, email, password, role, image, active, updated_on)";
                  
                  //for date we are not sending a value but we are sending a function
                  $query .= "VALUES('{$username}' ,'{$name}', '{$email}','{$cpass}', '{$role}', '{$file_image}','{$user_status}', '{$user_updated_on}')";
                  
                  //sending the query to the database
                  $create_user_query = mysqli_query($conn, $query);

                  confirmQuery($create_user_query);

                  //getting the id
                  $user_id = mysqli_insert_id($conn);


                  if($create_user_query){
                      // $message[] = "The file ".$file_image. " has been uploaded successfully.";
                      $message[] = "<p class='bg-primary' style='text-align:center;'> <span style='text-transform:capitalize; color:orange;'>{$name}</span> User was Created Sucessfully.</p>";
                      
                  }else{
                      $message[] = "File upload failed, please try again.";
                  } 
              }else{
                  $message[] = "Sorry, there was an error uploading your file.";
              }
          }else{
              $message[] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
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

  
    
  <?php include '../includes/header.php'; ?>

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
                    <input type="file" name="upload_image" class="custom-file-input" id="image" name="upload_image" required>
                    <label for="image" class="custom-file-label">Choose File</label>
                  </div>
                  <small class="form-text text-muted">Max Size 3mb</small>
	            </div>
                <div class="mb-3 mt-2">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role" id="role">
                        <option selected>Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="manager">Manager</option>
                        <option value="writer">Writer</option>
                        <option value="translator">Translator</option>
                    </select>
                </div>
                <!-- <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option selected>Select</option>
                        <option value="1">Active</option>
                        <option value="0">Disabled</option>
                    </select>
                </div> -->
                <div class="mb-3 form-check">
                  <input type="hidden" name="status" value="0">
                  <input type="checkbox" class="form-check-input" id="status" name="status" value="1">
                  
                  <label class="form-check-label" for="status">Active</label>
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
        // $get_users = $conn->prepare("SELECT * FROM `users`");
        // $get_users->execute();
        // $fetch_users = $get_users->fetch(PDO::FETCH_ASSOC);

        $get_users_query = "SELECT * FROM users ";
        $get_users = mysqli_query($conn, $get_users_query);

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
              <th scope="col">Status</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <!-- get users -->
			<?php

            

            //get size of the fetch result
            //$count = $get_users->rowCount();
            // echo $get_users->rowCount();
            $i = 1;
            //we need to values using a while loop
            while($row = mysqli_fetch_assoc($get_users)) {

              //users table
              $user_id            = $row['id'];
              $user_uname         = $row['username'];
              $user_name          = $row['name'];
              $user_email         = $row['email'];
              $user_role          = $row['role'];
              $user_image         = $row['image'];
              $user_status         = $row['active'];
              $user_date          = $row['created_on'];


            ?>
            <tr>
                
              <td><?php echo $i; ?></td>
              <td>
                  
                  <img src="../uploads/images/<?= $user_image; ?>" class="rounded-circle" alt="Profile Image" width="25" height="25">
                </td>
              <td><?= $user_uname; ?></td>
              <td><?= $user_name; ?></td>
              <td><?= $user_email; ?></td>
              <td><?= $user_role; ?></td>
              <td><?= $user_date; ?></td>
              <td>
              
                
                <?php

                  if ($user_status) {
                    echo '<i class="fa-solid fa-check" style="color:red;"></i>';
                  } else {
                    echo '<i class="fa-solid fa-xmark" style="color:green;"></i>';
                  }
                 

                ?>
                
              </td>
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

              <?php 
                $i++;
                } 
              ?>
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
                  <input type="text" class="form-control" id="uname" placeholder="" value="<?= $user_uname; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="" value="<?= $user_name; ?>" required>
                </div>
                <div class="form-group">
                  <label for="image">Old Profile Pic</label>
                  <div class="custom-file">
                    <input type="hidden" name="old_image" value="<?= $user_image; ?>">
                    <input type="file" name="upload_image" class="custom-file-input" accept="image/jpg, image/jpeg, image/png">
                  </div>
	              </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" id="role" disabled>
                        <option selected><?= $user_role; ?></option>
                        <option value="1">Administrator</option>
                        <option value="2">Manager</option>
                        <option value="3">Writer</option>
                        <option value="3">Translator</option>
                    </select>
                </div>
                <div class="mb-3 form-check">
                  <input type="hidden" name="status" value="0">
                  <input type="checkbox" class="form-check-input" id="status" name="status"  value="1" >
                  
                  <label class="form-check-label" for="status">Active</label>
                </div>
                <!-- <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>
                </div> -->
             
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
                    <h5 class="modal-title" id="deleteusermodalLabel">Delete <?= $user_uname; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="mb-3">
                            <label for="uname" class="form-label">Are you show you want to delete user "<?= $user_uname; ?>"</label>
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
