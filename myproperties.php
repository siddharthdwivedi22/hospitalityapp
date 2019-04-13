<?php include ("header.php") ?>
<?php
if( empty($_SESSION['user']) ){
header("Location: login.php");
}
?>
<?php $userId = $_SESSION['user']; ?>
<?php $res = mysqli_query($conn,"SELECT * FROM `property` WHERE ID='$userId' ORDER BY id"); ?>

	<table class="table-responsive" width="30%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
        <th>Property description</th>
        <th>Address</th>
        <th>Images</th>
 
    </tr>
    <?php if (mysqli_num_rows($res) > 0) { ?>
        <?php while($row = mysqli_fetch_assoc($res)) {
            $PROPID = $row['propID'];
        $select_path = mysqli_query($conn,"SELECT * FROM `images` WHERE propID='$PROPID' ORDER BY 'id' DESC");
        $imagerow = mysqli_fetch_assoc($select_path);?>
        <tr>
                
                <td>
                    <li>Type: <?php echo $row['Title']; ?></li>
                    <li>rooms:</li>
                    <li>bath:</li>
                    <li>etc</li>
                </td>
                <td>
                    <li>Area: <?php echo $row['Area']; ?></li>
                    <li>street:</li>
                    <li>postcode:</li>
                    <li>etc</li>
                </td>
                <td><img src="<?php echo $imagerow['fileName']; ?>" alt="add your images" height="100" width="100"/>
                </td>
            </tr>
            <tr> 

                <th><a href="Edit.php?id=<?php echo $row['propID']; ?>">Edit</a></th>
                <th><a href="Delete.php?id=<?php echo $row['propID']; ?>">Delete </a></th>
                <th></th>
            </tr>
        <?php } ?>
    <?php } else { ?>
    <tr>
        <th colspan="3">0 results</th>
    </tr>
    <?php } ?>
</table>

<?php include ("footer.php") ?>
