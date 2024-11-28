<?php
session_start();
require_once 'C:/Users/aryan/vendor/autoload.php';
include("conn.php");
use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\BaconQrCodeProvider;
use RobThree\Auth\Algorithm;

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('Location: index.html');
    exit();
}

$tfa = new TwoFactorAuth(
    new BaconQrCodeProvider(),
    'CAII',
    6,
    30,
    Algorithm::Sha1
);

if (!isset($_SESSION['mfa_secret']) || empty($_SESSION['mfa_secret'])) {
    $_SESSION['mfa_secret'] = $tfa->createSecret();
}

$secret = $_SESSION['mfa_secret'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_code = $_POST['mfa_code'];
    if ($tfa->verifyCode($secret, $user_code)) {
        $table = ($_SESSION['role'] == 'student') ? 'students' : (($_SESSION['role'] == 'company') ? 'companys' : 'admins');
        $sql = "UPDATE $table SET mfa_secret = $1 WHERE email = $2";
        $result = pg_query_params($conn, $sql, array($secret, $_SESSION['email']));
        
        if ($result) {
            unset($_SESSION['mfa_secret']);
            session_destroy(); // Destroy the session to force re-login
            echo "<script>
                alert('MFA set up successfully! Please login again.');
                window.location.href = 'index.html';
            </script>";
            exit();
        } else {
            echo "<script>alert('Error setting up MFA. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid code. Please try again.');</script>";
    }
}

$qrCodeUrl = $tfa->getQRCodeImageAsDataUri('CAII:' . $_SESSION['email'], $secret);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Set Up MFA</title>
</head>
<body>
    <h1>Set Up Multi-Factor Authentication</h1>
    <p>Scan this QR code with your authenticator app:</p>
    <img src="<?php echo $qrCodeUrl; ?>">
    <p>Or enter this code manually: <?php echo $secret; ?></p>
    <form method="post">
        <input type="text" name="mfa_code" placeholder="Enter the code from your app" required>
        <input type="submit" value="Verify and Enable MFA">
    </form>
</body>
</html>