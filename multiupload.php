<?php include ("header.php") ?>

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
           
                    <input type="button" id="add_more" class="upload" value="Add More Files"/>
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
                </form>
                <br/>
                <br/>
				<!-------Including PHP Script here------>
                <?php include "upload.php"; ?>
</div>
             </div>
           
		   <!-- Right side div -->


                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?php include ("footer.php") ?>
