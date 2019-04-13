<?php include ("header.php") ?>


    <div class="banner-search">
        <div class="container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <!-- banner -->
            <h3>Search Accommodation</h3>
            <div class="searchbar">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label>Area:</label>
                        <input type="text" name="area" class="form-control"/><span class="text-danger"><?php echo $AreaError; ?></span>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 ">
                                <label for="beds">Beds: </label><select name="beds" id="beds" class="form-control">
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
                            <div class="col-lg-3 col-sm-4">
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

                            <div class="col-lg-3 col-sm-4" style="margin: 10px">
                                <button type="submit" class="btn btn-success"  name="btn-search">Find Now</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
                </form>
        </div>
    </div>

<?php $userId = $_SESSION['user']; ?>
<?php $propId = $_SESSION['property']; ?>
<?php $res = mysqli_query($conn,"SELECT * FROM `property` ORDER BY id"); ?>
<?php
$error = false;
$proptype = $_POST['propType'];
$beds = $_POST['beds'];
$Area = $_POST['area'];


?>
<?php $res1 = mysqli_query($conn,"SELECT * FROM property WHERE propType='$proptype' AND Beds='$beds' AND Area LIKE '%".$Area."%' ORDER BY id"); ?>

    <div class="container">
        <div class="properties-listing spacer">

            <div class="row">
                <div class="col-lg-9 col-sm-8">
                    <div class="row">

                        <?php
                        $per_page=6;
                        if (isset($_GET['page'])) {

                            $page = $_GET['page'];

                        }

                        else {

                            $page=1;

                        }

                        // Page will start from 0 and Multiple by Per Page
                        $start_from = ($page-1) * $per_page;
                        if(isset($_POST['btn-search'])){
                            $proptype = $_POST['propType'];
                            $beds = $_POST['beds'];
                            $Area = $_POST['area'];
                            if(empty($Area)){
                                $error=true;
                                $AreaError = "Please enter Location/Area";
                            }
                            $query = "SELECT * FROM property WHERE propType='$proptype' AND Beds='$beds' AND Area LIKE '%".$Area."%' ORDER BY id LIMIT $start_from, $per_page";
                            $result = mysqli_query($conn, $query);

                        }
                        else {

                            //Selecting the data from table but with limit
                            $query = "SELECT * FROM property ORDER BY id LIMIT $start_from, $per_page";
                            $result = mysqli_query($conn, $query);
                        }
                        ?>



                        <?php if (mysqli_num_rows($result) > 0) { ?>
                            <?php while($row = mysqli_fetch_assoc($result)){
                                $PROPID = $row['propID'];
                                $select_path = mysqli_query($conn,"SELECT * FROM `images` WHERE propID='$PROPID' ORDER BY 'id' DESC");
                                $imagerow = mysqli_fetch_assoc($select_path); ?>

                                <!-- properties -->
                                <div class="col-lg-4 col-sm-6">
                                    <div class="properties">
                                        <div class="image-holder"><img src="<?php echo $imagerow['fileName'];?>" class="img-responsive" alt="properties"/>

                                            <h5><a href="property-details.php?property_id=<?php echo $row['propID'];?>"><?php echo $row['Title']; ?></a></h5>
                                            <p class="area">Area:<?php echo $row['Area']; ?></p>
                                            <p class="price">Price:£<?php echo $row['Rate']; ?></p>
                                            <p class="beds">Beds:<?php echo $row['Beds']; ?></p>
                                            <a class="btn btn-primary" href="property-details.php?property_id=<?php echo $row['propID'];?>">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- properties -->


                            <?php } ?>
                        <?php } ?>
                    </div>
                    <!-- properties -->
                    <div class="center">
                        <ul class="pagination">
                            <?php
                            if(isset($_POST['btn-search'])){
                                $total_records = mysqli_num_rows($res1);
                            }
                            else {

                                // Count the total records
                                $total_records = mysqli_num_rows($res);
                            }
                            //Using ceil function to divide the total records on per page
                            $total_pages = ceil($total_records / $per_page);

                            //Going to first page
                            if($_GET['page'] != 1) {
                                echo '<li><a href="home.php?page=1">First Page</a></li> ';
                            }
                            for ($i=1; $i<=$total_pages; $i++) {

                                echo '<li><a href="home.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            // Going to last page
                            echo '<li><a href="home.php?page='.$total_pages.'">Last Page</a></li> ';
                            ?>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php include'footer.php';?>
<?php ob_end_flush(); ?>