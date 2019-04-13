<?php include ("header.php") ?>

<?php


if(isset($_GET['id'])!="" && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $delete = mysqli_query($conn, "DELETE FROM property WHERE propID='$id'");
    if ($delete) {
        header('location:properties.php');

    } else {
        echo "Unsuccessful";
    }
}
?>

<?php include ("footer.php") ?>

