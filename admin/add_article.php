<?php

include '../config.php';

session_start();

// $admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['id'];

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
        .drag-area.active{
            border: 2px solid #5F9EA0;
        }
        .drag-area .icon{
            font-size: 100px;
            color:#5F9EA0;
        }
        .drag-area header{
            font-size: 20px;
            font-weight: 500;
            color: #5F9EA0;
        }
        .drag-area span{
            font-size: 25px;
            font-weight: 500;
            color: #5F9EA0;
            margin: 10px 0 15px 0;
        }
        .drag-area button{
            padding: 10px 25px;
            font-size: 20px;
            font-weight: 500;
            border: none;
            outline: none;
            background: #5F9EA0;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            
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
    <h4>Add News</h4>
    
    <section>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- tabs head -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="addN-tab" data-bs-toggle="tab" data-bs-target="#addN" type="button" role="tab" aria-controls="addN" aria-selected="true">Add</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="enN-tab" data-bs-toggle="tab" data-bs-target="#enN" type="button" role="tab" aria-controls="enN" aria-selected="false">En</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="frN-tab" data-bs-toggle="tab" data-bs-target="#frN" type="button" role="tab" aria-controls="frN" aria-selected="false">Fr</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="confN-tab" data-bs-toggle="tab" data-bs-target="#confN" type="button" role="tab" aria-controls="confN" aria-selected="false">Visibility</button>
                        </li>
                    </ul>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <!-- tab contents -->
                            <div class="tab-content" id="myTabContent">
                                <!-- tab 1 -->
                                <div class="tab-pane fade show active" id="addN" role="tabpanel" aria-labelledby="addN-tab">
                                    
                                    <form action="" method="post">
                                        <!-- add news config -->
                                        <div class="mb-3">
                                            <label for="thumb" class="form-label">Thumbnail</label>
                                            <div class="drag-area">
                                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <header>Drag & Drop to Upload Image</header>
                                                <!-- <span>OR</span> -->
                                                <button hidden>Browse File</button>
                                                <input type="file" name="thumbnail" hidden>
                                            </div>
                                        </div>

                                        <!-- save tab 1 btn -->
                                        <div class="mb-3">
                                            <input type="submit" name="saveThumb" value="Save" id="saveThumb" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                                <!-- tab 2 -->
                                <div class="tab-pane fade" id="enN" role="tabpanel" aria-labelledby="enN-tab">
                                    <!-- En -->
                                    <form action="" method="post">

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp">
                                            <div id="titleHelp" class="form-text">Write a captivating title.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" cols="20" rows="4" aria-describedby="short_descHelp"></textarea>
                                            
                                            <div id="short_descHelp" class="form-text">Not more than 100 words.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="content" aria-describedby="contentHelp"></textarea>
                                            
                                            
                                        </div>
                                        <!-- save tab 2 btn -->
                                        <div class="mb-3">
                                            <input type="submit" name="saveEn" value="Save(EN)" id="saveEn" class="btn btn-success">
                                        </div>
                                        <!-- end en form -->
                                    </form>
                                </div>
                                <!-- tab 3 -->
                                <div class="tab-pane fade" id="frN" role="tabpanel" aria-labelledby="frN-tab">
                                    <!-- Fr -->
                                    <form action="" method="post">

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Titre</label>
                                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp">
                                            <div id="titleHelp" class="form-text">Rédiger un titre captivant.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="short_desc" class="form-label">Description sommaire</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" cols="20" rows="4" aria-describedby="short_descHelp"></textarea>
                                            
                                            <div id="short_descHelp" class="form-text">Pas plus de 100 mots.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="contentFR" class="form-label">Contenu</label>
                                            <textarea class="form-control" name="contentFR" id="contentFR" aria-describedby="contentFRHelp"></textarea>
                                            
                                            <!-- <div id="contentFRHelp" class="form-text">.</div> -->
                                        </div>
                                        <!-- save tab 2 btn -->
                                        <div class="mb-3">
                                            <input type="submit" name="saveEn" value="Save(FR)" id="saveEn" class="btn btn-success">
                                        </div>
                                        <!-- end en form -->
                                    </form>
                                </div>
                                <!-- tab 4 -->
                                <div class="tab-pane fade" id="confN" role="tabpanel" aria-labelledby="confN-tab">
                                    
                                    <!-- config -->
                                    <form action="" method="post">

                                        <div class="mb-3">
                                            <div class="col-auto">
                                                <label for="status" class="col-form-label">Status</label>
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select form-select-sm " id="status" name="name" aria-label=".form-select-sm example">
                                                    <option selected>Select Status</option>
                                                    <option value="published">Published</option>
                                                    <option value="unpublished">Unpublished</option>
                                                    <option value="trash">Trash</option>
                                                </select>
                                            </div>
                                            <!-- <div class="col-auto">
                                                <span id="statusHelpInline" class="form-text">
                                                Must be 8-20 characters long.
                                                </span>
                                            </div> -->
                                        </div>
                                        <div class="mb-3">
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
                                            <!-- <div class="col-auto">
                                                <span id="statusHelpInline" class="form-text">
                                                Must be 8-20 characters long.
                                                </span>
                                            </div> -->
                                        </div>
                                        <!-- save tab 2 btn -->
                                        <div class="mb-3">
                                            <input type="submit" name="saveCfg" value="Save Config" id="saveCfg" class="btn btn-success">
                                        </div>
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

 
<script>

    //en ckeditor
    var editor = CKEDITOR.replace( 'content', {
    height: 300,
    //   filebrowserUploadUrl: "upload.php"
    });
    CKFinder.setupCKEditor(editor);

    //fr ckeditor
    var editor = CKEDITOR.replace( 'contentFR', {
    height: 300,
    //   filebrowserUploadUrl: "upload.php"
    });
    CKFinder.setupCKEditor(editor);


    //selecting all required elements
    const dropArea = document.querySelector(".drag-area"),
    dragText = dropArea.querySelector("header"),
    button = dropArea.querySelector("button"),
    input = dropArea.querySelector("input");
    let file; //this is a global variable and we'll use it inside multiple functions

    button.onclick = ()=>{
    input.click(); //if user click on the button then the input also clicked
    }

    input.addEventListener("change", function(){
        //
        //getting user select file and [0] this means if user select multiple files then we'll select only the first one
        file = this.files[0];
        dropArea.classList.add("active");
        
    });


    //If user Drag File Over DropArea
    dropArea.addEventListener("dragover", (event)=>{
        event.preventDefault(); //preventing from default behaviour
        dropArea.classList.add("active");
        dragText.textContent = "Release to Upload File";
    });

    //If user leave dragged File from DropArea
    dropArea.addEventListener("dragleave", ()=>{
        dropArea.classList.remove("active");
        dragText.textContent = "Drag & Drop to Upload File";
    });

    //If user drop File on DropArea
    dropArea.addEventListener("drop", (event)=>{
        event.preventDefault(); //preventing from default behaviour
        //getting user select file and [0] this means if user select multiple files then we'll select only the first one
        file = event.dataTransfer.files[0];
        showFile(); //calling function
    });

    function showFile(){
        alert("inside show file!");
        let fileType = file.type; //getting selected file type
        let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
        if(validExtensions.includes(fileType)){ //if user selected file is an image file
            let fileReader = new FileReader(); //creating new FileReader object
            fileReader.onload = ()=>{
            let fileURL = fileReader.result; //passing user file source in fileURL variable
                // UNCOMMENT THIS BELOW LINE. I GOT AN ERROR WHILE UPLOADING THIS POST SO I COMMENTED IT
            let imgTag = `<img src="${fileURL}" height="100px" alt="image">`; //creating an img tag and passing user selected file source inside src attribute
            dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
            }
            fileReader.readAsDataURL(file);
        }else{
            alert("This is not an Image File!");
            dropArea.classList.remove("active");
            dragText.textContent = "Drag & Drop to Upload File";
        }
    }

</script>



<script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
