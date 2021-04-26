<!doctype html>
<html lang="en">
<head>
	<title>Organization Chart</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>

<body>
	<!-- WRAPPER -->
<div id="wrapper">
<?php
include "top_header.php" ;
include "navbar.php" ;
?>
<div style="padding-top: 100px;">
<h3 align="center">Select the Excel File From System To Upload Department Data</h3><br />
  <form method="POST" enctype="multipart/form-data"  action="loademp.php">
   <div align="center">  
    <label>Select Excel File:</label>
    <input type="file"  name="xlxsfile" id="xlxsfile" onchange="ValidateXLXSFileUpload(this);">
    <br>
    <input type="submit" name="import" value="import" class="btn btn-info" />
    <br>
    <br>
   </div>
  </form>
   <u><p align='center'><a href=""> Sample File To upload Data!</a></p></u>
    <br>
</div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray">
<div style="padding-top: 20px;">
<h3 align="center">Select the Excel File From System To Upload Organization Data</h3><br />
  <form method="POST" enctype="multipart/form-data"  action="loademp2.php">
   <div align="center">  
    <label>Select Excel File:</label>
    <input type="file"  name="xlxsfile" id="xlxsfile" onchange="ValidateXLXSFileUpload(this);">
    <br>
    <input type="submit" name="import" value="import" class="btn btn-info" />
    <br>
    <br>
   </div>
  </form>
   <u><p align='center'><a href=""> Sample File To upload Data!</a></p></u>
    <br><br>
</div>
<?php
include "footer.php" ;
?>
		</div>
    <script type="text/javascript">
      
        function ValidateXLXSFileUpload(input) 
        {      
    
            var fuData = input;
            var FileUploadPath = fuData.value;

    //To check if user upload any file
            if (FileUploadPath == '') {
                alert("Please upload an XLSX file");

            } 
            else 
            {
                var Extension = FileUploadPath.substring(
                        FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

                //The file uploaded is an image

                if (Extension == "xlsx") 
                {                           
                    
                     if (fuData.files && fuData.files[0]) {
                     
                     
                         //Initiate the FileReader object.
                        var reader = new FileReader();
                        //Read the contents of Image File.
                        reader.readAsDataURL(fuData.files[0]);
                        reader.onload = function (e) {

                             document.getElementById('xlxsfile').value = input.value;
                             return true;
                              
                                                           
                            };
                        }
                } 
                else 
                {
                    alert("Calendar only allows file types of XLSX. ");
                    input.value= "";
                }
            }
        }
        
    </script>	
</body>
</html>

