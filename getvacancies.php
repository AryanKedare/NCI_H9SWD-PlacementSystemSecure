<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
session_start();
$name = $_GET['name'];
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

$sql="SELECT * FROM vacancy WHERE company_name='".$_GET['name']."';";
$result = pg_query($conn,$sql);



echo "<div class=\"table-responsive table-bordered\" >            
				  <table class=\"table table-hover\">
				  <tr>
				   <th>Job Title</th>
				   <th>Salary</th>
				   <th>Location</th>
				   <th>Eligiblity</th>
				   </tr>
				   ";
			while($row = pg_fetch_assoc($result)){	   
					echo		   "
				   <tr>
				   <td>".$row['job_title']."</td>
				   <td>".$row['salary']."</td>
				   <td>".$row['location']."</td>";
				   
				   $sql1="SELECT * FROM applications WHERE s_mail = '".$_SESSION['name']."' AND job_id=".$row['job_id']."";
				   $result1 = pg_query($conn,$sql1);
				   
				   if(pg_num_rows($result1) != 0){
				    $row1 = pg_fetch_assoc($result1);
							if($row1['status'] == 0){
								echo "<td>Status: Pending</td>";  
							}elseif($row1['status'] == 1){
								echo "<td>Status: Accepted!</td>";  
							}else {
								echo "<td>Status: Rejected!</td>";  
							}
				   
				   }else{
					   echo" <td>
				   
									<input type=\"button\" value=\"Check eligiblity\" onclick=\"msg('".$row['job_id']."','".$_SESSION['email']."',this)\">
				   
						</td>";
					}
				   
				   echo "</tr>";
			}		   
			echo	   "
				   </table>
				   </div>";		

?>
</body>
</html>