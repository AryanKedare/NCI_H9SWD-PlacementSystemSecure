<?php
session_start();
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $branch = $_POST['branch'];
    $year = $_POST['year'];
    $cpi = $_POST['cpi'];
    $twp = $_POST['12p'];
    $tenp = $_POST['10p'];
    $pwd = $_POST['pwd'];
    $phone = $_POST['phone'];
    $degree = $_POST['degree'];
    
    // Hash the password
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    // Prepare the SQL query using placeholders for parameters
    $sql = "INSERT INTO students (name, email, dob, branch, year, cpi, twp, tenp, pwd, phone, degree) 
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)";

    // Prepare the statement
    if ($stmt = pg_prepare($conn, "insert_student", $sql)) {
        // Execute the statement with the provided user inputs, using the hashed password
        if (pg_execute($conn, "insert_student", array($name, $email, $dob, $branch, (int)$year, (float)$cpi, (float)$twp, (float)$tenp, $hashed_password, (int)$phone, $degree))) {
            pg_close($conn);
            echo "<SCRIPT type='text/javascript'>
                    alert('Account Created!');
                    window.location.replace('index.html');
                  </SCRIPT>";
        } else {
            echo "Error: Could not execute query.";
        }
    } else {
        echo "Error: Could not prepare query.";
    }
}
?>