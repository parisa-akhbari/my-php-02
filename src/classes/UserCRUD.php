<?php
require_once "database/database.php";
require_once 'jdf.php'; 

class UserCRUD {
    private $conn;
    private $table = "tb_user";
    private $iran_offset = 12600; 

    public function __construct() {
        $this->conn = new DB(); // یکبار اتصال به دیتابیس
    }

    // افزودن کاربر
    public function create($data) {
        $title = $this->conn->escape($data['title']);
        $description = $this->conn->escape($data['description']);
        $query = "INSERT INTO {$this->table} (title, description) VALUES ('$title', '$description')";
        return $this->conn->insert($query);
    }

    // بروزرسانی کاربر
    public function update($id, $data) {
        $title = $this->conn->escape($data['title']);
        $description = $this->conn->escape($data['description']);
        $query = "UPDATE {$this->table} SET title='$title', description='$description' WHERE id=$id";
        return $this->conn->insert($query);
    }

    // حذف کاربر
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id=$id";
        
        return $this->conn->insert($query);

    }

    // گرفتن یک کاربر
    public function get($id) {
        $query = "SELECT * FROM {$this->table} WHERE id=$id";
        $result = $this->conn->select($query);
        return $result ? $result->fetch_assoc() : null;
    }

    // گرفتن همه کاربران
    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->conn->select($query);
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }


    public function getPaginated($limit, $offset) {
    $query = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $result = $this->conn->select($query);

    $rows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}

public function countAll() {
    $query = "SELECT COUNT(*) AS total FROM {$this->table}";
    $result = $this->conn->select($query);
    $row = $result->fetch_assoc();
    return $row['total'];
}


    // ساخت جدول HTML برای نمایش کاربران
   public function renderTable($limit, $offset) {

    $users = $this->getPaginated($limit, $offset);

    $out = "<div class='table table-responsive'>
                <table class='table table-bordered table-striped table-light'>
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>تاریخ ایجاد</th>
                            <th>نمایش</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>";

    if (!empty($users)) {
        foreach ($users as $row) {

            $id = $row['id'];
            $title = htmlspecialchars($row['title']);
            $description = htmlspecialchars($row['description']);
            $created_at = jdate("Y/m/d H:i:s", strtotime($row['created_at']) + $this->iran_offset);

            $out .= "<tr>
                        <td>{$title}</td>
                        <td>{$description}</td>
                        <td>{$created_at}</td>
                        <td><button class='btn btn-primary view_data' id='{$id}'>نمایش</button></td>
                        <td><button class='btn btn-success edit_data' id='{$id}'>ویرایش</button></td>
                        <td><button class='btn btn-danger delete_data' id='{$id}'>حذف</button></td>
                     </tr>";
        }
    } else {
        $out .= "<tr><td colspan='6' class='text-center'>داده‌ای یافت نشد!</td></tr>";
    }

    $out .= "</tbody></table></div>";

    return $out;
}


    
}
?>
