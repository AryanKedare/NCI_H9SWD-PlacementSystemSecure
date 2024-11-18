<!DOCTYPE html>
<html>
<head>
    <title>Job Vacancies</title>
</head>
<body>

<?php
session_start();
$name = $_GET['name'] ?? '';

$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

// Prepare the SQL statements outside the loop
$sql = "SELECT * FROM vacancy WHERE company_name = $1";
$stmt = pg_prepare($conn, "get_vacancies", $sql);

$sql1 = "SELECT * FROM applications WHERE s_mail = $1 AND job_id = $2";
$stmt1 = pg_prepare($conn, "get_application", $sql1);

// Execute the prepared statement for vacancies
$result = pg_execute($conn, "get_vacancies", array($name));

if (!$result) {
    die("Query execution failed: " . pg_last_error($conn));
}

echo "<div class=\"table-responsive table-bordered\">            
        <table class=\"table table-hover\">
        <tr>
            <th>Job Title</th>
            <th>Salary</th>
            <th>Location</th>
            <th>Eligibility</th>
        </tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>
           <td>".$row['job_title']."</td>
           <td>".$row['salary']."</td>
           <td>".$row['location']."</td>";

    // Execute the prepared statement for applications
    $result1 = pg_execute($conn, "get_application", array($_SESSION['name'] ?? '', $row['job_id']));

    if (!$result1) {
        die("Query execution failed: " . pg_last_error($conn));
    }

    if (pg_num_rows($result1) != 0) {
        $row1 = pg_fetch_assoc($result1);
        if ($row1['status'] == 0) {
            echo "<td>Status: Pending</td>";  
        } elseif ($row1['status'] == 1) {
            echo "<td>Status: Accepted!</td>";  
        } else {
            echo "<td>Status: Rejected!</td>";  
        }
    } else {
        echo "<td>
            <input type=\"button\" value=\"Check eligiblity\" onclick=\"msg('".$row['job_id']."','".$_SESSION['email']."',this)\">
        </td>";
    }

    echo "</tr>";
}

echo "</table>
    </div>";

pg_close($conn);
?>

</body>
</html>