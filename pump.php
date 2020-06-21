<?php
include ("connection.php");
error_reporting(0);
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">		
    <form action="" method="post">
        <div>
            <label>Tank Name : </label>
            <input type="text"  name="tank_name" required/>
        </div>

        <div>
            <label>Pump Name : </label>
            <input type="text"  name="pump_name" required/>
        </div>
        <input type="submit" name="submit" value="Save"> 
        <input type="button" name="display" onclick="window.location = 'display_pump.php';" value="Display">
        <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['submit']) {
        $pname = (isset($_POST['pump_name']) ? $_POST['pump_name'] : '');
        $tname = (isset($_POST['tank_name']) ? $_POST['tank_name'] : '');
        if ($pname != "" && $tname != "") {
            $sql = "insert into pump (tank_name,pump_name) values ('$tname','$pname')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?> 
                <script>
                    alert("Pump Added Successfully!!");
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Pump Not Added Successfully!!!");
                </script>
                <?php
            }
        }
    }
    ?>  
</div>

<?php
include_once ("footer.php");
?>
</body>
</html>