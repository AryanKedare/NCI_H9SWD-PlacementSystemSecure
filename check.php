<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	
	$job_id= $_GET['job_id'];
	$s_mail= $_GET['s_mail'];
	
	$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");


	$sql1="SELECT * FROM students WHERE email = '".$s_mail."'";
	$result1 = pg_query($conn,$sql1);
	$row1 = pg_fetch_assoc($result1);

	$sql2="SELECT * FROM vacancy WHERE job_id = '".$job_id."'";
	$result2 = pg_query($conn,$sql2);
	$row2 = pg_fetch_assoc($result2);
	
	//Pending!
	//echo $row1['degree']." ".$row2['degree_e']." ".$row1['cpi']." ".$row2['cpi_e'] ." ". $row1['year']." ".$row2['year_e'] ." ". $row1['12p']." ".$row2['12p_e'] ." ". $row1['10p']." ".$row2['10p_e'] ;
	
	if($row1['degree']==$row2['degree_e'])
		echo "Degree required ".$row2['degree_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "Degree required ".$row2['degree_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['cpi']>=$row2['cpi_e'])
		echo "CPI required greater than ".$row2['cpi_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "CPI required greater than ".$row2['cpi_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['year']>=$row2['year_e'])
		echo "Year of passing required greater than ".$row2['year_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "Year of passing required greater than ".$row2['year_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['twp']>=$row2['twtp_e'])
		echo "12th %age required greater than ".$row2['twtp_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "12th %age required greater than ".$row2['twtp_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['tenp']>=$row2['tetp_e'])
		echo "10th %age required greater than ".$row2['tetp_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "10th %age required greater than ".$row2['tetp_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	
	if($row1['degree']==$row2['degree_e'] && $row1['cpi']>=$row2['cpi_e'] && $row1['year']>=$row2['year_e'] && $row1['twp']>=$row2['twtp_e'] && $row1['tenp']>=$row2['tetp_e']  ){
		echo "<H3>You're eligible!</H3><BR>";
		echo "<input type=\"button\" value=\"Apply\" onclick=\"apply_fun('".$job_id."','".$s_mail."','".$row2['company_name']."',this)\">";
	}else{
		echo "<H3>You're not eligible!</H3><BR>";
	}
?>
</body>
<footer>
</footer>
</html>