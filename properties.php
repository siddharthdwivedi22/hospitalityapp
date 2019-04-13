<?php include'header.php';?>
<?php
if( empty($_SESSION['user']) ){
    header("Location: login.php");
}
?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container">
            <span class="pull-right"><a href="home.php">Home</a> / My Properties</span>
            <h2>My Properties</h2>
        </div>
    </div>
    <!-- banner -->
<?php $userId = $_SESSION['user']; ?>
<?php $propId = $_SESSION['property']; ?>
<?php $res = mysqli_query($conn,"SELECT * FROM `property` WHERE ID='$userId' ORDER BY id"); ?>

    <div class="container">
        <div class="properties-listing spacer">

            <div class="row">

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

                        <?php
                        $per_page=5;
                        if (isset($_GET['page'])) {

                            $page = $_GET['page'];

                        }

                        else {

                            $page=1;

                        }

                        // Page will start from 0 and Multiple by Per Page
                        $start_from = ($page-1) * $per_page;

                        //Selecting the data from table but with limit
                        $query = "SELECT * FROM property WHERE ID='$userId' ORDER BY id LIMIT $start_from, $per_page";
                        $result = mysqli_query($conn, $query);

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
                                        <a class="btn btn-primary" href="Edit.php?id=<?php echo $row['propID']; ?>">Edit</a>
                                        <a class="btn btn-primary" href="Delete.php?id=<?php echo $row['propID']; ?>">Delete</a>
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

                            // Count the total records
                            $total_records = mysqli_num_rows($res);

                            //Using ceil function to divide the total records on per page
                            $total_pages = ceil($total_records / $per_page);

                            //Going to first page
                            if($_GET['page'] != 1) {
                                echo '<li><a href="properties.php?page=1">First Page</a></li> ';
                            }
                            for ($i=1; $i<=$total_pages; $i++) {

                                echo '<li><a href="properties.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            // Going to last page
                            echo '<li><a href="properties.php?page='.$total_pages.'">Last Page</a></li> ';
                            ?>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php include'footer.php';?>