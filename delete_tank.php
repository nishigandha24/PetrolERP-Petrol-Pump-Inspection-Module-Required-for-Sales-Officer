<?php
include ("connection.php");
error_reporting(0);
$id = $_GET['id'];

$query = "DELETE FROM tank WHERE tank_id = '$id' ";
$data = mysqli_query($conn, $query);
if ($data) {
    ?>
    <script >
        alert("Tank Data Deleted Successfully!!!");
    </script>    
  <?php
   header("Location:display_tank.php");
}
?>