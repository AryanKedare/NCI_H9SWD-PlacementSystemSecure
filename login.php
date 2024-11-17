<?php
session_start();
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $type = $_POST['type'];

    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    // Prepare the SQL query based on the user type
    if ($type === "Student") {
        $sql = "SELECT pwd FROM students WHERE email = $1";
    } elseif ($type === "Company") {
        $sql = "SELECT pwd FROM companys WHERE email = $1";
    } elseif ($type === "Admin") {
        $sql = "SELECT pwd FROM admins WHERE email = $1";
    } else {
        echo "<SCRIPT type='text/javascript'>
                alert('Wrong username or password to continue as admin');
                window.location.replace(\"index.html\");
              </SCRIPT>";
        exit();
    }

    // Prepare and execute the query using parameterized queries
    $result = pg_prepare($conn, "login_query", $sql);
    $result = pg_execute($conn, "login_query", array($uname));

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        if ($row["pwd"] === $pwd) {
            // Set session variables based on user type
            $_SESSION['email'] = $uname;
            if ($type === "Student") {
                header('Location: student_dash.php');
                exit();
            } elseif ($type === "Company") {
                header('Location: company_dash.php');
                exit();
            } elseif ($type === "Admin") {
                header('Location: admin_dash.php');
                exit();
            }
        } else {
            echo "<SCRIPT type='text/javascript'>
                    alert('Invalid username or password');
                    window.location.replace(\"index.html\");
                  </SCRIPT>";
        }
    } else {
        echo "<SCRIPT type='text/javascript'>
                alert('User does not exist!');
                window.location.replace(\"index.html\");
              </SCRIPT>";
    }
}

pg_close($conn);
?>