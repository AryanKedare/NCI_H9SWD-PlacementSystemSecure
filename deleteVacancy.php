
<?php
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

	if($_SERVER["REQUEST_METHOD"]=="POST"){
        $job_id = $_POST['job_id'];
		$usql="Delete from vacancy where job_id='".$_POST['job_id']."';"; 
		 $uresult=pg_query($conn,$usql);
		 pg_close($conn);
		 
		header('Location: company_dash.php');
	
	}
?>
