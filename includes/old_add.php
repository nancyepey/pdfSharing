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
