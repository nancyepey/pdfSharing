<?php

include 'config.php';
include 'admin/functions.php';

session_start();

if(isset($_SESSION['id'])){
    header('location:admin/main.php');
 }

// if(isset($_POST['submit'])){

//    $email = $_POST['email'];
//    $email = filter_var($email, FILTER_SANITIZE_STRING);
//    $pass = md5($_POST['pass']);
//    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

//    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
//    $select->execute([$email, $pass]);
//    $row = $select->fetch(PDO::FETCH_ASSOC);

//    if($select->rowCount() > 0){

//       if($row['role'] == 'admin'){

//          $_SESSION['admin_id'] = $row['id'];
//          header('location:admin/dashboard.php');

//       }
    //   elseif($row['role'] == 'user'){

    //      $_SESSION['user_id'] = $row['id'];
    //      header('location:user_page.php');
      //}

//       elseif($row['role'] == 'manager'){

//         $_SESSION['user_id'] = $row['id'];
//         header('location:admin/dashboard.php');

//      }else{
//          $message[] = 'no user found!';
//       }
      
//    }else{
//       $message[] = 'incorrect email or password!';
//    }

// }


// if(isset($_POST['submit'])){

   

//    //getting the email
//    $email = escape($_POST['email']);

//    $pass = escape(md5($_POST['pass']));


//    //getting up some validations
//    if(empty($email)) {
//        $message[] = "Email Can not be empty";
//    } elseif (empty($pass)) {

//        $message[] = "Password Can not be empty";

//    } else {

//       //find user
//       $query = "SELECT * FROM users WHERE email= $email ";
//       $get_user= mysqli_query($conn, $query);

//       if($get_user){

//          while($row = mysqli_fetch_assoc($get_user)) {
//             if($row['role'] == 'superadmin'){

//                $_SESSION['admin_id'] = $row['id'];
//                header('location:admin/dashboard.php');
      
//             }
      
//             elseif($row['role'] == 'admin'){

//                $_SESSION['admin_id'] = $row['id'];
//                header('location:admin/dashboard.php');
      
//            }
      
//             elseif($row['role'] == 'manager'){
      
//               $_SESSION['user_id'] = $row['id'];
//               header('location:admin/dashboard.php');
      
//            }
//            else{
//                $message[] = 'no user found!';
//             }
//          }

//       } else{
//          $message[] = 'incorrect email or password!';
//       }

//    }

// }


//this fucntion is to check for 4 method
//setting default argument as null by 
function ifItIsMethod($method) {

   //checking if we get $_SERVER['REQUEST_METHOD'] ie a request method
   if($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
       return true;
   }

   return false;

}


//this function is to redirect user to any location set in
// function redirect($location) {

//    // return header("Location:" . $location);
//    //not using return
//    header("Location:" . $location);
//    //we will just exist this
//    exist;

// }
   

if(ifItIsMethod('post')) {

	//checking if form variables or values are set
	if(isset($_POST['username']) && isset($_POST['pass'])) {

      //check if the code runs here
      //$message[] = 'CHECK PASSED';

		//if everything is set
		//use login_user fxn to login the user
		login_user($_POST['username'],$_POST['pass']);

	} else {
		//redirecting using fxn redirect
		redirect('login.php');
	}

}  
 



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

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
   
<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login now</h3>
      <input type="text" required placeholder="enter username" class="box" name="username">
      <input type="password" required placeholder="enter your password" class="box" name="pass">
      <p>don't have an account? <a href="register.php">register now</a></p>
      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>

</body>
</html>

<?php




?>