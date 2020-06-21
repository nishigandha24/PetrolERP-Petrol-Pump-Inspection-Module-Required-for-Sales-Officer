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
            <label>Pump Name : </label>
            <input type="text" name="pump_name"/>
        </div>
        <div>
            <label>Nozzle ID : </label>
            <input type="number"  name="nozzle_id"/>
        </div>
        <div>
            <label>Nozzle Name : </label>
            <input type="text"  name="nozzle_name"/>
        </div>
        <div>
            <label>Item Name : </label>
            <select name='item_name'>
                <option value='MS'>MS</option>
                <option value='HSD'>HSD</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Save"> 
        <input type="button" name="display" onclick="window.location = 'display_nozzle.php';" value="Display">
        <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['submit']) {
        $pname = (isset($_POST['pump_name']) ? $_POST['pump_name'] : '');
        $id = (isset($_POST['nozzle_id']) ? $_POST['nozzle_id'] : '');
        $name = (isset($_POST['nozzle_name']) ? $_POST['nozzle_name'] : '');
        $iname = (isset($_POST['item_name']) ? $_POST['item_name'] : '');
        if ($pname != "" && $id != "" && $name != "" && $iname != "") {
            $sql = "insert into nozzle (pump_name,nozzle_id,nozzle_name,item_name) values ('$pname','$id','$name','$iname')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?> 
                <script>
                    alert("Nozzle Added Successfully!!!");
                </script>
                 <?php
            } else {
                ?>
                <script>
                    alert("Nozzle Not Added Successfully!!!");
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