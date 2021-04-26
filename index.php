<?php
ob_start();
session_start(); 
?>
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
$user_id = $_SESSION['user_id'];
$sql2 = "SELECT * FROM users where user_type = (SELECT user_id from super_admin_login where user_id = $user_id)"; 
$result = $mysqli->query($sql2); 
$count=mysqli_num_rows($result); 

  if($count>0){

  
 $studentdata;
while($row = $result->fetch_array()) { 
    $_SESSION['user_id'] = $row['id']; 
    $studentdata[] = array( 
        "id" => $row["id"], 
        "name" => $row["name"], 
        "parent" => $row["parent"], 
        "firstname" => $row["firstname"],
         "lastname"   => $row["lastname"],
         // "company_name" => $row["company_name"],
    ); 
} 
}

$mysqli->close(); 

?>
        <!-- // the main content start now -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">New Employee</h3>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add New Employee</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <input type="text" class="form-control" placeholder="Position" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sel1">Select Position:</label>
                                                <?php if($count > 0){ ?>
                                                    <select class="form-control" id="" name="parent" required>
                                                    <?php 
                                                for($m=0; $m < sizeof($studentdata); $m++){ ?>
                                                    <option value="<?php echo $studentdata[$m]['id'];?>"><?php echo $studentdata[$m]['firstname'];?> <?php echo $studentdata[$m]['lastname'];?>(<?php echo $studentdata[$m]['name'];?>)</option>
                                                    <?php }?>
                                                </select>
                                                
                                                <?php } else {
                                                ?>
                                                <input type="text" class="form-control" placeholder="Position" name="parent" value="0" readonly>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sel1">Select Company :</label>

                                                <?php
                                                $user = 'root'; 
                                                $database = 'org';  
                                                $servername ='localhost'; 

                                            $mysqli = new mysqli($servername,  
                                            $user, $password, $database); 
   
                                            if ($mysqli->connect_error) { 
                                             die('Connect Error (' .  
                                               $mysqli->connect_errno . ') '.  
                                              $mysqli->connect_error); 
                                                } 
                                             $sql2 = "SELECT * FROM company_master"; 
                                            $result = $mysqli->query($sql2); 
                                            $count=mysqli_num_rows($result); 
                                            ?>
                                            <select class="form-control" id="" name="compname" required>
                                                <?php
                                              if($count>0){

                                                while($row = $result->fetch_array()) { 
                                                       $company_name =  $row ['comp_name'];
                                                       ?>
                                                           <option><?php echo $company_name; ?></option>

                                                     
                                                       <?php
                                                   
                                                }

                                              }
                                           
                                                ?> 
                                                  </select>
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
    $sql = "INSERT INTO users(firstname,lastname,name,parent,user_type,company_name)VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["name"]."','".$_POST["parent"]."','". $user_id."','".$_POST["compname"]."')";

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
         session_commit();
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