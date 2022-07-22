
<?php
	$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

	if($_SERVER["REQUEST_METHOD"]=="POST"){
        $app_id = $_POST['app_id'];
		$status = $_POST['status'];
		
        //echo $app_id." ".$status;
		 
	
		 $usql="Update applications set status=".$status." where app_id=".$app_id."";		
		 $uresult=pg_query($conn,$usql);
		 pg_close($conn);
		header('Location: company_dash.php');
	
	}
?>
