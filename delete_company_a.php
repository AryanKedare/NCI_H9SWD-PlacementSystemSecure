<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="CSS/style1.css">
		<nav class="navbar navbar-fixed-top" id="top-nav">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Campus Recruitment System</a>
				</div>
				<ul id="list1" class="nav navbar-nav">
					<li class="active"><a href="admin_dash.php">Home</a></li>
					<li class="active"><a href="index.html">Logout</a></li>
					
					
				</ul>
			</div>
		</nav>
		
		<?php
session_start();

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    
    // Prepare and execute the first query
    $sql1 = "SELECT * FROM companys WHERE email = $1";
    $result = pg_query_params($conn, $sql1, array($uname));
    
    if (pg_num_rows($result) == 0) {
        phpAlert("Wrong username entered!");
    } else {
        // Prepare and execute the delete queries
        $sql2 = "DELETE FROM companys WHERE email = $1";
        $result2 = pg_query_params($conn, $sql2, array($uname));
        
        $sql3 = "DELETE FROM applications WHERE c_mail = $1";
        $result3 = pg_query_params($conn, $sql3, array($uname));
        
        // Get the company name
        $sql5 = "SELECT name FROM companys WHERE email = $1";
        $result5 = pg_query_params($conn, $sql5, array($uname));
        $row5 = pg_fetch_assoc($result5);
        
        if ($row5) {
            $sql4 = "DELETE FROM vacancy WHERE company_name = $1";
            $result4 = pg_query_params($conn, $sql4, array($row5['name']));
        }
        
        echo "<SCRIPT type='text/javascript'>
            alert('Deleted');
            window.location.replace(\"admin_dash.php\");
        </SCRIPT>";
    }
}

pg_close($conn);
?>		
	</head>
	<div class="well container-fluid text-center" id="frm1">
		<form action="" method="POST">
			<div>
				<label for="usrnm"><b>Enter Username of company to delete</b></label>
				<input type="text" placeholder="Enter Username" name="uname" id="usrnm" required>
			</div>
			
			<div>
				<button type="submit">Delete</button>
			</div>
        </form>
</div>
	
		
	</body>
</html>
