<!doctype html>
<html lang="en">

<head>
    <title>Organization Chart</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
    <div id="wrapper">
        <?php
include "top_header.php" ;
include "navbar.php" ;

$user = 'root'; 
$password = '';  
$database = 'org';  
$servername ='localhost'; 

$mysqli = new mysqli($servername,  
    $user, $password, $database); 
   
if ($mysqli->connect_error) { 
    die('Connect Error (' .  
        $mysqli->connect_errno . ') '.  
        $mysqli->connect_error); 
} 
  
// SQL query to select data 
// from database 
$sql2 = "SELECT * FROM company_master"; 
$result = $mysqli->query($sql2); 
$count=mysqli_num_rows($result); 
$mysqli->close(); 
?>
        <!-- // the main content start now -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">New Company</h3>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add New Company</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="comp_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="comp_address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control" placeholder="Position" name="comp_pincode">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" class="form-control" placeholder="Position" name="comp_contact">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Position" name="comp_email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-block" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <?php
         if(isset($_POST["submit"])){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "org";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

//             Check connection
            if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
            } 
            $sql = "INSERT INTO company_master(comp_name,comp_address,comp_pincode,comp_contact,comp_email)VALUES ('".$_POST["comp_name"]."','".$_POST["comp_address"]."','".$_POST["comp_pincode"]."','".$_POST["comp_contact"]."','".$_POST["comp_email"]."')";

            if (mysqli_query($conn, $sql)) {
               echo '<script>alert("New Record Added SuccessFully")</script>'; 
               // header("Location: index.php");
             // exit();
               echo '<script>window.location.href = "index.php";</script>';
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
         }
      ?>
        </div>
    </div>
    <?php  
include "footer.php" ;
?>


    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>

</body>

</html>