
<?php
ob_start();
session_start();

require_once('config.php');

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM users where user_type = (SELECT user_id from super_admin_login where user_id = $user_id)";
$result = $db->query($sql);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
session_commit();
?>
<script type="text/javascript">
	
</script>
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
	 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
	 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
</head>

<body>
	<!-- WRAPPER -->
<div id="wrapper">
<?php
include "top_header.php" ;
include "navbar.php" ;
?>

		<!-- // the main content start now -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">List Of All Employee</h3>
					 <div id="toastr-demo" class="panel">
	<div class="panel-body">
<table id="userTable"  class="table table-striped" style="width:100%">
    <thead>
    	<th>Employee Code</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Designation</th>
        <th>Parent Employee</th>
        <th>Company Name</th>
        <th>Previous Department</th>
        <th>Previous CTC</th>
        <th>Previous Location</th>
        <th>Year Experience</th>
        <th>DOB</th>
        <th>Action</th>

    </thead>
    <tbody>
        <?php if(!empty($arr_users)) { ?>
            <?php foreach($arr_users as $user) { ?>
                <tr>
                	<td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['firstname']; ?></td>
                    <td><?php echo $user['lastname']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['parent']; ?></td>
                    <td><?php echo $user['company_name']; ?></td>
                    <td><?php echo $user['previous_department']; ?></td>
                    <td><?php echo $user['previous_ctc']; ?></td>
                     <td><?php echo $user['previous_location']; ?></td>
                     <td><?php echo $user['year_of_experience']; ?></td> 
                      <td><?php echo $user['dob']; ?></td> 

                   
                    <td><a href="delete-process.php?id=<?php echo $user["id"]; ?>">Delete</a></td>

                </tr>
            <?php } ?>
        <?php }
        // sql to delete a record


         ?>

    </tbody>
</table>
</div>
</div>
					</div>
				</div>
			</div>

</div>
<?php
include "footer.php" ;
?>
		
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	
</body>
</html>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
    </script>
   
