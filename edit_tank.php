<?php
include ("connection.php");
error_reporting(0);
$id = $_GET['id'];
$name = $_GET['name'];
$cap = $_GET['cap'];
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">		
    <form id="forms1" action="" method="post">
        <div>
            <label>Tank ID : </label>
            <input type="number"  name="tank_id" id="tank_id" value="<?php echo $id; ?>" required/>
        </div>
        <div>
            <label>Tank Name : </label>
            <input type="text"  name="tank_name" id="tank_name" value="<?php echo $name; ?>" required/>
        </div>
        <div>
            <label>Capacity  :</label>
            <input type="number" name="capacity" id="capacity" value="<?php echo $cap; ?>" required>
        </div>
        <input type="submit" name="update" value="Update"> 
        <input type="button" name="display" onclick="window.location = 'display_tank.php';" value="Display">
        <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['update']) {
        $query = "UPDATE tank SET tank_id='$_POST[tank_id]',tank_name= '$_POST[tank_name]',capacity = '$_POST[capacity]' WHERE tank_id = '$id'";
        $data = mysqli_query($conn, $query);
        if ($data) {
            ?>
            <script >
                alert("Tank Updated Successfully!!!");
            </script>    
            <?php
        } else {
            ?>
            <script >
                alert("Tank Not Updated!!!");
            </script>  
            <?php
        }
    }
    ?>
</div>
<?php
include_once ("footer.php");
?>
</body>
</html>