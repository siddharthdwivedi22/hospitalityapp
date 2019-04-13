<?php
session_start();
require_once 'dbconnect.php';

if(empty($_SESSION['user'])) {
    header("Location: login.php");
}
if (empty($_GET['id'])) {
    header("Location: propImages.php");
}

$id = $_GET['id'] != "" && is_numeric($_GET['id']) ? $_GET['id'] : die('No id provided');

if (!empty($_POST['imgId'])) {
    $j = 0; //Variable for indexing uploaded image

    $target_path = "images/"; //Declaring Path for uploaded images


    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {  //loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable

        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

        if (($_FILES["file"]["size"][$i] < 90000000000000000) //Approx. 9MB files can be uploaded.
            && in_array($file_extension, $validextensions)
        ) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to folder
                echo $j . ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';

                $id = $_POST['imgId'];

                $Query=mysqli_query($conn,"SELECT * FROM images WHERE imgsID='$id'");
                $Row=mysqli_fetch_array($Query);
                $old_imagefile = $Row['fileName'];
                unlink($old_imagefile);

                $insert_path = mysqli_query($conn,"UPDATE images SET  fileName='$target_path' WHERE imgsID='$id'") or die (mysqli_error);
                header("Location: properties.php");

            } else {//if file was not moved.
                echo $j . ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
}

?>