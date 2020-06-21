<?php
include ("connection.php");
error_reporting(0);
$tname = $_GET['tname'];
$pname = $_GET['pname'];
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">		
    <form id="forms" action="" method="post">
        <div>
            <label>Tank Name : </label>
            <input type="text" name="tank_name" id="tank_name" value="<?php echo $tname; ?>" required/>
        </div>
        <div>
            <label> Pump Name  :</label>
            <input type="text" name="pump_name" id="pump_name" value="<?php echo $pname; ?>" required>
        </div>
        <input type="submit" name="update" value="Update"> 
        <input type="button" name="display" onclick="window.location = 'display_pump.php';" value="Display">
        <input type="button" name="exit" onclick="window.location = 'home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['update']) {
        $query = "UPDATE pump SET tank_name= '$_POST[tank_name]', pump_name= '$_POST[pump_name]' WHERE tank_name= '$tname' and pump_name= '$pname' ";
        $data = mysqli_query($conn, $query);
        if ($data) {
            ?>
            <script>
                alert("Pump Updated Successfully!!!");
//                document.getElementById("tank_name").value = " ";
//                document.getElementById("pump_name").value = " ";
            </script>    
            <?php
        } else {
            ?>
            <script >
                alert("Pump Not Updated!!!");
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
