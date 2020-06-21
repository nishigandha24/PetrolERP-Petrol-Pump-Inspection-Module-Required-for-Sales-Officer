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
        <form id="printPageButton" action="" method="post">
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
        if (isset($_POST["submit"])) {
            $from = (isset($_POST['from']) ? $_POST['from'] : '');
            $to = (isset($_POST['to']) ? $_POST['to'] : '');
        }

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
        $sql1 = "SELECT SUM(o.ms) as OMS, SUM(o.hsd) as OHSD, o.date as ODATE from opening_stock o where o.date='$from'";
        $data1 = mysqli_query($conn, $sql1);
        $sql2 = "SELECT SUM(c.ms) as CMS, SUM(c.hsd) as CHSD, c.date as CDATE from closing_stock c  where c.date='$from'";
        $data2 = mysqli_query($conn, $sql2);
        ?>

    </div>

    <div id="displayforms">
        <div>
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'tank_sale.php';"  value="Back">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button"  type="submit" value="print" onclick="printpage()" /> 
        </div>
        <br><br><br><br>
        <h4>Tank Sales Report</h4>
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4>

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
                if (mysqli_num_rows($data1) > 0) {
                    while ($result1 = mysqli_fetch_assoc($data1)) {
                        ?>
                        <tr>
                            <td>MS</td>
                            <td>
                                <?php
                                $r1 = $result1['OMS'];
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
                                $r3 = $result1['OHSD'];
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
                        <?php
                    }
                }
                if (mysqli_num_rows($data2) > 0) {
                    while ($result2 = mysqli_fetch_assoc($data2)) {
                        ?>
                        <tr>
                            <td>HSD</td>
                            <td>
                                <?php
                                $d1 = $result2['CMS'];
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
                                $d3 = $result2['CHSD'];
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
    </div>
</div>
<?php
$sql = "insert into sale (ms,hsd) values('$tanksaleMS','$tanksaleHSD')";
$data = mysqli_query($conn, $sql);

include_once ("footer.php");
?>
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
</script>       -->
<script type="text/javascript">
    function printpage()
    {
        window.print();
    }
</script>
</body>
</html>