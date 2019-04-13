<?php include ("header.php") ?>

<?php
if( empty($_SESSION['user']) ){
header("Location: login.php");
}
$error = false;

if ( isset($_POST['btn-accommodation']) ) {

    $title = trim($_POST['title']);

    $propType = $_POST['propType'];

    $bed = $_POST['beds'];

    $rate = trim($_POST['rate']);
    //$rate = strip_tags($name);
    //$rate = htmlspecialchars($name);

    $propArea = trim($_POST['propArea']);
    //$email = strip_tags($email);
    //$email = htmlspecialchars($email);

    $streetAdd = trim($_POST['streetAdd']);

    $postCode = trim($_POST['postCode']);

    $propDet = trim($_POST['propDet']);

// basic validation
    if (empty($rate)) {
        $error = true;
        $rateError = "Please enter the rate.";
    }
    if (empty($propArea)) {
        $error = true;
        $propAreaError = "Please enter the Area name.";
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

    if (empty($title)) {
        $error = true;
        $titleError = "Please enter the Property Title.";
    }

    $resQuery=mysqli_query($conn,"SELECT ID FROM dbuser WHERE ID=".$_SESSION['user']);
    $userRow=mysqli_fetch_array($resQuery);
     $userID = $userRow['ID'];

    if (!$error) {

        $query = "INSERT INTO property(ID,Title,propType,Beds,Rate,Area,Address,Pcode,Details) VALUES('$userID','$title','$propType','$bed','$rate','$propArea','$streetAdd','$postCode','$propDet')";
        $res = mysqli_query($conn, $query);
        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully entered the details";
            $Query=mysqli_query($conn,"SELECT propID FROM property WHERE Title='$title'");
            $Row=mysqli_fetch_array($Query);
            $prop = $Row['propID'];
            header('Location: multiupload.php?id='.$prop);

        }
        else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
        }
        $Query=mysqli_query($conn,"SELECT propID FROM property WHERE Title='$title'");
        $Row=mysqli_fetch_array($Query);
        $_SESSION['property'] = $Row['propID'];
        $prop = $Row['propID'];

    }
}

?>


<div class="container">

    <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

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
                        <input type="text" name="title" class="form-control" maxlength="200" value="" />
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
                            <option>Lodge</option>
                            <option>Hostel</option>
                            <option>Guesthouse</option>
                            <option>Cabin</option>
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
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="rate">Weekly Rate: </label>
                         <input type="text" name="rate" class="form-control"  maxlength="10" value="" />
                    </div>
                    <span class="text-danger"><?php echo $rateError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="propArea">Property Area: </label><input type="text" name="propArea" class="form-control" maxlength="100" value="" />
                    </div>
                    <span class="text-danger"><?php echo $propAreaError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="streetAdd">Street Address: </label><input type="text" name="streetAdd" class="form-control" maxlength="200" value="" />
                    </div>
                    <span class="text-danger"><?php echo $streetAddError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="postCode">Post Code: </label><input type="text" name="postCode" class="form-control" maxlength="10" value="" />
                    </div>
                    <span class="text-danger"><?php echo $postCodeError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="propDet">Property Details: </label><textarea name="propDet" class="form-control" rows="5" cols="30" id="comment"></textarea>
                    </div>
                    <span class="text-danger"><?php echo $propDetError; ?></span>
                </div>



                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-accommodation">Post Accommodation</button>
                </div>

                <div class="form-group">
                    <hr />
                </div>


            </div>

        </form>
    </div>

</div>

<?php include ("footer.php") ?>


