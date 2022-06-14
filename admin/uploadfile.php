<?php

// if(isset($_FILES['upload_pdf'])) {

//     /* Get the name of the uploaded file */
//     $filename = $_FILES['upload_pdf']['name'];
    
//     /* Choose where to save the uploaded file */
//     $location = "./uploads/".$filename;
    
//     /* Save the uploaded file to the local filesystem */
//     if ( move_uploaded_file($_FILES['upload_pdf']['tmp_name'], $location) ) { 
//       echo 'Success'; 
//     } else { 
//       echo 'Failure'; 
//     }

// }

//upload.php


if(isset($_FILES['upload_pdf']))
{

	$extension = pathinfo($_FILES['upload_pdf']['name'], PATHINFO_EXTENSION);

	$new_name = time() . '.' . $extension;
	$filename = $_FILES['upload_pdf']['name'];
	$location = '../uploads/pdfs/' . $filename;

	// move_uploaded_file($_FILES['upload_pdf']['tmp_name'], $location);

	if ( move_uploaded_file($_FILES['upload_pdf']['tmp_name'], $location) ) { 
		echo 'Success'; 
	} else { 
		echo 'Failure'; 
	}

	

	// $data = array(
	// 	'image_source'		=>	'' . $filename
	// );

	// echo json_encode($data);

}


?>