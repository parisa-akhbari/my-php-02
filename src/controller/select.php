<?php 
    $id = $_POST['id'];
    require_once "../database/database.php";
    $conn = new DB();
    $table = "tb_user";

    $query = "SELECT * FROM $table WHERE id = $id";
    $result = $conn->select($query);
    $out = "";
    $out.="<div class='table table-responsive'>
                <table class='table table-bordered'>";
    while ($row = $result->fetch_array()) {
        $out.="<tr>
                    <td width='30%'><label>Title</label></td>
                    <td width='70%'>".$row["title"]."</td>
               </tr>";
        $out.="<tr>
                    <td width='30%'><label>Description</label></td>
                    <td width='70%'>".$row["description"]."</td>
               </tr>";
               
     //    $out.="<tr>
     //                <td width='30%'><label>Email</label></td>
     //                <td width='70%'>".$row["email"]."</td>
     //           </tr>";
     //    $out.="<tr>
     //                <td width='30%'><label>Web</label></td>
     //                <td width='70%'>".$row["web"]."</td>
     //           </tr>";
    }       
    $out.="</table></div>";
    echo $out;
?>