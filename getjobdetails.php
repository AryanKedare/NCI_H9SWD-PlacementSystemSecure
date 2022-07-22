<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
session_start();
$job_id = $_GET['job_id'];
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

$sql="SELECT * FROM vacancy WHERE job_id = '".$_GET['job_id']."';";
$result = pg_query($conn,$sql);



echo "<div class=\"table-responsive table-bordered\" >            
				  <table class=\"table table-hover\">
				  <tr>
				   <th>Job Title</th>
				   <th>Salary</th>
				   <th>Location</th>
				   </tr>
				   ";
			while($row = pg_fetch_assoc($result)){	   
					echo		   "
				   <tr>
				   <td>".$row['job_title']."</td>
				   <td>".$row['salary']."</td>
				   <td>".$row['location']."</td>
				   </tr>";
			}		   
			echo	   "
				   </table>";
				   
				
				   
			echo "</div>";		

?>
</body>
</html>