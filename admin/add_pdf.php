<?php


include '../config.php';


?>

<?php

session_start();

           
$uname =  $_SESSION['name'] ;


// adding pdf into database
if(isset($_POST["pdffile"]))
{

  //get data
  $pdffile = mysqli_real_escape_string($conn, $_POST['pdffile']);
  $catpdf = mysqli_real_escape_string($conn, $_POST['catpdf']);
  $monthpdf = mysqli_real_escape_string($conn, $_POST['month']);
  $username = $uname;

  //for datetime
  date_default_timezone_set("Africa/Douala"); //to specify time with respect to my zone
  $CurrentTime =time(); //current time in seconds
  $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime); 
  $updated_on = $DateTime;
  echo "inside post pdffile ";

  // STORE PDF FILE IN FOLDER
  if(isset($_POST["pdffile"]['name']))
  {
      echo "inside file set"; 
      
      //getting the image
      // File upload path
      // $cpath="../uploads/pdfs/";
      // $file_parts = pathinfo($_FILES["upload_pdf"]["name"]);
      // $file_name = basename(escape($_FILES['upload_pdf']['name']));
      // $file_path = $file_name.time().'.'.$file_parts['extension'];
      // move_uploaded_file($_FILES["upload_pdf"]["tmp_name"], $cpath.$file_path);
      // $file_pdf = $file_path;

      // save pdf in db
      // $query = "INSERT INTO document(pdf, month, category_id, added_by, updated_on) VALUES('$file_pdf' ,'$monthpdf', '$catpdf', '$username', '$updated_on')";
      // $savepdf_query = mysqli_query($conn, $query);
      // if($savepdf_query) {
      //   $message[] = "PDF File added successfully";
      // } else {
      //   $message[] = "Please try again an error occured!";
      // }
  } else {
    echo "no file set";
    
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
              <div class="form-group mb-2">
                  <label for="file">Upload PDF</label>
                  <div class="custom-file">
                    <input type="file" id="uploadpdf" name="upload_pdf" class="custom-file-input" id="file">
                    <label for="file" class="custom-file-label">Choose File</label>
                  </div>
	             </div>
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


<!-- Modal -->
<!-- <div class="modal fade" id="addpdfmodal" role="dialog">
  <div class="modal-dialog">
  
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add File</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div> -->