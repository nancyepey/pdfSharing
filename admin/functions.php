

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

?>