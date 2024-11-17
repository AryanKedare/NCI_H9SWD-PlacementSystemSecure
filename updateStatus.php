
<?php
	$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

	if($_SERVER["REQUEST_METHOD"]=="POST"){
        $app_id = $_POST['app_id'];
		$status = $_POST['status'];
		
        //echo $app_id." ".$status;
		 
	
		$usql = "UPDATE applications SET status = $1 WHERE app_id = $2";
		pg_prepare($conn, "update_application_status", $usql);
		$uresult = pg_execute($conn, "update_application_status", [$status, $app_id]);
		pg_close($conn);
		header('Location: company_dash.php');
	
	}
?>
