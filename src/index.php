<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "لطفاً ابتدا وارد شوید.";
    header("Location: login/index.php");
    exit;
}

$currentUserId = $_SESSION['user']['id'];
$currentUsername = $_SESSION['user']['username'];

require_once "classes/UserCRUD.php";
require_once 'jdf.php';

$userCRUD = new UserCRUD();

// Pagination
$limit = 2;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// تعداد کل رکوردها برای کاربر جاری
$total = $userCRUD->countAll($currentUserId);
$total_pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>CRUD</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<body dir="rtl">

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="user-info">
            خوش آمدید، <strong><?= htmlspecialchars($currentUsername) ?></strong>
        </div>
        <div>
            <a href="login/logout.php" class="btn btn-warning">خروج</a>
            <button name="add" id="add" class="btn btn-info">اضافه کردن</button>
        </div>
    </div>

    <!-- جدول کاربران -->
    <?php echo $userCRUD->renderTable($limit, $offset, $currentUserId); ?>

   <!-- Pagination -->
<nav>
    <ul class="pagination justify-content-center">
        <!-- Previous -->
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>">قبلی</a>
            </li>
        <?php endif; ?>

        <?php
        // محدوده صفحه برای نمایش
        $adjacents = 1; // تعداد صفحات کنار صفحه فعلی
        $start = max(2, $page - $adjacents);
        $end = min($total_pages - 1, $page + $adjacents);
        ?>

        <!-- صفحه اول -->
        <li class="page-item <?= ($page == 1) ? 'active' : '' ?>">
            <a class="page-link" href="?page=1">1</a>
        </li>

        <!-- نقطه قبل از محدوده میانی -->
        <?php if ($start > 2): ?>
            <li class="page-item disabled"><span class="page-link">…</span></li>
        <?php endif; ?>

        <!-- صفحات میانی -->
        <?php for ($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- نقطه بعد از محدوده میانی -->
        <?php if ($end < $total_pages - 1): ?>
            <li class="page-item disabled"><span class="page-link">…</span></li>
        <?php endif; ?>

        <!-- صفحه آخر -->
        <?php if ($total_pages > 1): ?>
            <li class="page-item <?= ($page == $total_pages) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $total_pages ?>"><?= $total_pages ?></a>
            </li>
        <?php endif; ?>

        <!-- Next -->
        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>">بعدی</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
</div>

<!-- مودال‌ها -->
<?php require_once "insertModal.php"; ?>
<?php require_once "viewModal.php"; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="process.js"></script>

</body>
</html>
