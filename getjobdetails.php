<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
session_start();
$sql = "SELECT * FROM vacancy WHERE job_id = $1";
include("conn.php");
pg_prepare($conn, "fetch_vacancy", $sql);
$result = pg_execute($conn, "fetch_vacancy", [$_GET['job_id']]);
$row = pg_fetch_array($result);


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