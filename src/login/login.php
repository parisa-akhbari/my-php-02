<?php
session_start();
require_once "../database/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $db = new DB();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "username" => $user['username']
            ];

            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['error'] = "رمز عبور اشتباه است.";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "کاربری با این نام کاربری یافت نشد.";
        header("Location: index.php");
        exit;
    }
}
?>
