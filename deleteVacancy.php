
<?php
include("conn.php");

	if($_SERVER["REQUEST_METHOD"]=="POST"){
        $job_id = $_POST['job_id'];
		$usql="Delete from vacancy where job_id='".$_POST['job_id']."';"; 
		 $uresult=pg_query($conn,$usql);
		 pg_close($conn);
		 
		header('Location: company_dash.php');
	
	}
?>
