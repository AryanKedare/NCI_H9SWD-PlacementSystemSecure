<?php
// Start session with secure parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
session_start();

include("conn.php");

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

        if (password_verify($pwd, $row["pwd"])) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);

            // Set session variables based on user type
            $_SESSION['email'] = $uname;
            $_SESSION['role'] = $row['role'];

            // Set a secure cookie
            $cookie_options = array(
                'expires' => time() + 3600,  // 1 hour expiration
                'path' => '/',
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => true,     // Only transmit over HTTPS
                'httponly' => true,   // Not accessible to JavaScript
                'samesite' => 'Strict' // Strict same-site policy
            );
            setcookie('user_session', hash('sha256', $uname . $_SERVER['REMOTE_ADDR']), $cookie_options);

            // Redirect based on user role
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
            phpAlert('Invalid username or password');
            echo "<script>window.location.replace('index.html');</script>";
        }
    } else {
        phpAlert('User does not exist!');
        echo "<script>window.location.replace('index.html');</script>";
    }
}

pg_close($conn);
?>