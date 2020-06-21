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
    <div class="inputforms">
        <form id="printPageButton" class="forms1" action="" method="post">
            <div>
                <label>From Date : </label>
                <input type="date"  name="from" required/>
            </div>
            <div>
                <label>To Date : </label>
                <input type="date"  name="to" required/>
            </div><br/><br/>
            <input type="submit" name="submit" value="Submit"> 
            <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
        </form>

        <?php
        if (isset($_POST["submit"])) {
            $from = (isset($_POST['from']) ? $_POST['from'] : '');
            $to = (isset($_POST['to']) ? $_POST['to'] : '');
        }
        ?> 
    </div>
    <div class="displayforms" >
        <?php
        $i = 1;
        while ($i < 13) {
            $sql = " SELECT  A.testms , B.purchasems , C.testhsd ,D.purchasehsd from ( select SUM(ms) testms FROM  testing where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "' ) A CROSS JOIN ( select SUM(ms) purchasems FROM  purchase where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "') B CROSS JOIN ( select SUM(hsd) testhsd FROM  testing where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "') C CROSS JOIN ( select SUM(hsd) purchasehsd FROM  purchase where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "') D ";
            $data = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_array($data)) {
                $a1 = $result['testms'];
                $a3 = $result['testhsd'];
                $a2 = $result['purchasems'];
                $a4 = $result['purchasehsd'];
            }
            $i++;
            $total1 = $total1 + $a1;
            $total2 = $total2 + $a2;
            $total3 = $total3 + $a3;
            $total4 = $total4 + $a4;
        }
        $query1 = "SELECT m.nozzle_name as NozzleName, m.reading as TodayMeter,m.date as fdate,mr.reading as LastMeter,mr.date as ldate from meter_reading m inner join meter_reading mr INNER JOIN nozzle n on mr.nozzle_name=m.nozzle_name  where mr.date='$to' and m.date='$from' AND n.item_name='MS' AND m.nozzle_name=n.nozzle_name ORDER by n.nozzle_id asc";
        $data1 = mysqli_query($conn, $query1);
        $tot1 = mysqli_num_rows($data1);
        $query2 = "SELECT m.nozzle_name as NozzleName, m.reading as TodayMeter,m.date as fdate,mr.reading as LastMeter,mr.date as ldate from meter_reading m inner join meter_reading mr INNER JOIN nozzle n on mr.nozzle_name=m.nozzle_name  where mr.date='$to' and m.date='$from' AND n.item_name='HSD' AND m.nozzle_name=n.nozzle_name ORDER by n.nozzle_id asc";
        $data2 = mysqli_query($conn, $query2);
        $tot2 = mysqli_num_rows($data2);
        ?>

        <div>
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'meter_sale.php';"  value="Back">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button"  type="submit" value="print" onclick="printpage()" /> 
        </div>
        <br><br><br><br>
        <h4>Sales Report for petrol</h4>           
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4>  <br><br>

        <div class="table-responsive" >
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>Pumps</th>
                    <th>Todays Meter</th>
                    <th>Last Meter</th>
                    <th>Sale</th>
                    <th>Testing</th>
                    <th>Net Sale</th>
                    <th>Meter Sale</th>
                </tr>
                <?php
                if ($tot1 != 0) {
                    while ($result1 = mysqli_fetch_assoc($data1)) {
                        ?>
                        <tr>
                            <td><?php echo $result1['NozzleName']; ?></td>
                            <td>
                                <?php
                                $r1 = $result1['TodayMeter'];

                                echo $r1;
                                ?>
                            </td>
                            <td>
                                <?php
                                $r2 = $result1['LastMeter'];
                                echo $r2;
                                ?>
                            </td>
                            <td>
                                <?php
                                $sale = ($r1 - $r2);
                                echo $sale;
                                ?>
                            </td>
                            <td>
                                <?php
                                $testing1 = $total1;
                                echo $testing1;
                                ?>
                            </td>
                            <td>
                                <?php
                                $netsale = ($sale - $testing1);
                                echo $netsale;
                                ?>
                            </td>
                            <td>
                                <?php
                                $metersale = ($metersale + $netsale);
                                echo $metersale;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <br><br>
        <h4>Sales Report for diesel</h4>
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4>  <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>Pumps</th>
                    <th>Todays Meter</th>
                    <th>Last Meter</th>
                    <th>Sale</th>
                    <th>Testing</th>
                    <th>Net Sale</th>
                    <th>Meter Sale</th>
                </tr>
                <?php
                if ($tot2 != 0) {
                    while ($result2 = mysqli_fetch_assoc($data2)) {
                        ?>
                        <tr>
                            <td><?php echo $result2['NozzleName']; ?></td>
                            <td>
                                <?php
                                $r3 = $result2['TodayMeter'];
                                echo $r3;
                                ?>
                            </td>
                            <td>
                                <?php
                                $r4 = $result2['LastMeter'];
                                echo $r4;
                                ?>
                            </td>
                            <td>
                                <?php
                                $sale = ($r3 - $r4);
                                echo $sale;
                                ?>
                            </td>
                            <td>
                                <?php
                                $testing2 = $total3;
                                echo $testing2;
                                ?>
                            </td>
                            <td>
                                <?php
                                $netsale = ($sale - $testing2);
                                echo $netsale;
                                ?>
                            </td>
                            <td>
                                <?php
                                $metersale = ($metersale + $netsale);
                                echo $metersale;
                                ?>
                            </td>
                        </tr>
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
<script>
    $(document).ready(function ()
    {
        $(".inputforms").show();
        $(".displayforms").hide();
        $(".forms1").submit(function (e)
        {
            e.preventDefault();
            $(".inputforms").hide();
            $(".displayforms").show();
        });
    });
</script>
</body>
</html>