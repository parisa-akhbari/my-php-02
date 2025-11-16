
<?php
    require_once "../database/database.php";
    $conn = new DB();
    $table = "tb_user";
    
    $id = $_POST['id'];  
    $title = $_POST['title'];
    $description = $_POST['description'];
    //$web = $_POST['web'];
    
    if ($id == "") {
        $query = "INSERT INTO $table(title,description) VALUES('$title','$description')";
    } else {
        $query = "UPDATE $table SET title='$title',description='$description' WHERE id=$id";
    }
    
    $conn->insert($query);

?>