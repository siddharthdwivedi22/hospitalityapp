<?php include ("header.php") ?>

<?php
    $id = $_GET['id'] != "" && is_numeric($_GET['id']) ? $_GET['id'] : die('No id provided');

    $error = false;
    if (!empty($_POST['propId'])) {
        $title = $_POST['title'];
        $propType = $_POST['propType'];
        $bed = $_POST['beds'];
        $rate = $_POST['rate'];
        $propArea = $_POST['propArea'];
        $streetAdd = $_POST['streetAdd'];
        $postCode = $_POST['postCode'];
        $propDet = $_POST['propDet'];

        if (empty($title)) {
            $error = true;
            $titleError = "Please enter the rate.";
        }
        if (empty($rate)) {
            $error = true;
            $rateError = "Please enter the Area name.";
        }
        if (empty($streetAdd)) {
            $error = true;
            $streetAddError = "Please enter the Street Address.";
        }
        if (empty($postCode)) {
            $error = true;
            $postCodeError = "Please enter the Post Code.";
        }
        if (empty($propDet)) {
            $error = true;
            $propDetError = "Please enter the Property Details.";
        }

        $id = $_POST['propId'];
        $updated = mysqli_query($conn, "UPDATE property SET 
        Title='$title', propType='$propType', Beds='$bed', Rate='$rate', Area='$propArea', Address='$streetAdd', Pcode='$postCode', Details='$propDet' WHERE propID='$id'");

        if ($updated) {
            $msg = "Successfully Updated!!";
            header('Location:propImages.php?id='.$id);
        } else {
            $msgg = "error";
        }
    }
?>


<?php
if(isset($id)) {
    $getselect = mysqli_query($conn, "SELECT * FROM property WHERE propID='$id'");
    while ($profile = mysqli_fetch_array($getselect)) {
        $propTitle = $profile['Title'];
        $type = $profile['propType'];
        $bedsNo = $profile['Beds'];
        $propRate = $profile['Rate'];
        $area = $profile['Area'];
        $address = $profile['Address'];
        $pcode = $profile['Pcode'];
        $details = $profile['Details'];


?>

<div class="container">

    <div id="login-form">
        <form method="post"  enctype="multipart/form-data">

            <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Accommodation Information</h2>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <?php
                if ( isset($errMSG) ) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>


                <div class="form-group">
                    <div class="input-group">
                        <label for="title">Property Title: </label>
                        <input type="text" name="title" class="form-control"  maxlength="200" value="<?php echo $propTitle; ?>" />
                    </div>
                    <span class="text-danger"><?php echo $titleError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="propType">Property Type: </label><select name="propType" id="propType" class="form-control">
                            <option>House</option>
                            <option>Villa</option>
                            <option>Apartment</option>
                            <option>Hotel</option>
                            <option>Farmhouse</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="beds">Number of Beds: </label><select name="beds" id="beds" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="rate">Weekly Rate: </label>
                        <input type="text" name="rate" class="form-control"  maxlength="10" value="<?php echo $propRate; ?>" />
                    </div>
                    <span class="text-danger"><?php echo $rateError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="propArea">Property Area: </label><input type="text" name="propArea" class="form-control"  maxlength="200" value="<?php echo $area; ?>" />
                    </div>
                    <span class="text-danger"><?php echo $propAreaError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="streetAdd">Street Address: </label><input type="text" name="streetAdd" class="form-control"  maxlength="200" value="<?php echo $address; ?>" />
                    </div>
                    <span class="text-danger"><?php echo $streetAddError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="postCode">Post Code: </label><input type="text" name="postCode" class="form-control" maxlength="10" value="<?php echo $pcode; ?>" />
                    </div>
                    <span class="text-danger"><?php echo $postCodeError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="propDet">Property Details: </label><textarea name="propDet" class="form-control" rows="5" cols="30" id="comment"><?php echo $details; ?></textarea>
                    </div>
                    <span class="text-danger"><?php echo $propDetError; ?></span>
                </div>



                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <input type="hidden" name="propId" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-block btn-primary" name="btn-update">Next</button>
                </div>

                <div class="form-group">
                    <hr />
                </div>


            </div>

        </form>
    </div>

</div>
    <?php } } ?>

<?php include ("footer.php") ?>

