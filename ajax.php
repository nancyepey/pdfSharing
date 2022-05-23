<?php


$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
  
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
  
if (!file_exists('uploads'images)) {
    mkdir('uploads'images, 0777);
}
  
$filename = time().'_'.$_FILES['file']['name'];
  
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/images'.$filename);
  
echo 'uploads/images'.$filename;
die;

// $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
  
// if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
//     echo "false";
//     return;
// }
  
// if (!file_exists('uploads'images)) {
//     mkdir('uploads'images, 0777);
// }
  
// $filename = time().'_'.$_FILES['file']['name'];
  
// move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/images'.$filename);
  
// echo 'uploads/images'.$filename;
// die;

?>