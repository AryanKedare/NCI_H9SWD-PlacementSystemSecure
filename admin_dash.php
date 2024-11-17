<?php
session_start();
$email = $_SESSION['email'] ?? '';
$name = $_SESSION['name'] ?? '';
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/style1.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top" id="top-nav">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Campus Recruitment System</a>
            </div>
            <ul id="list1" class="nav navbar-nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="delete_student_a.php">Delete Student</a></li>
                <li><a href="delete_company_a.php">Delete Company</a></li>
                <li><a href="index.html">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center">ADMIN DASHBOARD</h2>
        <div class="well" style="background-color: #AED4F1; margin-top: 20px;">
            <form method="POST" action="">
                <select name="query" class="form-control">
                    <option value="">SELECT TO CHECK</option>
                    <option value="registered_students">TOTAL REGISTERED STUDENTS</option>
                    <option value="placed_students">TOTAL PLACED STUDENTS</option>
                    <option value="registered_companies">TOTAL REGISTERED COMPANIES</option>
                    <option value="students_bangalore">STUDENTS PLACED IN BANGALORE</option>
                    <option value="students_developers">STUDENTS PLACED AS DEVELOPERS</option>
                    <option value="total_vacancies">TOTAL VACANCIES</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>

            <?php
			  if(isset($_POST['query']) && $_POST['query']=="registered_students") {
               	$sql = "SELECT * FROM students";
                $result = pg_query($conn,$sql);
				
               echo "<h4 align=\"center\">REGISTERED STUDENTS</h4>";
			   echo "<br>";
             if (pg_num_rows($result) > 0) {
                 echo "<table class=\"table table-hover\"><tr><th>Name</th><th>Email</th><th>Contact No.</th><th>D.O.B.</th><th>Degree</th><th>Branch</th><th>Year of Passing</th><th>C.P.I.</th><th>12th Percentage</th><th>10th Percentage</th></tr>";
               while($row = pg_fetch_assoc($result)) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["dob"]."</td><td>".$row["degree"]."</td><td> ".$row["branch"]."</td><td>".$row["year"]."</td><td>".$row["cpi"]."</td><td>".$row["twp"]."</td><td>".$row["tenp"]."</td></tr>";
                    }
              echo "</table>";
         }  else {
            echo "0 results";
               }
				  }
				  
				  if(isset($_POST['query']) && $_POST['query']=="total_vacancies") {
                     
               	 $sql = "SELECT * FROM vacancy";
                $result = pg_query($conn,$sql);
				
               echo "<h4 align=\"center\">TOTAL VACANCIES</h4>";
			   echo "<br>";
             if (pg_num_rows($result) > 0) {
                 echo "<table class=\"table table-hover\"><tr><th>Company Name</th><th>Job Title</th><th>Salary</th><th>Location</th><th>Bond</th></tr>";
     
               while($row = pg_fetch_assoc($result)) {
                echo "<tr><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["salary"]."</td><td>".$row["location"]."</td><td> ".$row["bond"]."</td></tr>";
                    }
              echo "</table>";
         }  else {
            echo "0 results";
               }
				  }
				  
				  
				  if(isset($_POST['query']) && $_POST['query']=="registered_companies") {
                     
               	 $sql = "SELECT * FROM companys";
                $result = pg_query($conn,$sql);
				echo "<h4 align=\"center\">REGISTERED COMPANIES</h4>";
				echo "<br>";
             if (pg_num_rows($result) > 0) {
                 echo "<table class=\"table table-hover\"><tr><th>Name</th><th>Email</th><th>Phone</th><th>Location</th><th>C.E.O.</th><th>C.T.O</th><th>H.R.</th><th>Worth</th><th>Founded in</th><th>Founder</th></tr>";
                while($row = pg_fetch_assoc($result)) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td> ".$row["phone"]."</td><td> ".$row["location"]."</td><td> ".$row["ceo"]."</td><td> ".$row["cto"]."</td><td> ".$row["hr"]."</td><td> ".$row["worth"]."</td><td> ".$row["found"]."</td><td> ".$row["founder"]."</td></tr>";
                    }
              echo "</table>";
         }  else {
            echo "0 results";
               }
				  }
				  
				  if(isset($_POST['query']) && $_POST['query']=="placed_students") {
                     
               	 $sql = "SELECT * FROM students as s,applications as a,vacancy as v where s.email=a.s_mail and a.job_id=v.job_id and a.status='1' ";
                $result = pg_query($conn,$sql);
				
                   echo "<h4 align=\"center\">PLACED STUDENTS</h4>";
				   echo "<br>";
             if (pg_num_rows($result) > 0) {
                 echo "<table class=\"table table-hover\"><tr><th>Name</th><th>Email</th><th>Contact No.</th><th>Degree</th><th>Branch</th><th>C.P.I.</th><th>12th Percentage</th><th>10th Percentage</th><th>Company</th><th>Job Title</th><th>Salary (LPA)</th><th>Location</th></tr>";
     
               while($row = pg_fetch_assoc($result)) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["degree"]."</td><td> ".$row["branch"]."</td><td>".$row["cpi"]."</td><td>".$row["twp"]."</td><td>".$row["tenp"]."</td><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["salary"]."</td><td>".$row["location"]."</td></tr>";
                    }
              echo "</table>";
         }  else {
            echo "0 results";
               }
				  }
				  
				  if(isset($_POST['query']) && $_POST['query']=="students_bangalore") {
                     
               	 $sql = "SELECT * FROM students as S,applications as A,vacancy as V where S.email=A.s_mail and A.job_id=V.job_id and A.status='1' and V.location='Banglore'";
                $result = pg_query($conn,$sql);
				
                   echo "<h4 align=\"center\">STUDENTS PLACED IN BANGLORE</h4>";
				   echo "<br>";
             if (pg_num_rows($result) > 0) {
                 echo "<table class=\"table table-hover\"><tr><th>Name</th><th>Email</th><th>Contact No.</th><th>Degree</th><th>Branch</th><th>C.P.I.</th><th>12th Percentage</th><th>10th Percentage</th><th>Company</th><th>Job Title</th><th>Salary (LPA)</th><th>Location</th></tr>";
     
               while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["degree"]."</td><td> ".$row["branch"]."</td><td>".$row["cpi"]."</td><td>".$row["twp"]."</td><td>".$row["tenp"]."</td><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["salary"]."</td><td>".$row["location"]."</td></tr>";
                    }
              echo "</table>";
         }  else {
            echo "0 results";
               }
				  }
		
				  if(isset($_POST['query']) && $_POST['query']=="students_developers") {
                     
               	 $sql = "SELECT * FROM students as S,applications as A,vacancy as V where S.email=A.s_mail and A.job_id=V.job_id and A.status='1' and V.job_title='Developer'";
                $result = pg_query($conn,$sql);
				
                   echo "<h4 align=\"center\">STUDENTS PLACED AS DEVELOPERS</h4>";
				   echo "<br>";
             if (pg_num_rows($result) > 0) {
                 echo "<table class=\"table table-hover\" ><tr><th>Name</th><th>Email</th><th>Contact No.</th><th>Degree</th><th>Branch</th><th>C.P.I.</th><th>12th Percentage</th><th>10th Percentage</th><th>Company</th><th>Job Title</th><th>Salary (LPA)</th><th>Location</th></tr>";
     
               while($row = pg_fetch_assoc($result)) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["degree"]."</td><td> ".$row["branch"]."</td><td>".$row["cpi"]."</td><td>".$row["twp"]."</td><td>".$row["tenp"]."</td><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["salary"]."</td><td>".$row["location"]."</td></tr>";
                    }
              echo "</table>";
         }  else {
            echo "0 results";
               }
				  }
           pg_close($conn);
          ?>        </div>
    </div>

    <footer>
        <!-- Footer content -->
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>