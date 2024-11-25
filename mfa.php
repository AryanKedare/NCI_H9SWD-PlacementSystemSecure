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
    'MyApp',
    6,
    30,
    Algorithm::Sha1
);
if (!isset($_SESSION['mfa_secret'])) {
    $_SESSION['mfa_secret'] = $tfa->createSecret();
}
$secret = $_SESSION['mfa_secret'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_code = $_POST['mfa_code'];
    if ($tfa->verifyCode($_SESSION['mfa_secret'], $user_code)) {
        // Code is correct, save the secret to the database
        $table = ($_SESSION['role'] == 'student') ? 'students' : (($_SESSION['role'] == 'company') ? 'companys' : 'admins');
        $sql = "UPDATE $table SET mfa_secret = $1 WHERE email = $2";
        $result = pg_query_params($conn, $sql, array($_SESSION['mfa_secret'], $_SESSION['email']));
        
        if ($result) {
            echo "MFA set up successfully!";
            unset($_SESSION['mfa_secret']); // Clear the secret from session after successful setup
        } else {
            echo "Error setting up MFA.";
        }
    } else {
        echo "Invalid code. Please try again.";
    }
}

$qrCodeUrl = $tfa->getQRCodeImageAsDataUri('MyApp:' . $_SESSION['email'], $_SESSION['mfa_secret']);
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