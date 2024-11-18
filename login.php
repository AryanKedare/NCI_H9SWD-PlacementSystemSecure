<?php
session_start();
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("Connection Failed");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];

    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    // Prepare the SQL query based on the user type
    $sql = "
        SELECT 'student' AS role, pwd FROM students WHERE email = $1
        UNION ALL
        SELECT 'company' AS role, pwd FROM companys WHERE email = $1
        UNION ALL
        SELECT 'admin' AS role, pwd FROM admins WHERE email = $1
    ";

    // Prepare and execute the query using parameterized queries
    $result = pg_prepare($conn, "login_query", $sql);
    $result = pg_execute($conn, "login_query", array($uname));

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);

        if ($row["pwd"] === $pwd) {
            // Set session variables based on user type
            $_SESSION['email'] = $uname;
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === "student") {
                header('Location: student_dash.php');
                exit();
            } elseif ($row['role'] === "company") {
                header('Location: company_dash.php');
                exit();
            } elseif ($row['role'] === "admin") {
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