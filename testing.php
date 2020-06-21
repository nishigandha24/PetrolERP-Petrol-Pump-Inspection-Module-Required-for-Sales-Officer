<?php
include ("connection.php");
error_reporting(0);
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <form action="" method="post">
        <div class="block">
            <label>Select Pump : </label>
            <?php
            $sql = "select distinct(pump_name) from pump";
            $data = mysqli_query($conn, $sql);
            echo "<select name='pump_name'>";
            while ($result = mysqli_fetch_array($data)) {
                echo "<option value='" . $result['pump_name'] . "'>" . $result['pump_name'] . "</option>";
            }
            echo "</select>";
            ?>
        </div>
        <div class="block">
            <label>Enter MS : </label>
            <input type="number"  name="ms"/>
        </div>
        <div class="block">
            <label>Enter hsd : </label>
            <input type="number"  name="hsd"/>
        </div>
        <div class="block">
            <label>Date : </label>
            <input type="date"  name="date"/>
        </div>
        <input type="submit" name="submit" value="Save"> 
        <input type="button" name="exit" onClick="window.location = 'http://localhost/IOCL/home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['submit']) {
        $pname = (isset($_POST['pump_name']) ? $_POST['pump_name'] : '');
        $ms = (isset($_POST['ms']) ? $_POST['ms'] : '');
        $hsd = (isset($_POST['hsd']) ? $_POST['hsd'] : '');
        $date = (isset($_POST['date']) ? $_POST['date'] : '');

        if ($pname != "" && $ms != "" && $hsd != "" && $date != "") {
            $sql = "insert into testing (pump_name,ms,hsd,date) values ('$pname','$ms','$hsd','$date')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?> 
                <script>
                    alert("Testing Added Successfully!!");
                </script>
                <?php
            }
        } else {
            ?>  
            <script>
                alert(" All fields are required !!!");
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