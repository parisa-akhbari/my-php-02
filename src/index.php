<?php
require_once "classes/UserCRUD.php";
require_once 'jdf.php';

$userCRUD = new UserCRUD();

// تعداد رکورد در هر صفحه
$limit = 2;

// شماره صفحه فعلی
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// شروع رکورد
$offset = ($page - 1) * $limit;

// تعداد کل رکوردها
$total = $userCRUD->countAll();

// تعداد صفحات
$total_pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<body dir="rtl">
<div class="container">
    <br/>
    <h3 align="center">CRUD - Bootstrap Modal - PHP OOP - Ajax</h3><br/>
    <div align="right">
        <button name="add" id="add" class="btn btn-info">اضافه کردن</button>
    </div><br/>

    <!-- جدول کاربران -->
    <?php echo $userCRUD->renderTable($limit, $offset); ?>
    <nav>
    <ul class="pagination justify-content-center">

        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>">قبلی</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>">بعدی</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>

    <!-- مودال‌ها -->
    <?php require_once "insertModal.php"; ?>
    <?php require_once "viewModal.php"; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="process.js"></script>

</body>
</html>
