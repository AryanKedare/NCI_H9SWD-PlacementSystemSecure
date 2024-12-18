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
					<li class="active"><a href="student_dash.php">Home</a></li>
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
    $pwd = $_POST['pwd'];

    // Prepare and execute the first query
    $sql1 = "SELECT pwd FROM students WHERE email = $1";
    $result = pg_query_params($conn, $sql1, array($uname));

    if (pg_num_rows($result) == 0) {
        phpAlert("Wrong username entered!");
    } else {
        $row = pg_fetch_assoc($result);
        if (password_verify($pwd, $row["pwd"])) {
            // Prepare and execute the delete queries
            $sql2 = "DELETE FROM students WHERE email = $1";
            $result2 = pg_query_params($conn, $sql2, array($uname));

            $sql3 = "DELETE FROM applications WHERE s_mail = $1";
            $result3 = pg_query_params($conn, $sql3, array($uname));

            echo "<SCRIPT type='text/javascript'>
                alert('Deleted');
                window.location.replace(\"index.html\");
            </SCRIPT>";
        } else {
            phpAlert("Wrong password!");
        }
    }
}

pg_close($conn);
?>
		
	</head>
	<body>
	<div class="well container-fluid text-center" id="frm1">
		<form action="" method="POST">
			<div>
				<label for="usrnm"><b>Enter Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" id="usrnm" required>
			</div>
			<div>
				<label for="pswrd"><b>Enter Password</b></label>
				<input type="password" placeholder="Enter Password" name="pwd" id="pswrd" required>
			</div>
			<div>
				<button type="submit">Delete</button>
			</div>
        </form>
</div>
	
		
	</body>
</html>
