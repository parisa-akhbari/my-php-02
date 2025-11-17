<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(['error' => 'not_logged_in']);
    exit;
}

require_once "classes/UserCRUD.php";

$userCRUD = new UserCRUD();
$currentUserId = $_SESSION['user']['id'];

if (!isset($_POST['action'])) {
    echo json_encode(['error' => 'no_action']);
    exit;
}

$action = $_POST['action'];

switch ($action) {

    // -----------------------------
    // ایجاد یا ویرایش
    // -----------------------------
    case "create":
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ];

        if (empty($_POST['id'])) {
            // INSERT
            $result = $userCRUD->create($data, $currentUserId);
        } else {
            // UPDATE
            $id = intval($_POST['id']);
            $result = $userCRUD->update($data, $id, $currentUserId);
        }

        echo json_encode(['success' => $result]);
        break;


    // -----------------------------
    // گرفتن یک رکورد برای نمایش یا ویرایش
    // -----------------------------
    case "get":
        $id = intval($_POST['id']);
        $row = $userCRUD->get($id, $currentUserId);
        echo json_encode($row);
        break;


    // -----------------------------
    // حذف
    // -----------------------------
    case "delete":
        $id = intval($_POST['id']);
        $result = $userCRUD->delete($id, $currentUserId);
        echo json_encode(['success' => $result]);
        break;
}
