<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quản Lý Sinh Viên</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-inline-flex" href="#">
            <img src="assets/img/PTITLogo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px">
            <p class="align-content-center" style="height: 40px; color: #AD171C;">Học Viện Công Nghệ Bưu Chính Viễn Thông</p>
        </a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
<!--                    <a class="nav-link" href="#login" style="color: #AD171C">Đăng nhập</a>-->
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <a href="students_manager.php" class="btn btn-link" style="color: #AD171C">QL Sinh Viên</a>
                        <a href="classes.php" class="btn btn-link" style="color: #AD171C">QL Lớp</a>
                    <?php else : ?>
                        <a href="student_view.php" class="btn btn-link" style="color: #AD171C">TT Sinh Viên</a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn btn-link" style="color: #AD171C">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>