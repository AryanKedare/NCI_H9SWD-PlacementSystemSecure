<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	
	$email= $_GET['email'];
	
	$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

	$sql1="SELECT * FROM students WHERE email = '".$_GET['email']."';";
	$result1 = pg_query($conn,$sql1);
	$row1 = pg_fetch_assoc($result1);

	echo "<img class=\"img-responsive \" src=\"CSS/Image/c1.jpg\" height=\"120px\" width=\"120px\" align=\"center\" style=\"border-radius:50%\"></img>
			  <div class=\"table-responsive table-bordered\" >            
				  <table class=\"table table-hover\">
				      <tr>
				        <th>Name</th>
						<td>".$row1['name']."</td>
				        </tr>
				      <tr>
					    <th>Email</th>
				        <td>".$row1['email']."</td>

				      </tr>
					  <tr>
					    <th>Date of Birth</th>
				        <td>".$row1['dob']."</td>

				      </tr>
					  <tr>
				        <th>Branch</th>
						<td>".$row1['branch']."</td>
				        </tr>
				      <tr>
					    <th>Year of Passing out</th>
				        <td>".$row1['year']."</td>

				      </tr>
					  <tr>
					    <th>CPI</th>
				        <td>".$row1['cpi']."</td>

				      </tr>
					  
				      <tr>
				        <th>12th Percentage</th>
						<td>".$row1['twp']."</td>
				        </tr>
				      <tr>
					    <th>10th Percentage</th>
				        <td>".$row1['tenp']."</td>

				      </tr>
					  <tr>
					    <th>Contact No.</th>
				        <td>".$row1['phone']."</td>

				      </tr>
					  
					  <tr>
				        <th>Degree</th>
						<td>".$row1['degree']."</td>
				      </tr>

					  
				    </tbody>
				  </table>
				  
				  
				</div>";
?>
</body>
</html>