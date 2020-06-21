<?php
include ("connection.php");
error_reporting(0);
?>
<?php
include_once ("header.php");
?>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">

</nav>
<style>
    input[type=text], input[type=number],input[type=date] select {
        width:50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        padding-left:10px;
        margin-right: 20px;
        align-items: center;
    }
    input[type=submit], input[type=button] {
        width: 10%;
        background-color: #59b9f2;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        margin-right: 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type=submit],input[type=button]:hover {
        background-color: #43BCF8;
    }
    form{
        text-align: justify;
        padding-top:23px;
    }
    #image{
        text-align: center;
        margin: auto;
        position:absolute;
        left:20%;
        top:80%;
    }
    label[for=image]{
        text-align:left;
        position:absolute;
        right:81%;
        top:80%;
    }
    address{
        text-align:left;
    }
    div.sample{
        position: absolute;
        top:79%;
        right:58%;  
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
    <div>
        <h4 style="text-align:center; color:black; padding:10px;"><b>Company Profile</b></h4>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="cname">Company Name : </label>
        <input type="text" id="companyname" name="companyname" placeholder="Enter company name "/><br/><br/>

        <label for="did">Dealer Id : </label>
        <input type="text" id="did" name="did" placeholder="Enter Dealer ID "/><br/><br/>

        <label for="dname">Dealer Name : </label>
        <input type="text" id="dealername" name="dealername" placeholder="Enter Dealer name "/><br/><br/>

        <label for="address">Dealer Address : </label>
        <textarea rows = "4" cols = "50" name="address" ></textarea><br/><br/>

        <label for="mobile">Mobile No : </label>
        <input type="number" id="mobile" name="mobile" placeholder="Enter Mobile No" maxlength="10"/><br/><br/>

        <label for="image">Choose Logo for Company : </label><br/><br/>
        <input type="file" name="image" id="image"  accept="image/*"/><br/><br/>

        <input type="submit" value="Save"  name="submit"> 
        <input type="button" value="Exit" onClick="location = 'index.php';">

    </form>
    <?php
    if ($_POST['submit']) {
        $cname = (isset($_POST['companyname']) ? $_POST['companyname'] : '');
        $did = (isset($_POST['did']) ? $_POST['did'] : '');
        $dname = (isset($_POST['dealername']) ? $_POST['dealername'] : '');
        $add = (isset($_POST['address']) ? $_POST['address'] : '');
        $mobile = (isset($_POST['mobile']) ? $_POST['mobile'] : '');
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        if ($cname != "" && $did != "" && $dname != "" && $add != "" && $mobile != "" && $file != "") {
            $sql = "insert into company_master (cname,dealer_id,dealer_name,address,mobile,logo) values ('$cname','$did','$dname','$add','$mobile','$file')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                ?> 
                <script>
                    alert("Company Profile Registred Successfully!!!");
                </script>
                <?php
            }
        } else {
            echo " All fields are required";
        }
    }
    ?>
</div>
<?php
include_once ("footer.php");
?>
<script>
    $(document).ready(function () {
        $('#submit').click(function () {
            var image_name = $('#image').val();
            if (image_name == '')
            {
                alert("Please Select Image");
                return false;
            } else
            {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
                {
                    $('#image').val('');
                    return false;
                }
            }
        });
    });
</script> 
</body>
</html>