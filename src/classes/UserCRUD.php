<?php
require_once "database/database.php";

class UserCRUD {

    private $db;
    private $table = "tb_user";

    public function __construct() {
        $this->db = new DB();
    }

    // شمارش رکوردهای یک کاربر
    public function countAll($user_id) {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE user_id = $user_id";
        $res = $this->db->select($sql);

        if ($res && $row = $res->fetch_assoc()) {
            return $row['total'];
        }
        return 0;
    }

    // گرفتن لیست رکوردهای کاربر
    public function getAll($limit, $offset, $user_id) {
        $sql = "SELECT * FROM {$this->table}
                WHERE user_id = $user_id
                ORDER BY id DESC
                LIMIT $limit OFFSET $offset";

        $res = $this->db->select($sql);
        $data = [];

        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // گرفتن یک رکورد
    public function get($id, $user_id) {
        $id = (int)$id;
        $user_id = (int)$user_id;

        $sql = "SELECT * FROM {$this->table} WHERE id = $id AND user_id = $user_id LIMIT 1";
        return $this->db->getone($sql); // فقط یک رکورد یا false
}

    // ایجاد رکورد جدید
    public function create($data, $user_id) {
        $title = $this->db->escape($data['title']);
        $description = $this->db->escape($data['description']);

        $sql = "INSERT INTO {$this->table} (title, description, user_id)
                VALUES ('$title', '$description', $user_id)";

        return $this->db->insert($sql);
    }

    // ویرایش رکورد
    public function update($data, $id, $user_id) {
        $title = $this->db->escape($data['title']);
        $description = $this->db->escape($data['description']);

        $sql = "UPDATE {$this->table}
                SET title='$title', description='$description'
                WHERE id=$id AND user_id=$user_id";

        return $this->db->update($sql);
    }

    // حذف رکورد
    public function delete($id, $user_id) {
        $sql = "DELETE FROM {$this->table}
                WHERE id=$id AND user_id=$user_id";

        return $this->db->delete($sql);
    }

    // جدول HTML
    public function renderTable($limit, $offset, $user_id) {
        $records = $this->getAll($limit, $offset, $user_id);

        $out = '<div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>توضیحات</th>
                        <th>تاریخ</th>
                        <th>نمایش</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead><tbody>';

        if (!empty($records)) {
            foreach ($records as $row) {
                $id = $row['id'];
                $title = htmlspecialchars($row['title']);
                $description = htmlspecialchars($row['description']);
                $created_at = htmlspecialchars($row['created_at']);

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
            $out .= "<tr><td colspan='6' class='text-center'>هیچ داده‌ای پیدا نشد</td></tr>";
        }

        $out .= "</tbody></table></div>";

        return $out;
    }
}
