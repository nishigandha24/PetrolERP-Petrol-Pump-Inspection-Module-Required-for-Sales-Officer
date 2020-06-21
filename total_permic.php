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
        <form id="forms1" action="" method="post">
            <div>
                <label>From Date : </label>
                <input type="date"  name="from" required/>
            </div>
            <div>
                <label>To Date : </label>
                <input type="date"  name="to" required/>
            </div>
            <input type="submit" name="submit" value="Submit"> 
            <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['from']) && isset($_POST['to'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];
            }
        }
        ?>

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
        $query2 = "SELECT m.nozzle_name as NozzleName, m.reading as TodayMeter,m.date as fdate,mr.reading as LastMeter,mr.date as ldate from meter_reading m inner join meter_reading mr INNER JOIN nozzle n on mr.nozzle_name=m.nozzle_name  where mr.date='$to' and m.date='$from' AND n.item_name='HSD' AND m.nozzle_name=n.nozzle_name ORDER by n.nozzle_id asc";
        $data2 = mysqli_query($conn, $query2);
        $query3 = "SELECT SUM(o.ms) as OMS, SUM(o.hsd) as OHSD, o.date as ODATE,SUM(c.ms) as CMS, SUM(c.hsd) as CHSD, c.date as CDATE from opening_stock o inner join closing_stock c where o.date='$from' and c.date='$from'";
        $data3 = mysqli_query($conn, $query3);

        if (mysqli_num_rows($data1) > 0) {
            while ($result1 = mysqli_fetch_assoc($data1)) {
                $saleMS = ($result1['TodayMeter'] - $result1['LastMeter']);
                $netsaleMS = ($saleMS - $total1);
                $metersaleMS = ($metersaleMS + $netsaleMS);
            }
        }
        if (mysqli_num_rows($data2) > 0) {
            while ($result2 = mysqli_fetch_assoc($data2)) {
                $saleHSD = ($result2['TodayMeter'] - $result2['LastMeter']);
                $netsaleHSD = ($saleHSD - $total3);
                $metersaleHSD = ($metersaleHSD + $netsaleHSD);
            }
        }
        if (mysqli_num_rows($data3) > 0) {
            while ($result3 = mysqli_fetch_assoc($data3)) {
                $totalstockMS = ($result3['OMS'] + $total2);
                $tanksaleMS = ($totalstockMS - $result3['CMS']);
                $totalstockHSD = ($result3['OHSD'] + $total4);
                $tanksaleHSD = ($totalstockHSD - $result3['CHSD']);
                $cms = $result3['CMS'];
                $chsd = $result3['CHSD'];
            }
        }
        $SDMS = ($metersaleMS - $tanksaleMS);
        $SDHSD = ($metersaleHSD - $tanksaleHSD);
        ?>
    </div>
    <hr/>
    <div id="displayforms">
        <div>
            <input style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
            <input style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'total_permic.php';"  value="Back">
        </div>
        <br><br><br><br>
        <h4>Total Permiceable</h4> 
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4> <br><br>
        <div class = "table-responsive">
            <table class = "table table-striped table-hover table-bordered">
                <tr>
                    <th>Item</th>
                    <th>4%Closing Stock</th>
                    <th>[A]*.75% [MS]</th>
                    <th>[A]*25% [HSD]</th>
                    <th>TOTAL PERMIC.</th>
                    <th>STOCK DIFF. - TOTAL PERMIC.</th>
                </tr>
                <tr>
                    <td><?php
                        echo "MS";
                        ?>
                    </td>
                    <td><?php
                        $cms = ($cms * 0.04);
                        echo $cms;
                        ?>
                    </td>
                    <td><?php
                        $metersaleMS = ($metersaleMS * 0.75);
                        echo $metersaleMS;
                        ?>
                    </td>
                    <td><?php
                        echo 0;
                        ?>
                    </td>
                    <td><?php
                        $perms = ($cms + $metersaleMS);
                        echo $perms;
                        ?>
                    </td>
                    <td><?php
                        echo $SDMS - $perms;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><?php
                        echo "HSD";
                        ?>
                    </td>
                    <td><?php
                        $chsd = ($chsd * 0.04);
                        echo $chsd;
                        ?>
                    </td>
                    <td><?php
                        echo 0;
                        ?>
                    </td>
                    <td><?php
                        $metersaleHSD = ($metersaleHSD * 0.75);
                        echo $metersaleHSD;
                        ?>
                    </td> 
                    <td><?php
                        $perhsd = ($chsd + $metersaleHSD);
                        echo $perhsd;
                        ?>
                    </td>
                    <td><?php
                        echo $SDHSD - $perhsd;
                        ?>
                    </td>
                </tr>
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
<!--        <script>
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