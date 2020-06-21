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
            <label>MS : </label>
            <input type="number" step="any"  name="ms" required/>
        </div>
        <div>
            <label>HSD : </label>
            <input type="number" step="any" name="hsd" required/>
        </div>
        <div>
            <label>Date : </label>
            <input type="date"  name="date" required/>
        </div>
        <input type="submit" name="submit" value="Save"> 
        <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
    </form>
    <?php
    if ($_POST['submit']) {
        $ms = (isset($_POST['ms']) ? $_POST['ms'] : '');
        $hsd = (isset($_POST['hsd']) ? $_POST['hsd'] : '');
        $date = (isset($_POST['date']) ? $_POST['date'] : '');
        if ($hsd != "" && $ms != "" && $date != "") {
            $sql = "insert into opening_stock (ms,hsd,date) values ('$ms','$hsd','$date')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?>
                <script>
                    alert("Opening Stock Added Successfully!!!");
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