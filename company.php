<?php
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $ceo = $_POST['ceo'];
    $cto = $_POST['cto'];
    $hr = $_POST['hr'];
    $worth = $_POST['worth'];
    $found = $_POST['found'];
    $founder = $_POST['founder'];

    // Prepare the SQL statement with placeholders ($1, $2, etc.)
    $sql = "INSERT INTO companys (name, email, pwd, phone, location, ceo, cto, hr, worth, found, founder) 
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)";

    // Prepare the statement
    pg_prepare($conn, "insert_company", $sql);

    // Execute the prepared statement with user inputs as parameters
    if(pg_execute($conn, "insert_company", [$name, $email, $pwd, (int)$phone, $location, $ceo, $cto, $hr, (float)$worth, (int)$found, $founder])){
        pg_close($conn);
        echo "<SCRIPT type='text/javascript'>
                alert('Account Created!');
                window.location.replace('index.html');
              </SCRIPT>";
    } else {
        echo "Error: Could not execute the query.";
    }
}
?>