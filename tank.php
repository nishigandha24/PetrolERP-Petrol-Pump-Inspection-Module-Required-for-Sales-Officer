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
            <label>Tank ID : </label>
            <input type="number"  name="tank_id" required/>
        </div>
        <div>
            <label>Tank Name : </label>
            <input type="text"  name="tank_name" required/>
        </div>
        <div>
            <label>Capacity : </label>
            <input type="number" name="capacity" required/>
        </div>
        <input type="submit" name="submit" value="Save"> 
        <input type="button" name="display" onClick="window.location = 'display_tank.php';" value="Display">
        <input type="button" name="exit" onClick="window.location = 'home.php';" value="Exit">
    </form>
    <?php
    if ($_POST['submit']) {
        $id = (isset($_POST['tank_id']) ? $_POST['tank_id'] : '');
        $name = (isset($_POST['tank_name']) ? $_POST['tank_name'] : '');
        $capa = (isset($_POST['capacity']) ? $_POST['capacity'] : '');
        if ($id != "" && $name != "" && $capa != "") {
            $sql = "insert into tank (tank_id,tank_name,capacity) values ('$id','$name','$capa')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?> 
                <script>
                    alert("Tank Added Successfully!!!");
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Tank Not Added Successfully!!!");
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