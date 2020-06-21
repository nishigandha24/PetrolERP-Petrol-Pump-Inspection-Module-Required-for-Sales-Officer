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
            <label>Select Nozzle : </label>
            <?php
            $sql1 = "select (nozzle_name) from nozzle";
            $data1 = mysqli_query($conn, $sql1);
            ?>

            <select name='nozzle_name'>
                <?php
                while ($result1 = mysqli_fetch_array($data1)) {
                    echo "<option value='" . $result1['nozzle_name'] . "'>" . $result1['nozzle_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label>Date : </label>
            <input type="date"  name="date" required/>
        </div>
        <div>
            <label>Reading : </label>
            <input type="text"  name="reading" required/>
        </div>
        <input type="submit" name="submit" value="Save"> 
        <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">                
    </form>
    <?php
    if ($_POST['submit']) {
        $name = (isset($_POST['nozzle_name']) ? $_POST['nozzle_name'] : '');
        $date = (isset($_POST['date']) ? $_POST['date'] : '');
        $read = (isset($_POST['reading']) ? $_POST['reading'] : '');
        if ($name != "" && $date != "" && $read != "") {
            $sql = "insert into meter_reading (nozzle_name,date,reading) values ('$name','$date','$read')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?>
                <script>
                    alert("Meter Reading Added Successfully!!!");
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