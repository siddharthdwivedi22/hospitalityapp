<?php include'header.php';?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container">
            <span class="pull-right"><a href="index.php">Home</a> / Buy, Sale & Rent</span>
            <h2>Buy, Sale & Rent</h2>
        </div>
    </div>
    <!-- banner -->
<?php $userId = $_SESSION['user']; ?>
<?php $propId = $_SESSION['property']; ?>
<?php $res = mysqli_query($conn,"SELECT * FROM `property` WHERE ID='$userId' ORDER BY id"); ?>

    <div class="container">
        <div class="properties-listing spacer">

            <div class="row">
                <div class="col-lg-3 col-sm-4 ">

                    <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                        <input type="text" class="form-control" placeholder="Search of Properties">
                        <div class="row">
                            <div class="col-lg-5">
                                <select class="form-control">
                                    <option>Buy</option>
                                    <option>Rent</option>
                                    <option>Sale</option>
                                </select>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control">
                                    <option>Price</option>
                                    <option>$150,000 - $200,000</option>
                                    <option>$200,000 - $250,000</option>
                                    <option>$250,000 - $300,000</option>
                                    <option>$300,000 - above</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <select class="form-control">
                                    <option>Property Type</option>
                                    <option>Apartment</option>
                                    <option>Building</option>
                                    <option>Office Space</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary">Find Now</button>

                    </div>



                    <div class="hot-properties hidden-xs">
                        <h4>Hot Properties</h4>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"><img src="images/properties/1.jpg" class="img-responsive img-circle" alt="properties"></div>
                            <div class="col-lg-8 col-sm-7">
                                <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                <p class="price">$300,000</p> </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"><img src="images/properties/1.jpg" class="img-responsive img-circle" alt="properties"></div>
                            <div class="col-lg-8 col-sm-7">
                                <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                <p class="price">$300,000</p> </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-sm-5"><img src="images/properties/1.jpg" class="img-responsive img-circle" alt="properties"></div>
                            <div class="col-lg-8 col-sm-7">
                                <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                <p class="price">$300,000</p> </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-sm-5"><img src="images/properties/1.jpg" class="img-responsive img-circle" alt="properties"></div>
                            <div class="col-lg-8 col-sm-7">
                                <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                <p class="price">$300,000</p> </div>
                        </div>

                    </div>


                </div>

                <div class="col-lg-9 col-sm-8">
                    <div class="sortby clearfix">
                        <div class="pull-left result">Showing: 12 of 100 </div>
                        <div class="pull-right">
                            <select class="form-control">
                                <option>Sort by</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                            </select></div>

                    </div>
                    <div class="row">

         <?php if (mysqli_num_rows($res) > 0) { ?>
          <?php while($row = mysqli_fetch_assoc($res)){
            $PROPID = $row['propID'];
            $select_path = mysqli_query($conn,"SELECT * FROM `images` WHERE propID='$PROPID' ORDER BY 'id' DESC");
            $imagerow = mysqli_fetch_assoc($select_path);?>

                        <!-- properties -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="properties">
                                <div class="image-holder" style="position: relative"><img src="<?php echo $imagerow['fileName'];?>" class="img-responsive" alt="properties"/>
                                    <div class="status sold"><?php echo $row['Title']; ?></div>
                                </div>
                                <h5><a href="property-details.php?property_id=<?php echo $row['propID'];?>">Property Area:<?php echo $row['Area']; ?></a></h5>
                                <p class="price">Price:£<?php echo $row['Rate']; ?></p>
                                <p class="beds">Beds:<?php echo $row['Beds']; ?></p>
                                <a class="btn btn-primary" href="Edit.php?id=<?php echo $row['propID']; ?>">Edit</a>
                                <a class="btn btn-primary" href="Delete.php?id=<?php echo $row['propID']; ?>">Delete</a>
                            </div>
                        </div>
                        <!-- properties -->


             <?php } ?>
         <?php } ?>
                        </div>
                        <!-- properties -->
                        <div class="center">
                            <ul class="pagination">
                                <li><a href="#">«</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include'footer.php';?>