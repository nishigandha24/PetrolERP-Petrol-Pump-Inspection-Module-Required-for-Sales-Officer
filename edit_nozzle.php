<?php
include ("connection.php");
error_reporting(0);
$pname = $_GET['pname'];
$id = $_GET['id'];
$name = $_GET['name'];
$iname = $_GET['iname'];
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">		
    <form action="" method="post">
        <div>
            <label>Pump Name : </label>
            <input type="text"  name="pump_name"  id="pump_name" value="<?php echo $pname; ?>" required/>
        </div>
        <div>
            <label>Nozzle Id : </label>
            <input type="number"  name="nozzle_id"  id="nozzle_id" value="<?php echo $id; ?>" required/>
        </div>
        <div>
            <label> Nozzle Name  :</label>
            <input type="text" name="nozzle_name"  id="nozzle_name" value="<?php echo $name; ?>" required>
        </div>
        <div>
            <label> Item Name  :</label>
            <input type="text" name="item_name"  id="item_name" value="<?php echo $iname; ?>" required>
        </div>
        <input type="submit" name="update" value="update"> 
        <input type="button" name="display" onclick="window.location = 'display_nozzle.php';" value="Display">
        <input type="button" name="exit" onclick="window.location = 'home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['update']) {
        $query = "UPDATE nozzle SET pump_name= '$_POST[pump_name]', nozzle_id = '$_POST[nozzle_id]', nozzle_name= '$_POST[nozzle_name]' ,item_name= '$_POST[item_name]' WHERE nozzle_id = '$id' ";
        $data = mysqli_query($conn, $query);
        if ($data) {
            ?>
            <script>
                alert("Nozzle Updated Successfully!!!");
//                document.getElementById("pump_name").value = " ";
//                document.getElementById("nozzle_id").value = " ";
//                document.getElementById("nozzle_name").value = " ";
//                document.getElementById("item_name").value = " ";
            </script>    
            <?php
        } else {
            ?>
            <script >
                alert("Nozzle Not Updated!!!");
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