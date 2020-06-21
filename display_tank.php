<?php
include ("connection.php");
error_reporting(0);
$sql = "select * from tank";
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
        <input style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'tank.php';"  value="Back">
    </div>
    <br><br><br><br><br><br>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>Tank ID</th>
                <th>Tank Name</th>
                <th>Capacity</th>
                <th colspan="2">Operations</th>
            </tr>
            <tr>
                <?php
                if ($total != 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        ?>
                        <td><?php echo $result['tank_id']; ?></td>
                        <td><?php echo $result['tank_name']; ?></td> 
                        <td><?php echo $result['capacity']; ?></td>
                        <td><?php echo "<a href='edit_tank?id=$result[tank_id]&name=$result[tank_name]&cap=$result[capacity]'>Edit</a>"; ?></td>
                        <td><?php echo "<a href='delete_tank?id=$result[tank_id]'>Delete</a>"; ?></td>
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
