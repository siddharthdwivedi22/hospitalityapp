<?php include ("header.php") ?>

<head>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<?php
$id = $_GET['id'];
$select_path1 = mysqli_query($conn,"SELECT * FROM `images` WHERE propID='$id' ORDER BY 'id' DESC");
?>

<div class="container">

    <div class="row">
       <?php while($images = mysqli_fetch_assoc($select_path1)) { ?>

        <div class="col-lg-4 col-sm-6">
            <div class="properties">

                <img src="<?php echo $images['fileName'];?>" class="img-responsive" alt="properties"/>
                <a class="btn btn-primary" href="imageEdit.php?id=<?php echo $images['imgsID']; ?>">Edit</a>
                <a class="btn btn-primary" href="imageDelete.php?id=<?php echo $images['imgsID']; ?>">Delete</a>
                </div>
        </div>
        <?php } ?>

    </div>
    <form enctype="multipart/form-data" action="" method="post">
        <div><input name="file[]" type="file" id="file"/></div><br/>

        <input type="button" id="add_more" class="upload" value="Add More Files"/>
        <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
    </form>
    <br/>
    <br/>
    <!-------Including PHP Script here------>
    <?php include "upload.php"; ?>
</div>
<?php include ("footer.php") ?>
