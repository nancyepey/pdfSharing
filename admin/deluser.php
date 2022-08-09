
<?php

if(isset($_POST["user_id"]))  
{
    
    $output = '';
    $form = '';

    $connect = mysqli_connect("localhost", "root", "", "pdfshare");  
    $query = "SELECT * FROM users WHERE id = '".$_POST["user_id"]."'";  
    $result = mysqli_query($connect, $query);  


    // $output .= '  
    // <div class="table-responsive">  
    //      <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  

        $form .= '
        <div class="mb-3">
            <label for="uname" class="form-label"> Are you show you want to delete user '.$row["username"].' </label>
            <input type="text" name="userID" value="'.$row["id"].'" hidden>
        </div>
        
        ';

    }  
    // $output .= "</table></div>";  
    // echo $output; 

    echo $form;


}


