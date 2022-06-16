<?php


include '../config.php';
include_once 'functions.php';


?>

<?php

session_start();

           
$uname =  $_SESSION['name'] ;


// adding pdf into database
// if(isset($_POST["pdffile"]))
if(isset($_FILES['sample_image']['name']))
{
  // echo "inside";
  //get data
  $pdffile = mysqli_real_escape_string($conn, $_POST['pdffile']);
  $catpdf = mysqli_real_escape_string($conn, $_POST['catpdf']);
  $monthpdf = mysqli_real_escape_string($conn, $_POST['month']);
  $username = $uname;
  // echo $username;
  

  // get pdf name
  $str_arr = explode ("\\", $pdffile); 
  // echo $str_arr[4];
  $file_pdf = $str_arr[4];
  // echo " ";
  // print_r(array_values($str_arr));

  //for datetime
  date_default_timezone_set("Africa/Douala"); //to specify time with respect to my zone
  $CurrentTime =time(); //current time in seconds
  $DateTime = strftime("%m-%d-%Y %H:%M:%S",$CurrentTime); 
  $updated_on = $DateTime;
  // echo "inside post pdffile ";
  // echo $pdffile;

  // STORE PDF FILE IN FOLDER
 
  // echo "inside file set";
  
  $extension = pathinfo($_FILES['sample_image']['name'], PATHINFO_EXTENSION);

  // $new_name = time() . '.' . $extension;
  $filename = $_FILES['sample_image']['name'];

  move_uploaded_file($_FILES['sample_image']['tmp_name'], '../uploads/pdfs/' . $filename);

  // echo $file_name;
  // echo "inside files";
  $data = array(
    'image_source'		=>	'' . $username
  );

  // echo json_encode($data);


  
  // getting the image
  // File upload path
  // $cpath="./uploads/";
  // $file_parts = pathinfo($_FILES["sample_image"]["name"]);
  // $file_name = basename(escape($_FILES['sample_image']['name']));
  // $file_path = $file_name.time().'.'.$file_parts['extension'];
  // move_uploaded_file($_FILES["sample_image"]["tmp_name"], $cpath.$file_path);
  // $file_pdf = $file_path;

  // save pdf in db
  $query = "INSERT INTO document(pdf, month, category_id, added_by, updated_on) VALUES('$filename' ,'$monthpdf', '$catpdf', '$username', '$updated_on')";
  $savepdf_query = mysqli_query($conn, $query);
  if($savepdf_query) {
    $message[] = "PDF File added successfully";
    echo "PDF File added successfully";
  } else {
    $message[] = "Please try again an error occured!";
    echo "Please try again an error occured!";
  }
 



}



// automatically filling info in add pdf modal
if(isset($_POST["month_id"]))  
{

    $form = '';

    $monthNum  = $_POST["month_id"] + 1;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');

    $category_id = $_POST["cat_id"];

    // getting the categories
    $get_catss_query = "SELECT * FROM category WHERE id = '$category_id' ";
    $get_catss = mysqli_query($conn, $get_catss_query);
    while($row = mysqli_fetch_assoc($get_catss)) {
      // getting row values
      $ct_id = $row['id'];
      $ct_name = $row['name']; 



    $form .= '
              
                <div class="mb-3">
                  <div class="col-auto">
                    <label for="inputcategory" class="col-form-label">Category</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-select form-control" id="catpdf" name="category" aria-label="Disabled category select" disabled>
                      <option value="'.$ct_id .'" selected>'.$ct_name.'</option>
                      <option value="'.$ct_id .'">'. $ct_name. '</option>
                      </select>
                    </div>
                </div>
                <div class="mb-3">
                <label for="month" class="form-label">Month</label>
                <input type="text" class="form-control" id="monthpdf" name="month" value="'.$monthName.'" required disabled>
            </div>
    ';

    }  


    echo $form;



}


?>


