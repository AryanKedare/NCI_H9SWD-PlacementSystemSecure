<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	
	$job_id= $_GET['job_id'];
	$s_mail= $_GET['s_mail'];
	$c_name= $_GET['c_name'];
	
	$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

	$sql1="SELECT email FROM companys WHERE name = '".$c_name."'";
	$result1 = pg_query($conn,$sql1);
	$row1 = pg_fetch_assoc($result1);
	$c_mail= $row1['email'];
	
	
	//echo $job_id." ".$s_mail." ".$c_mail;
	$sql3="SELECT * from applications where job_id=".$job_id." AND s_mail='".$s_mail."'";
	$result3 = pg_query($conn,$sql3);
	if(pg_num_rows($result3) != 0){
		echo "<H3> Already Applied!</H3><BR>";
		$row = pg_fetch_assoc($result3);
		if($row['status'] == 0){
			echo "<H3> Status Pending! </H3>";
		}elseif($row['status'] == 1){
			echo "<H3> Accepted!</H3>";
		}else {
			echo "<H3> Rejected!</H3>";
		}
	}else{
		$sql2="INSERT into applications(job_id,s_mail,c_mail,status) values(".$job_id.",'".$s_mail."','".$c_mail."',0)";
		$result2= pg_query($conn,$sql2);
		echo "<H3> Applied successfully!! </H3>";
	}
	
?>
</body>
</html>