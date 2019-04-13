<?php include("header.php") ?>

<?php
$active = ' active';
$userId = $_SESSION['user'];
$propId = $_GET['property_id'];
$res = mysqli_query($conn, "SELECT * FROM `property` WHERE propID='$propId' ORDER BY id");
$row = mysqli_fetch_assoc($res);
$_SESSION['title'] = $row['Title'];
$_SESSION['details'] = $row['Details'];
$_SESSION['prate'] = $row['Rate'];
$_SESSION['area'] = $row['Area'];
$_SESSION['stAdd'] = $row['Address'];
$_SESSION['postcode'] = $row['Pcode'];

//$PROPID = $row['propID'];
$select_path = mysqli_query($conn, "SELECT * FROM `images` WHERE propID='$propId' ORDER BY 'id' DESC");

//while($imagerow = mysqli_fetch_assoc($select_path)) {
//    echo '<pre>';
//    print_r($imagerow);
//    echo '</pre>';
//}
//die();

?>

<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="home.php">Home</a> / Properties</span>
        <h2>My Properties</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">

            <div class="col-lg-3 col-sm-4 hidden-xs">

                <div class="hot-properties hidden-xs">
                    <h4>Hot Properties</h4>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="images/properties/4.jpg"
                                                            class="img-responsive img-circle" alt="properties"/></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="images/properties/1.jpg"
                                                            class="img-responsive img-circle" alt="properties"/></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="images/properties/3.jpg"
                                                            class="img-responsive img-circle" alt="properties"/></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="images/properties/2.jpg"
                                                            class="img-responsive img-circle" alt="properties"/></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p></div>
                    </div>

                </div>


                <div class="advertisement">
                    <h4>Advertisements</h4>
                    <img src="images/advertisements.jpg" class="img-responsive" alt="advertisement">

                </div>

            </div>
            <div class="col-lg-9 col-sm-8 ">

                <h2><?php echo $_SESSION['title']; ?></h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="property-images">
                            <!-- Slider Starts -->
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php
                                    $i = 0;
                                    $images = array();
                                    while ($imagerow = mysqli_fetch_assoc($select_path)) {
                                        if ($i == 0) {
                                            echo "<li data-target='#myCarousel' data-slide-to='$i' class='active'></li>";
                                        } else {
                                            echo "<li data-target='#myCarousel' data-slide-to='$i' class=''></li>";
                                        }
                                        $i++;
                                        array_push($images, $imagerow['fileName']);
                                    }
                                     ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php foreach($images as $key => $imagePath) { ?>
                                        <div class="item <?php echo $key==0 ? 'active' : ''; ?>">
                                            <img src="<?php echo $imagePath; ?>" class="properties" alt="properties" />
                                        </div>
                                    <?php } ?>
                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span
                                        class="glyphicon glyphicon-chevron-left"></span></a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <!-- #Slider Ends -->

                        </div>
                        <div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span> Property Details</h4>
                            <p><?php echo $_SESSION['details']; ?></p>

                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12  col-sm-6">
                            <div class="property-info">
                                <p class="price">£ <?php echo $_SESSION['prate']; ?> pw</p>
                                <div class="profile">
                                <span class="glyphicon glyphicon-map-marker"></span> <?php echo $_SESSION['stAdd']; ?>
                                <p> <?php echo $_SESSION['area']; ?><br><?php echo $_SESSION['postcode']; ?></p>
                                </div>

                                <div class="profile">
                                    <span class="glyphicon glyphicon-user"></span> Agent Details
                                    <p>John Parker<br>009 229 2929</p>
                                </div>
                            </div>

                            <h6><span class="glyphicon glyphicon-home"></span> Availabilty</h6>
                            <div class="listing-detail">
                                <span data-toggle="tooltip" data-placement="bottom"
                                      data-original-title="Bed Room">5</span> <span data-toggle="tooltip"
                                                                                    data-placement="bottom"
                                                                                    data-original-title="Living Room">2</span>
                                <span data-toggle="tooltip" data-placement="bottom"
                                      data-original-title="Parking">2</span> <span data-toggle="tooltip"
                                                                                   data-placement="bottom"
                                                                                   data-original-title="Kitchen">1</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php include("footer.php") ?>
