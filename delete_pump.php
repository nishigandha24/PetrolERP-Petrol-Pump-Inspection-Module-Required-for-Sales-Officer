<?php
include ("connection.php");
error_reporting(0);
$tname = $_GET['tname'];
$pname = $_GET['pname'];

$query = "DELETE FROM pump WHERE tank_name = '$tname' and pump_name = '$pname'";
$data = mysqli_query($conn, $query);
if ($data) {
    ?>
    <script >
        alert("Pump Data Deleted Successfully!!!");
    </script>    
    <?php
    header("Location:display_pump.php");
}
?>