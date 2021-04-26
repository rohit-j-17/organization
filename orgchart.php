 
<html>
<head>
<title>Organization Chart</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
<link href="jquery.orgchart.css" media="all" rel="stylesheet" type="text/css" />
<style type="text/css">
#orgChart{
    width: auto;
    height: auto;
}

#orgChartContainer{
    width: auto;
    height: auto;
    overflow: auto;
    background: #eeeeee;
    padding-top: 100px;
}
@media print
{
    #pager,
    form,
    .no-print
    {
        display: none !important;
        height: 0;
    }


    .no-print, .no-print *{
        display: none !important;
        height: 0;
    }
}
</style>
<div class="no-print">
<?php
 ob_start();
session_start(); 
?>
</div>
</head>
<body><?php include "top_header.php" ; ?>
    <br>
    <br>
                                          
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   
<div class="jquery-script-clear"></div>
<h2 align="center" onclick="window.print(orgChart)">Organization Chart</h2>
<div id="orgChartContainer">
<div id="orgChart" align="center"></div>
</div>
<h1 class="no-print" align="center"><a href="index.php"> Back On Index Screen</a></h1>
<div id="consoleOutput">
</div>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.orgchart.js"></script>
<?php
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
$sql2 = "SELECT * FROM users where  user_type = (SELECT user_id from super_admin_login where user_id = $user_id)"; 
$result = $mysqli->query($sql2); 
  
 $studentdata;
while($row = $result->fetch_array()) { 
    $studentdata[] = array( 
        "id" => $row["id"], 
        "name" => $row["name"], 
        "parent" => $row["parent"], 
        "firstname" => $row["firstname"],
         "lastname"   => $row["lastname"],
         "company_name" => $row["company_name"],
         "other_to_reporting" => $row["other_to_reporting"],
         "image" => $row["image"],
        
    ); 
} 
?>
    <script type="text/javascript">
       var testData =  <?php print_r(json_encode($studentdata));?>;
         $(function(){
        org_chart = $('#orgChart').orgChart({
            data: testData,
        });
    });
         session_commit();
    </script>
  
</body>
</html>