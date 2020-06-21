<?php
include ("connection.php");
error_reporting(0);
$sql = "select * from pump";
$data = mysqli_query($conn, $sql);
$total = mysqli_num_rows($data);
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?> <br/><br/>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">
    <div>
        <input style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
        <input style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'pump.php';"  value="Back">
    </div>
    <br><br><br><br><br><br>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>Tank Name</th>
                <th>Pump Name</th>
                <th colspan="2">Operations</th>
            </tr>
            <tr>
                <?php
                if ($total != 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        ?>
                        <td><?php echo $result['tank_name']; ?></td>
                        <td><?php echo $result['pump_name']; ?></td> 
                        <td><?php echo "<a href='edit_pump.php?tname=$result[tank_name]&pname=$result[pump_name]'>Edit</a>"; ?></td>
                        <td><?php echo "<a href='delete_pump.php?tname=$result[tank_name]&pname=$result[pump_name]'>Delete</a>"; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <script>
                    alert("No Records Found!!!");
                </script>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<?php
include_once ("footer.php");
?>
</body>
</html>
