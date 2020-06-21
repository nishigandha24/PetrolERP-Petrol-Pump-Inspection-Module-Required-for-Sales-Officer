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
        ?>
    </div>

    <div id="displayforms" >
        <div>
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="exit" onClick="window.location = 'home.php';"  value="Exit">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button" name="back" onClick="window.location = 'testdetails.php';"  value="Back">
            <input id="printPageButton" style="float:right; margin: 20px;" type="button"  type="submit" value="print" onclick="printpage()" /> 
        </div>
        <br><br><br><br>
        <h4>Testing Report</h4>
        <h4><?php echo $from; ?> &nbsp;To&nbsp; <?php echo $to; ?></h4>  <br><br>
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
    </div>
</div>

<?php
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
</script>-->
<script type="text/javascript">
    function printpage()
    {
        window.print();
    }
</script>
</body>
</html>