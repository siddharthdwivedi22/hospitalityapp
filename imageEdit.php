<?php include ("header.php") ?>
<?php $id = $_GET['id'] != "" && is_numeric($_GET['id']) ? $_GET['id'] : die('No id provided'); ?>
<?php
if(isset($_POST['Finish'])){
    header("Location: properties.php");
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<div class="container">

    <div id="login-form">
        <div class="col-md-12">

            <div class="form-group">
                <h2 class="">Upload Images For The Property.</h2>
            </div>

            <div class="form-group">
                <hr />
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div id="maindiv">

                        <div id="formdiv">
                            <h2>Images Upload</h2>
                            <form enctype="multipart/form-data" action="" method="post">
                                First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded.
                                <hr/>
                                <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

                               <!-- <input type="button" id="add_more" class="upload" value="Add More Files"/> -->
                                <input type="hidden" name="imgId" value="<?php echo $id; ?>" />
                                <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
                                <a class="upload" href="properties.php">Finish</a>
                            </form>
                            <br/>
                            <br/>
                            <!-------Including PHP Script here------>
                            <?php include "editImage.php"; ?>
                        </div>
                    </div>

                    <!-- Right side div -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php include ("footer.php") ?>
