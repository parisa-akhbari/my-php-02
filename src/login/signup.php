<?php
session_start();
require_once "../database/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $conf = isset($_POST['confirmpassword']) ? trim($_POST['confirmpassword']) : '';

    if (empty($username) || empty($password) || empty($conf)) {
        $_SESSION['error'] = "لطفاً همه فیلدها را پر کنید.";
        header("Location: index.php");
        exit;
    }

    if ($password !== $conf) {
        $_SESSION['error'] = "رمزهای عبور با هم مطابقت ندارند.";
        header("Location: index.php");
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $db = new DB();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "خطای پایگاه داده: " . $conn->error;
        header("Location: index.php");
        exit;
    }

    $stmt->bind_param("ss", $username, $hash);

    if ($stmt->execute()) {
        $_SESSION['success'] = "حساب کاربری با موفقیت ایجاد شد. اکنون می‌توانید وارد شوید.";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = "این نام کاربری قبلاً ثبت شده است یا خطایی رخ داده.";
        header("Location: index.php");
        exit;
    }
}
?>
