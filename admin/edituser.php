<?php


if(isset($_POST["user_id"]))  
{
    $output = '';
    $form = '';

    $connect = mysqli_connect("localhost", "root", "", "pdfshare");  
    $query = "SELECT * FROM users WHERE id = '".$_POST["user_id"]."'";  
    $result = mysqli_query($connect, $query);  


    $output .= '  
    <div class="table-responsive">  
         <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  
         $output .= '  
              <tr>  
                   <td width="30%"><label>Username</label></td>  
                   <td width="70%">'.$row["username"].'</td>  
              </tr>  
              <tr>  
                   <td width="30%"><label>Name</label></td>  
                   <td width="70%">'.$row["name"].'</td>  
              </tr>  
              <tr>  
                   <td width="30%"><label>Email</label></td>  
                   <td width="70%">'.$row["email"].'</td>  
              </tr>  
              <tr>  
                   <td width="30%"><label>Designation</label></td>  
                   <td width="70%">'.$row["role"].'</td>  
              </tr>  
              <tr>  
                   <td width="30%"><label>Image</label></td>  
                   <td width="70%">'.$row["image"].' Year</td>  
              </tr>  
              ';  
     
    $checked = ($row["active"] == 1) ? "checked" : "";
    $form .= '
    <div class="mb-3">
        <label for="uname" class="form-label">Username</label>
        <input type="text" class="form-control" id="vuname" name="uname"  value="'.$row["username"].'" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="vname" name="name" value="'.$row["name"].'" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="vemail" name="email" value="'.$row["email"].'" required>
    </div>
    <div class="form-group">
        <label for="image">Old Profile Pic:'.$row["image"].'</label>
        <div class="custom-file">
        <input type="file" name="upload_image" class="custom-file-input" accept="image/jpg, image/jpeg, image/png">
        </div>
        </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" aria-label="Default select example" id="vrole" name="role" disabled>
            <option selected>'.$row["role"].'</option>
            <option value="admin">Administrator</option>
            <option value="manager">Manager</option>
            <option value="writer">Writer</option>
            <option value="translator">Translator</option>
        </select>
    </div>
    <div class="mb-3 form-check">
        <input type="hidden" name="status" value="0">
        <input type="checkbox" class="form-check-input" id="vstatus" name="status"  value="1" 
        '.$checked.'>
        
        <label class="form-check-label" for="status">Active</label>
    </div>
    ';

    }  
    $output .= "</table></div>";  
    // echo $output; 

    echo $form;



}