

<?php

// protect ourself from sql injection
function escape($string) {

    //getting our connection to get access to db
    global $conn;

    //using a build in fxn from php ie mysqli_real_escape_string()
    //we can trim the string by using the function trim() and/or strip tags fxn to remove any hmtl tags too
    //we return it
    //mysqli_real_escape_string($connection, trim(strip_tags($string)));

    return mysqli_real_escape_string($conn, trim($string));

}

//adding a condition when $create_post_query ie query doesn't work or checking the query id working
function confirmQuery($result) {
    //making our connection variable global
    global $conn;
    
    if(!$result) {
        
        die("QUERY FAILED ".mysqli_error($conn));
        
    }
}

//to login a user
function login_user($username, $password) {

    //getting the global connecting
    global $conn;

    //triming the data from user, meaning removing white spaces
    $username = trim($username);
    $password = trim(md5($password));
    
    //this function mysqli_real_escape_string() cleans up the data submitted to prevert hackers from harming our system
    //mysqli_real_escape_string() takes in 2 parameter the connection to database and the variable it wants to clean
    $username = mysqli_real_escape_string($conn, $username);
    // this $username above is now a clean version of the one assigned to the username field above
    
    $password = mysqli_real_escape_string($conn, $password);
    //now the info coming from our form is clean, since it doesn't have sql injection on  it, then we can put in our db
    
    //checking our column in our table 
    //query is to pull our some info is the username is found in the username column
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    
    //sending the query, the result of the query is store in $select_user_query variable
    $select_user_query = mysqli_query($conn, $query);
    
    //testing query
    if(!$select_user_query) {
        $message[] = 'CHECK PASSED';
        die("Query Failed!" .mysqli_error($conn));
    }
    
    while($row = mysqli_fetch_array($select_user_query)) {
        
        //looping through the result of the query
        $db_user_id        = $row['id'];
        $db_username       = $row['username'];
        $db_user_password  = $row['password'];
        $db_user_name      = $row['name'];
        $db_user_email     = $row['email'];
        $db_user_role      = $row['role'];
        $db_user_img       = $row['image'];
        $db_user_date      = $row['created_on'];


        //validation
        //method 1, this === makes it super strict meaning it must be identical

        //verifying the password using the password verify function

        //OLD
        /*
        f($username === $db_username && (password_verify($password, $db_user_password) || $password == $db_user_password))
        */

        if($username === $db_username && (password_verify($password, $db_user_password) || $password == $db_user_password)) {
            
            //setting some value for the session when the user successfully login
            //setting session
            //start session
            session_start(); 

            //setting a session called username
            //assigning our username ie $db_username from database to a session called username
            $_SESSION['id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['name'] = $db_user_name;
            $_SESSION['email'] = $db_user_email;
            $_SESSION['role'] = $db_user_role;
            $_SESSION['pic'] = $db_user_img;
            $_SESSION['date'] = $db_user_date;
            

            //if the username and password put in by user is the same to that of a user in database
            //redirect to admin dashboard 
            //OLD METHOD
            //header("Location: ../admin");

            //NEW METHOD USING CUSTOM FUNCTION TO REDIRECT
            redirect("admin/main.php");
            
            
            
        }  else {
            
            //if any other thing happen, we need to just take the user back to index.php page ie home page
            
            return false;
            
        }


    }


    
   
    return true; 

}



?>