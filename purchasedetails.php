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
    <div id="inputforms">
        <form id="printPageButton"  action="" method="post">
            <div>
                <label>From Date : </label>
                <input type="date" name="from" required/>
            </div>
            <div>
                <label>To Date : </label>
                <input type="date" name="to" required/>
            </div><br><br>

            <input type="submit" name="submit" value="Submit"> 
            <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
            <br><br>         
        </form>
        <?php
        if (isset($_POST["submit"])) {
            $from = (isset($_POST['from']) ? $_POST['from'] : '');
            $to = (isset($_POST['to']) ? $_POST['to'] : '');
        }
        ?>
    </div>
    <div id="">
        <input id="printPageButton" style="float:right; margin: 20px;" type="button"  type="submit" value="print" onclick="printpage()" /> 
        <?php
        $sql = "SELECT * from purchase where date between '$from' and '$to'";
        $data = mysqli_query($conn, $sql);
        ?>
        <h4>Purchase Report</h4>
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4>  <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>MS</th>
                    <th>HSD</th>
                    <th>Date</th>
                </tr>
                <?php
                if (mysqli_num_rows($data) > 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        ?>
                        <tr>
                            <td><?php
                                $r1 = $result['ms'];
                                echo $result['ms'];
                                ?></td>
                            <td>
                                <?php
                                $r2 = $result['hsd'];
                                echo $result['hsd'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $result['date'];
                                ?>
                            </td>
                            <?php
                        }
                    }
                    ?>
            </table>
        </div>
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
<!--<script>
                        $(document).ready(function ()
                        {
                            $("#inputforms").show();
                            $("#displayforms").hide();
                            $("#forms1").submit(function (e)
                            {
                                e.preventDefault();
                                $("#inputforms").hide();
                                $("#displayforms").show();
                            });
                        });
        </script>     -->
</body>
</html>