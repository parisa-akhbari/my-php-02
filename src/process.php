<?php
require_once "classes/UserCRUD.php"; 
header('Content-Type: application/json');

$userCRUD = new UserCRUD();

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'create':
        $id = $_POST['id'] ?? null;
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
        if ($id) {
            $success = $userCRUD->update($id, $data);
        } else {
            $success = $userCRUD->create($data);
        }
        echo json_encode(['success' => $success]);
        break;

    case 'get':
        $id = $_POST['id'] ?? 0;
        $user = $userCRUD->get($id);
        echo json_encode($user);
        break;

    case 'delete':
        $id = $_POST['id'] ?? 0;
        $success = $userCRUD->delete($id);
        echo json_encode(['success' => $success]);
        break;

    default:
        echo json_encode(['error' => 'Action not found']);
        
}

?>

