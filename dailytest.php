<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">	
    <input style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
    <br><br><br><br>
    <h4>Daily Test Report</h4>
    <br><br>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>Pump Name</th>
                <th>MS</th>
                <th>HSD</th>
                <th>Date</th>
            </tr>
            <?php
            $sql = " SELECT * FROM testing ";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($result = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php
                            echo $result['pump_name'];
                            ?> </td>
                        <td><?php
                            echo $result['ms'];
                            ?></td>
                        <td><?php
                            echo $result['hsd'];
                            ?></td>
                        <td><?php
                            echo $result['date'];
                            ?></td>
                    </tr>
                    <?php
                }
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