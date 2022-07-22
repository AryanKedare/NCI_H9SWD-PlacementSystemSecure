<?php
	$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pwd=$_POST['pwd'];
		$phone=$_POST['phone'];
		$location=$_POST['location'];
		$ceo=$_POST['ceo'];
		$cto=$_POST['cto'];
		$hr=$_POST['hr'];
		$worth=$_POST['worth'];
		$found=$_POST['found'];
		$founder=$_POST['founder'];
		
		/*echo $name . "<BR>";
		echo $email. "<BR>";
		echo $dob. "<BR>";
		echo $branch. "<BR>";
		echo $year. "<BR>";
		echo $cpi. "<BR>";
		echo $twp. "<BR>";
		echo $tenp. "<BR>";
		echo $pwd. "<BR>";
		echo $phone. "<BR>";
		echo $degree. "<BR>";*/
		
		$sql="INSERT into companys values('$name','$email','$pwd',$phone,'$location','$ceo','$cto','$hr',$worth,$found,'$founder');";
		if(pg_query($conn,$sql)==TRUE){
			pg_close($GLOBALS['conn']);
		echo "<SCRIPT type='text/javascript'> //not showing me this
								alert('Account Created!');
								window.location.replace(\"index.html\");
							</SCRIPT>";
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}
	
	
	

?>