
<?php

ob_start();
include '../config.php';
include_once 'functions.php';
session_start();

?>

<?php


if(isset($_GET['a_id'])){
    // if(isset($_GET['val'])){
    
        $currentuser = $username;
        $currentuserrole = $_SESSION['role'];
        
        // if($currentuserrole != "translator" || $currentuserrole != "admin")
        if($currentuserrole != "admin") {
            
            // echo "<script type='text/javascript'>
            //         console.log('inside');
            //         alert(".$lang['onlytranslator'].");
            //     </script>";
            redirect('./dashboard.php');
        }
        // echo "<script type='text/javascript'>
        //             console.log('inside');
        //             alert('only authorized group of users');
        //         </script>";
    
        // $content_fr = '';
        // $content_en = '';
        // $vid = $_GET['val'];
        $val = $_GET['a_id'];
    
        $new_thumb          = "defaultpic.jpg";
        $new_tten           = "";
        $new_ttfr           = "";
        $new_cnfr           = "";
        $new_cnen           = "";
        $new_sdfr           = "";
        $new_sden           = "";
        $new_state          = "";
        $new_valid          = "";
        $new_author         = "";
        $new_translator     = "";
        
        //get data from db
        $getdata_query = "SELECT * FROM news WHERE id = '{$val}' ";
        //sending the query to the database
        $getdata = mysqli_query($conn, $getdata_query);
        
        // check query
        confirmQuery($getdata);
        while($row = mysqli_fetch_assoc($getdata)) {
            //news table
            $new_id             = $row['id'];
            $new_thumb          = $row['thumbnail'];
            $new_tten           = $row['title_en'];
            $new_ttfr           = $row['title_fr'];
            $new_cnfr           = $row['content_fr'];
            $new_cnen           = $row['content_en'];
            $new_sdfr           = $row['short_desc_fr'];
            $new_sden           = $row['short_desc_en'];
            $new_state          = $row['state'];
            $new_valid          = $row['validated'];
            $new_author         = $row['author'];
            $new_translator     = $row['translator'];
    
            if($new_valid == 1) {
                // news already validated
                redirect('./articles.php');
            }
        
            
        }
    
    // alert(".$lang['onlytranslator'].");
        // echo "<script>
        //      $(window).load(function(){
        //          $('#thankyouModal').modal('show');
        //      });
        // </script>";
        } 
        else {
            // redirect
            redirect('./dashboard.php');
    }


          
if(isset($_POST['validate'])) {
    // $message[] =  "hI";
    

    // getting the data from form
    $entitle    = escape($_POST['title']);
    $enshortdesc    = escape($_POST['short_desc']);
    $long_desc    = escape($_POST['content']);
    // $statepubselect    = escape($_POST['pubselect']);
    $frtitre    = escape($_POST['titlefr']);
    $frshortdesc    = escape($_POST['short_descfr']);
    $frlong_desc    = escape($_POST['contentFR']);
    // $status    = escape($_POST['status']);

    //getting up some validations
    if(empty($entitle)) {

        $message[] = "Title Can not be empty (EN)";

    }elseif (empty($enshortdesc)) {

        $message[] = "Short Description Can not be empty (EN)";

    }elseif (empty($long_desc)) {

        $message[] = "Content Can not be empty (EN)";

    }elseif (empty($frtitre)) {

        $message[] = "Titre Can not be empty (FR)";

    }elseif (empty($frshortdesc)) {

        $message[] = "Short Description Can not be empty (FR)";

    }
    
    elseif (empty($frlong_desc)) {

        $message[] = "Content Can not be empty (FR)";

    } else {
        // all field filled
        // current time
        date_default_timezone_set("Africa/Douala"); //to specify time with respect to my zone
        $CurrentTime =time(); //current time in seconds
        $validated_on = strftime("%m-%d-%Y %H:%M:%S",$CurrentTime); 

        // get thumbnail image
        if (isset($_FILES['thumbnail']['name'])) {

            // $filename = $_FILES['thumbnail']['name'];
            /* Getting file name */
            $filename = $_FILES['thumbnail']['name'];
        
            /* Location */
            $location = "uploads/images/".$filename;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
        
            /* Valid extensions */
            $valid_extensions = array("jpg","jpeg","png");

            /* Check file extension */
            if(in_array(strtolower($imageFileType), $valid_extensions)) {
                /* Upload file */
                // Upload file to server
                if(move_uploaded_file($_FILES['thumbnail']['tmp_name'],$location)){
                    // 
                    $filename = $_FILES['thumbnail']['name'];
                } else {
                    $message[] =  'error uploading file';
                }
            } else {
                $message[] =  'error uploading file';
            }
        
        } else {
            $filename = $new_thumb;

        }

        
        // $message[] = "inside";
       
        $validated = 1;
        $translator = $currentuser;
           
        // $response = $location;
        /* query to validate article by putting their new values */
        // $articlevalidate_query = "UPDATE articles SET en_title = '{$entitle}', fr_title = '{$frtitre}', content_en = '{$long_desc}', content_fr = '{$frlong_desc}', short_desc_en = '{$enshortdesc}', short_desc_fr = '{$frshortdesc}',  validated = 1, translator = '{$translator}', validation_date = '{$validated_on}' ";
        
        $articlevalidate_query = "UPDATE news SET  validated = '{$validated}', translator = '{$translator}', validation_date = '{$validated_on}' WHERE id = '{$val}' ";

        // $articlevalidate_query .= " WHERE id = '{$vid}'";
        

        //sending the query to the database
        $validate_new_query = mysqli_query($conn, $articlevalidate_query);

        // check query
        confirmQuery($validate_new_query);

        //getting the id
        $new_id = mysqli_insert_id($conn);

        if(!isset($lg_switch)) {
            $lg_switch = "en";
        }

        // show message
        if($validate_new_query){
            // $message[] = "The file ".$file_image. " has been uploaded successfully.";
            if($lg_switch == "en") {
                $title = $frtitre;
            } elseif($lg_switch == "fr") {
                $title = $entitle;
            }
            $message[] = "<span style='text-transform:capitalize; color:#AB7442;'>{$title}</span>  Validated Sucessfully.";
            // redirect('./dashboard.php');
            
        }else{
            $message[] =  $lang['File_upload_failed'];
        }

        //
          
        
        // else {
        //      $message[] =  $lang['error uploading file'];
        //  }
     
        //  echo $message[];
        // exit;
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
    <title>Articles</title>

    
    

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- ck editor -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="ckfinder/ckfinder.js"></script>

    
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <style>

    .drag-area{
        border: 2px dashed #5F9EA0;
        height: 300px;
        width: 300px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .drag-area img{
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

</style>
   

  </head>

<body>
    
    <?php include '../includes/header.php'; ?>
  
    <?php include '../includes/hnav.php'; ?>
  
    <!-- main content -->
  
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
    <div class="container" style="margin-right: 40px;">
<h4>Validate</h4>
    
    <section>

        <div class="container">
            <div class="row">
                <!-- error msg -->
                <?php
                    if(isset($message)){
                        foreach($message as $message){
                            echo '
                            <div class="message bg-warning mb-3" style="color:white; padding:5px;">
                                <span>'.$message.'</span>
                                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                            </div>
                            ';
                        }
                    }
                ?>
                <div class="col-md-12">
                    <form action="" method="post" enctype="multipart/form-data">


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <!-- tab contents -->
                            <div class="tab-content" id="myTabContent">
                                <!-- tab 1 -->
                                <div class="tab-pane fade show active" id="addN" role="tabpanel" aria-labelledby="addN-tab">
                                    
                                    
                                    <div class="mb-3">
                                        <input type="submit" name="validate" value="Validate" id="saveCfg" class="btn btn-success">
                                    </div>
                                    
                                    <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" value="<?= $new_tten; ?>" name="title" aria-describedby="titleHelp">
                                            <div id="titleHelp" class="form-text">Write a captivating title.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" cols="20" rows="4" aria-describedby="short_descHelp"><?= $new_sden; ?></textarea>
                                            
                                            <div id="short_descHelp" class="form-text">Not more than 100 words.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="content" aria-describedby="contentHelp"><?= $new_cnen; ?></textarea>
                                            
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label for="titlefr" class="form-label">Titre</label>
                                            <input type="text" class="form-control" id="titlefr" value="<?= $new_ttfr; ?>" name="titlefr" aria-describedby="titlefrHelp">
                                            <div id="titlefrHelp" class="form-text">Rédiger un titre captivant.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="short_descfr" class="form-label">Description sommaire</label>
                                            <textarea class="form-control" name="short_descfr" id="short_descfr" cols="20" rows="4" aria-describedby="short_descfrHelp"><?= $new_sdfr; ?></textarea>
                                            
                                            <div id="short_descfrHelp" class="form-text">Pas plus de 100 mots.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="contentFR" class="form-label">Contenu</label>
                                            <textarea class="form-control" name="contentFR" id="contentFR" aria-describedby="contentFRHelp"><?= $new_cnfr; ?></textarea>
                                            
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-auto">
                                                <label for="status" class="col-form-label">Status</label>
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select form-select-sm " id="status" name="status" aria-label=".form-select-sm example" disabled>
                                                    <option selected ><?= $new_state; ?></option>
                                                </select>
                                            </div>
                                            <!-- <div class="col-auto">
                                                <span id="statusHelpInline" class="form-text">
                                                Must be 8-20 characters long.
                                                </span>
                                            </div> -->
                                        </div>
                                        <div class="mb-3">
                                            <!-- <div class="col-auto">
                                                <span id="statusHelpInline" class="form-text">
                                                Must be 8-20 characters long.
                                                </span>
                                            </div> -->
                                        </div>

                                    
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                
                                                        <div class="mb-3">
                                                        <!-- <label for="thumb" class="form-label">Thumbnail</label> -->
                                                        <div class="drag-area">
                                                            <img src="../uploads/images/<?= $new_thumb; ?>" alt="">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>
                                <!-- tab 2 -->
                                <div class="tab-pane fade" id="enN" role="tabpanel" aria-labelledby="enN-tab">
                                    
                                </div>
                                <!-- tab 3 -->
                                <div class="tab-pane fade" id="frN" role="tabpanel" aria-labelledby="frN-tab">
                                    <!-- Fr -->
                                    <!-- <form action="" method="post" enctype="multipart/form-data"> -->

                                        <!-- <div class="mb-3">
                                            <label for="titlefr" class="form-label">Titre</label>
                                            <input type="text" class="form-control" id="titlefr" aria-describedby="titlefrHelp">
                                            <div id="titlefrHelp" class="form-text">Rédiger un titre captivant.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="short_descfr" class="form-label">Description sommaire</label>
                                            <textarea class="form-control" name="short_descfr" id="short_descfr" cols="20" rows="4" aria-describedby="short_descfrHelp"></textarea>
                                            
                                            <div id="short_descfrHelp" class="form-text">Pas plus de 100 mots.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="contentFR" class="form-label">Contenu</label>
                                            <textarea class="form-control" name="contentFR" id="contentFR" aria-describedby="contentFRHelp"></textarea>
                                             -->
                                            <!-- <div id="contentFRHelp" class="form-text">.</div> -->
                                        </div>
                                        <!-- save tab 2 btn -->
                                        <!-- <div class="mb-3">
                                            <input type="submit" name="saveEn" value="Save(FR)" id="saveEn" class="btn btn-success">
                                        </div> -->
                                        <!-- end en form -->
                                    <!-- </form> -->
                                </div>
                                <!-- tab 4 -->
                                <div class="tab-pane fade" id="confN" role="tabpanel" aria-labelledby="confN-tab">
                                    
                                    <!-- config -->
                                    <!-- <form action="" method="post" enctype="multipart/form-data"> -->

                                        <!-- <div class="mb-3">
                                            <div class="col-auto">
                                                <label for="status" class="col-form-label">Status</label>
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select form-select-sm " id="status" name="status" aria-label=".form-select-sm example">
                                                    <option selected>Select Status</option>
                                                    <option value="published">Published</option>
                                                    <option value="unpublished">Unpublished</option>
                                                    <option value="trash">Trash</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="mb-3">
                                            <div class="col-auto">
                                                <label for="status" class="col-form-label">Access</label>
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select form-select-sm " id="status" name="name" aria-label=".form-select-sm example">
                                                    <option selected>Select Access</option>
                                                    <option value="public">Public</option>
                                                    <option value="internal">Internal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="submit" name="add_article" value="Add Article" id="saveCfg" class="btn btn-success">
                                        </div> -->
                                        <!-- end en form -->
                                    </form>
                                </div>
                                <!-- end tab content -->
                            </div>

                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>

        
    </section>

    </div>


      
</main>


<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
