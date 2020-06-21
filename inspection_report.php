<?php
include ("connection.php");
error_reporting(0);
$date = date('Y-m-d H:i:s');
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
            </div>
            <input type="submit" name="submit" value="Submit"> 
            <input type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $from = (isset($_POST['from']) ? $_POST['from'] : '');
        $to = (isset($_POST['to']) ? $_POST['to'] : '');
    }
    if ($from != "" && $to != "") {
        $s = "insert into inspection_date (from_date,to_date,date) values ('$from','$to','$date')";
        $d = mysqli_query($conn, $s);
    }
    ?>

    <div class="displayforms" >
        <div>
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'testdetails.php';"  value="Back">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button"  type="submit" value="print" onclick="printpage()" /> 
        </div>
        <br><br><br><br>
        <h4>Inspection Report</h4>
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4>  <br><br>
        <h4>Testing Report</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>Month</th>
                    <th>Test</th>
                    <th>MS</th>
                    <th>Test</th>
                    <th>HSD</th>
                </tr>
                <?php
                $i = 1;
                $months = array("1" => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
                while ($i < 13) {
                    $sql = " SELECT  A.testms , B.purchasems , C.testhsd ,D.purchasehsd from ( select SUM(ms) testms FROM  testing where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "' ) A CROSS JOIN ( select SUM(ms) purchasems FROM  purchase where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "') B CROSS JOIN ( select SUM(hsd) testhsd FROM  testing where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "') C CROSS JOIN ( select SUM(hsd) purchasehsd FROM  purchase where MONTH(date) = $i and date between '" . $from . "' AND '" . $to . "') D ";
                    $data = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_array($data)) {
                        $a1 = $result['testms'];
                        $a3 = $result['testhsd'];
                        $a2 = $result['purchasems'];
                        $a4 = $result['purchasehsd'];
                        ?>
                        <tr>
                            <td> <?php
                                echo $months[$i];
                                ?></td>
                            <td><?php
                                echo $a1;
                                ?> </td>
                            <td><?php
                                echo $a2;
                                ?></td>
                            <td><?php
                                echo $a3;
                                ?></td>
                            <td><?php
                                echo $a4;
                                ?></td>
                        </tr>
                        <?php
                    }
                    $i++;
                    $total1 = $total1 + $a1;
                    $total2 = $total2 + $a2;
                    $total3 = $total3 + $a3;
                    $total4 = $total4 + $a4;
                }
                ?>
                <tr>
                    <td> <?php
                        echo "Total";
                        ?></td>
                    <td><?php
                        echo $total1;
                        ?> </td>
                    <td><?php
                        echo $total2;
                        ?></td>
                    <td><?php
                        echo $total3;
                        ?></td>
                    <td><?php
                        echo $total4;
                        ?></td>
                </tr>
            </table>
        </div>

        <?php
        $query1 = "SELECT m.nozzle_name as NozzleName, m.reading as TodayMeter,m.date as fdate,mr.reading as LastMeter,mr.date as ldate from meter_reading m inner join meter_reading mr INNER JOIN nozzle n on mr.nozzle_name=m.nozzle_name  where mr.date='$to' and m.date='$from' AND n.item_name='MS' AND m.nozzle_name=n.nozzle_name ORDER by n.nozzle_id asc";
        $data1 = mysqli_query($conn, $query1);
        $query2 = "SELECT m.nozzle_name as NozzleName, m.reading as TodayMeter,m.date as fdate,mr.reading as LastMeter,mr.date as ldate from meter_reading m inner join meter_reading mr INNER JOIN nozzle n on mr.nozzle_name=m.nozzle_name  where mr.date='$to' and m.date='$from' AND n.item_name='HSD' AND m.nozzle_name=n.nozzle_name ORDER by n.nozzle_id asc";
        $data2 = mysqli_query($conn, $query2);
        $query3 = "SELECT SUM(o.ms) as OMS, SUM(o.hsd) as OHSD, o.date as ODATE,SUM(c.ms) as CMS, SUM(c.hsd) as CHSD, c.date as CDATE from opening_stock o inner join closing_stock c where o.date='$from' and c.date='$from'";
        $data3 = mysqli_query($conn, $query3);
        ?>
        <br><br>
        <h4>Sales Report for petrol</h4>           
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
                if (mysqli_num_rows($data1) > 0) {
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
                            <?php
                            $saleMS = ($result1['TodayMeter'] - $result1['LastMeter']);
                            $netsaleMS = ($saleMS - $total1);
                            $metersaleMS = ($metersaleMS + $netsaleMS);
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <br><br>
        <h4>Sales Report for diesel</h4>
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
                if (mysqli_num_rows($data2) > 0) {
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
                            <?php
                            $saleHSD = ($result2['TodayMeter'] - $result2['LastMeter']);
                            $netsaleHSD = ($saleHSD - $total3);
                            $metersaleHSD = ($metersaleHSD + $netsaleHSD);
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

        <br><br>
        <h4>Tank Sales Report</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>Item</th>
                    <th>Opening Stock</th>
                    <th>Record</th>
                    <th>Total Stock</th>
                    <th>Closing Stock</th>
                    <th>Tank Sale</th>
                </tr>
                <?php
                if (mysqli_num_rows($data3) > 0) {
                    while ($result3 = mysqli_fetch_assoc($data3)) {
                        ?>
                        <tr>
                            <td>MS</td>
                            <td>
                                <?php
                                $r1 = $result3['OMS'];
                                echo $r1;
                                ?>
                            </td>
                            <td>
                                <?php
                                $r2 = $total2;
                                echo $r2;
                                ?>
                            </td>
                            <td>
                                <?php
                                $totalstockMS = $r1 + $r2;
                                echo $totalstockMS;
                                ?>
                            </td>
                            <td>
                                <?php
                                $r3 = $result3['OHSD'];
                                echo $r3;
                                ?>
                            </td>
                            <td>
                                <?php
                                $tanksaleMS = ($totalstockMS - $r3);
                                echo $tanksaleMS;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>HSD</td>
                            <td>
                                <?php
                                $d1 = $result3['CMS'];
                                echo $d1;
                                ?>
                            </td>
                            <td>
                                <?php
                                $d2 = $total4;
                                echo $d2;
                                ?>
                            </td>
                            <td>
                                <?php
                                $totalstockHSD = ($d1 + $d2);
                                echo $totalstockHSD;
                                ?>
                            </td>
                            <td>
                                <?php
                                $d3 = $result3['CHSD'];
                                echo $d3;
                                ?>
                            </td>
                            <td>
                                <?php
                                $tanksaleHSD = ($totalstockHSD - $d3);
                                echo $tanksaleHSD;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div> 
        <?php
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
        <br><br>
        <h4>Stock Difference</h4> 
        <div class = "table-responsive">
            <table class = "table table-striped table-hover table-bordered">
                <tr>
                    <th>MS</th>
                    <th>HSD</th>
                </tr>
                <tr>
                    <td><?php
                        echo $SDMS;
                        ?>
                    </td>
                    <td><?php
                        echo $SDHSD;
                        ?>
                    </td>
                </tr>
            </table>
        </div>

        <br><br>    
        <h4>Total Permiceable</h4> 
        <div class = "table-responsive">
            <table class = "table table-striped table-hover table-bordered">
                <tr>
                    <th>#</th>
                    <th>4%Closing Stock</th>
                    <th>[A] *.75% [MS]</th>
                    <th>[A] *25% [HSD]</th>
                    <th>TOTAL PERMIC.</th>
                    <th>STOCK DIFF. - TOTAL PERMIC.</th>
                </tr>
                <tr>
                    <td><?php
                        echo "MS";
                        ?>
                    </td>
                    <td><?php
                        echo $cms;
                        $cms = ($d1 * 0.04);
                        echo $cms;
                        ?>
                    </td>
                    <td><?php
                        echo $metersaleMS;
                        $metersaleMS = ($metersaleMS * 0.75);
                        echo $metersaleMS;
                        ?>
                    </td>
                    <td><?php
                        echo 0;
                        ?>
                    </td>
                    <td><?php
                        $perms = ($d1 + $metersaleMS);
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
                        echo $chsd;
                        $chsd = ($d3 * 0.04);
                        echo $chsd;
                        ?>
                    </td>
                    <td><?php
                        echo 0;
                        ?>
                    </td>
                    <td><?php
                        echo $metersaleHSD;

                        $metersaleHSD = ($metersaleHSD * 0.75);
                        echo $metersaleHSD;
                        ?>
                    </td> 
                    <td><?php
                        $perhsd = ($d3 + $metersaleHSD);
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