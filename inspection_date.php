<?php
include ("connection.php");
error_reporting(0);
?>
<?php
include_once ("header.php");
include_once ("NavBarCommon.php");
?>
<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">	
    <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
    <input id="printPageButton" style="float:right; margin: 20px;" type="button"  type="submit" value="print" onclick="printpage()" /> 
    <br><br><br><br>
    <h4>Inspection Dates</h4>
    <br><br>      
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>From Date</th>
                <th>To Date</th>
                <th>Date</th>
            </tr>
            <?php
            $sql = " SELECT * from inspection_date ";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($result = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td> <?php
                            echo $result['from_date'];
                            ?></td>
                        <td><?php
                            echo $result['to_date'];
                            ?> </td>
                        <td><?php
                            echo $result['date'];
                            ?> </td>
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
<script type="text/javascript">
    function printpage()
    {
        window.print();
    }
</script>
</body>
</html>