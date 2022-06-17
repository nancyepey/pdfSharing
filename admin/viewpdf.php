<?php

include '../config.php';
include_once 'functions.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['id'];
$username = $_SESSION['name'];


// getting cat id to add pdf
$get_cat = 0;

if (isset($_GET['cat_id'])) {
  $get_cat = $_GET['cat_id'];
} else {

  $get_cat = 9;
}


if(!isset($user_id)){
   header('location:../login.php');
}


if(isset($_POST['savepdf'])) {
  //
  echo "inside save pdf";
  $message[] = "inside save pdf";
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




// test
// getting the last id 
// echo wopslatestyearid();
 

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

      .wrapper{
        width: 130px;
        background: #fff;
        border-radius: 5px;
        padding: 30px;
        /* box-shadow: 7px 7px 12px rgba(0,0,0,0.05); */
      }
      .pdfsharegrid {
        display: grid;
        grid-template-columns: auto auto;
      }
      .griditem {
        padding: 5px;
        margin-top: 10px;
      }
      .wrapper form{
        height: 20px;
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 5px;
        border: 2px dashed #6990F2;
      }
      form :where(i, button){
        color: #6990F2;
      }
      form i{
        font-size: 50px;
      }
      form button{
        margin-top: 2px;
        font-size: 16px;
      }

    </style>

<!-- ✅ load jQuery ✅ -->
<!-- <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>

$('#addpdfform').on('submit', function(e) {
    console.log("in add pdf form new")
      e.preventDefault();
      var form=document.getElementById('addpdfform');
      var fdata=new FormData(form); 
      $.ajax({
          type: "POST",
          url: 'add_pdf.php',
          data: fdata,
          contentType: false,
          cache: false,
          processData:false,
          success: function(result)
          { 
              if(result == 0)
              {
                  alert('file stored');
              }else{
                  alert('something went wrong');
              }
          }
      });
  });

</script> -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
$( document ).ready(function() {
   console.log( "document loaded" );
   
 });



 // get data from pdf modal
 $("#savepdf").click(function() {
  console.log( "savepdf modal clicked" );
 });



 //save pdf
 function savepdf() {
  
  console.log( "Add File click" );

  var pdffile = $("#upload_pdf").val();
  var catpdf  = $("#catpdf").val();
  var month   = $("#monthpdf").val();

  if(pdffile == '' || catpdf == '' || month == '') {
    alert("Please fill all fields." + pdffile +' '+ catpdf +' '+ month)
    return false;
  }
  // uploadFile();

  const sample_image = document.getElementsByName('upload_pdf')[0];
  console.log(sample_image);
  console.log(sample_image.files[0]);
  // upload_image(sample_image.files[0]);

  const form_data = new FormData();
  form_data.append('sample_image', sample_image.files[0]);
  form_data.append('pdffile', pdffile);
  form_data.append('catpdf', catpdf);
  form_data.append('month', month);

  console.log(form_data);
  // Display the key/value pairs
  for (var pair of form_data.entries()) {
      console.log(pair[0]+ ', ' + pair[1]); 
  }

  // await fetch('/uploadfile.php', {
  //   method: "POST", 
  //   body: form_data
  // }); 
  // alert('The file has been uploaded successfully.');
  
  

  $.ajax({
    type: "POST",
    url: "add_pdf.php",
    data: form_data,
    // data: {
    //   pdffile  : pdffile,
    //   catpdf   : catpdf,
    //   month    : month,
    //   sample_image   : sample_image.files[0]
    // },
    cache: false,
    processData: false,
    contentType: false,
    success: function(data) {
      // console.log(data);
      alert("fields: " + pdffile +' '+ catpdf +' '+ month)
      // alert(data)
      console.log("send pdf details");
      // console.log(data);
      $(".seeresultstest").html(data);
      $('#addpdfmodal').modal('hide');
    },
    error: function(xhr, status, error) {
        console.error(xhr);
        $('#addpdfmodal').modal('hide');
    }
  });


  // console.log(document.getElementById('addpdfform'));

  // var form  = $('form.addpdfform').serialize();
  // console.log(form);
  // var fdata = new FormData(form);
  // console.log(fdata);

  // $.ajax({
  //     type: "POST",
  //     url: 'add_pdf.php',
  //     data: fdata,
  //     contentType: false,
  //     cache: false,
  //     processData:false,
  //     success: function(result)
  //     { 
  //         if(result == 0)
  //         {
  //             alert('file stored');
  //         }else{
  //             alert('something went wrong');
  //         }
  //     }
  // });

  // console.log( "Save pdf click" );

 }


 //populate add pdf modal  
 function addpdf(id_month, id_cat, username) {
  //  
  console.log( "Add PDF modal clicked" );
   
 
 console.log(id_month, id_cat, username);
 $.ajax({url: "add_pdf.php",
   method:'post',
   data:{month_id:id_month, cat_id:id_cat, uname:username},
     success: function(result){
      //  console.log(result);
      console.log("SUCCESS");
    //  $(".addpdfbody").html(result);
     $(".addpdfbody").append(result);
   }})
   .done(function(data) {  
      // console.log("test: ", data);
      console.log("DONE");
    })
    .fail(function(data) {
      // console.log("error: ", data);
      console.log("ERROR");
    });

 }


</script>
   

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
                  <i class="fas fa-times" style="color:red;" onclick="this.parentElement.remove();"></i>
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
      

      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcatmodal">
        + Category
      </button>
      <p class="seeresultstest">
        
        
        <?php //echo $username; echo $user_id; ?>
      </p>

      <!-- Add PDF Modal -->
      <div class="modal fade" id="addpdfmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addpdfmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addpdfmodalLabel">Add File</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body addpdfbody">
              <!-- form -->
              <form id="addpdfform" class="addpdfform" action="" method="post"  enctype="multipart/form-data" >
                <div class="form-group mb-2">
                    <label for="file">Upload PDF</label>
                    <div class="custom-file">
                      <input type="file" id="upload_pdf" name="upload_pdf">
                      <label for="file" class="custom-file-label">Choose File</label>
                    </div>
                </div>
                <!-- <div class="mb-3">
                  <label for="name" class="form-label">Title</label>
                  <input type="text" class="form-control" id="name" placeholder="">
                </div> -->
                <!-- <div class="form-group mb-2">
                  <label for="file">Upload PDF</label>
                  <div class="custom-file">
                    <input type="file" name="upload_file" class="custom-file-input" id="file">
                    <label for="file" class="custom-file-label">Choose File</label>
                  </div>
	              </div>
                <div class="mb-3">
                  <div class="col-auto">
                    <label for="inputcategory" class="col-form-label">Category</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-select form-control" name="category" aria-label="category select">
                      <option selected>Select Category</option>
                     
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" rows="2"></textarea>
                </div> -->
                <!-- <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" rows="2"></textarea>
                </div>  -->
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary" >Add File</button> -->
              <input type="submit" onclick="savepdf()" value="Add File" class="btn btn-primary" name="savepdf">
              <!-- <input type="submit" id="addpdfform" value="Add File" class="btn btn-primary" name="savepdf"> -->
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
  
  <div class="pdfsharegrid">
    <!--  -->
    <div class="griditem">
      <!-- contains the ategories -->
      <ul class="nav flex-column mt-3">
      <?php

        ?>
        <li class="nav-item">
          <a class="nav-link" style="font-size:larger;" href="#">white oils price structure</a>
        </li>
         <?php
        
          // getting the categories groupe = 'white oils price structure'
          $get_catsen_query = "SELECT * FROM category WHERE groupe = 'white oils price structure' ORDER BY year DESC ";
          $get_catsen = mysqli_query($conn, $get_catsen_query);
          $i = 1;

          while($row = mysqli_fetch_assoc($get_catsen)) {
            // category table
            $cat_id = $row['id'];
            $cat_name = $row['name'];
            $cat_group = $row['groupe'];
            $cat_year = $row['year'];
            $cat_createdby = $row['createdby'];
            $cat_createdon = $row['created_on'];
            $cat_updatedon = $row['updated_on'];

            // if($cat_group == "white oils price structure") {
            //   $showgroup = "<h6>EN PDF</h6>";
            // } elseif($cat_group == "structure des prix produits blanc") {
            //   $showgroup = "<h6>FR PDF</h6>";
            // }

          
          ?>
          
          <?php 

          if($cat_group == "white oils price structure") {
            
            echo '<li class="nav-item">
                    <a class="nav-link " style="color:black;" aria-current="page" href="?cat_id='. $cat_id.'">'.$cat_name.'</a>
                  </li>';
          }

           ?>
           <?php } ?>
          
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#" style="font-size:larger;">structure des prix produits blanc</a>
          </li>
          <?php
        
          // getting the categories groupe = 'structure des prix produits blanc'
          $get_catsfr_query = "SELECT * FROM category WHERE groupe = 'structure des prix produits blanc' ORDER BY year DESC ";
          $get_catsfr = mysqli_query($conn, $get_catsfr_query);
          $i = 1;

          while($row = mysqli_fetch_assoc($get_catsfr)) {
            // category table
            $cat_id = $row['id'];
            $cat_name = $row['name'];
            $cat_group = $row['groupe'];
            $cat_year = $row['year'];
            $cat_createdby = $row['createdby'];
            $cat_createdon = $row['created_on'];
            $cat_updatedon = $row['updated_on'];

            // if($cat_group == "white oils price structure") {
            //   $showgroup = "<h6>EN PDF</h6>";
            // } elseif($cat_group == "structure des prix produits blanc") {
            //   $showgroup = "<h6>FR PDF</h6>";
            // }

          
          ?>
          
          <?php 

         
            
            echo '<li class="nav-item">
                    <a class="nav-link " style="color:black;" aria-current="page" href="?cat_id='. $cat_id.'">'.$cat_name.'</a>
                  </li>';
   

           ?>
           <?php } ?>
          <?php ?>
        </ul>
     </div>
     <div class="griditem">
       <!-- pdfs -->
       <div class="row">
         <?php
            //loop thro different months
            $months = [
              "JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
            ];
            foreach ($months as $month) {

              $month_index = array_search($month, $months);
  
            
         ?>

       <div class="col-md-3">

        <?php
          $mons = [
            "January", 
            "February", 
            "March", 
            "April", 
            "May", 
            "June", 
            "July", 
            "August", 
            "September", 
            "October", 
            "November", 
            "December"
          ];
          echo $mons[$month_index];
          //getting docs
          
          $doc_query = "SELECT * FROM document WHERE month = '{$mons[$month_index]}' AND category_ID = '{$get_cat}'";
          $get_doc = mysqli_query($conn, $doc_query);
          

          if(mysqli_num_rows($get_doc)) {

          
        ?>
          <a href="#"><img src="../uploads/images/pdfimg.png" width="90px"  alt="pdf image"></a>
        <?php 
          
            
          } else {
        ?>

         <div class="wrapper">
            <form action="#">
              <input class="file-input" type="file" name="file" hidden>
              <i class="fas fa-cloud-upload-alt"></i>
              
              <button type="button" onclick="addpdf('<?php echo $month_index; ?>', '<?php echo $get_cat; ?>', '<?php echo $user_id; ?>' )" class="btn monthmodal" data-id="<?=  $month; ?>" data-bs-toggle="modal" data-bs-target="#addpdfmodal">
              <?php echo $month; ?>
              </button>
            </form>
          </div>
          <?php 
          
            
          }
        ?>

       </div>

          <?php } ?>

       </div>
       <!-- end months -->
     </div>
    </div>

 </div>

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
      
  </main>

  <script>
    
</script>
 


  <script>

    // function openCity(evt, cityName) {
    //   var i, tabcontent, tablinks;
    //   tabcontent = document.getElementsByClassName("tabcontent");
    //   for (i = 0; i < tabcontent.length; i++) {
    //     tabcontent[i].style.display = "none";
    //   }
    //   tablinks = document.getElementsByClassName("tablinks");
    //   for (i = 0; i < tablinks.length; i++) {
    //     tablinks[i].className = tablinks[i].className.replace(" active", "");
    //   }
    //   document.getElementById(cityName).style.display = "block";
    //   evt.currentTarget.className += " active";
    // }

    // // Get the element with id="defaultOpen" and click on it
    // // document.getElementById("defaultOpen").click();

    // // on clik trash icon    
    // $('.monthmodal').click(function(){
    //     //get cover id
    //     var id=$(this).data('id');
    //     //set href for cancel button
    //     $('#addpdfmodal').attr('href','add_pdf.php?id='+id);
    // });

  </script>
   


<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
