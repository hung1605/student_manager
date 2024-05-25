<?php
session_start();
include 'functions/auth_functions.php';
include 'functions/student_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = authenticateUser($username, $password);

    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['studentid'] = $user['studentid'];

        if ($user['role'] == 'student') {
            header("Location: student_view.php");
            exit();
        } else {
            header("Location: students_manager.php");
            exit();
        }
    } else {
        $login_error = "Invalid username or password.";
    }
}

$top_students = getTopStudents();
?>

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
                    <a class="nav-link" href="#login" style="color: #AD171C">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="d-flex justify-content-center"
     style="width: 100%;height: 100vh;background: url('assets/img/hero-bg.jpg' ) top center;background-size: cover;">
    <div class="flex-column pivot_center">
        <div class="hero-container" data-aos="fade-in">
            <h1 style="color: #AD171C; font-weight: bold">Posts and Telecommunications<br>Institute of Technology</h1>
            <p style="color: #AD171C; font-weight: bold">We are <span style="font-weight: bold;border-bottom: 2px solid #0a53be;" class="typed"
                                                                      data-typed-items="Training, Research, Production and Business"></span></p>
        </div>
    </div>
</div>


<div id="login" class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5 login-container">
            <h2 class="text-center">Login</h2>
            <?php if (isset($login_error)) {
                echo '<div class="alert alert-danger">' . $login_error . '</div>';
            } ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <br>
                <button type="submit" class="btn btn-block" style="
                    --bs-btn-color: #fff;
                    --bs-btn-bg: #AD171C;
                    --bs-btn-border-color: #AD171C;
                    --bs-btn-hover-color: #fff;
                    --bs-btn-hover-bg: #AD171C;
                    --bs-btn-hover-border-color: #AD171C;
                    --bs-btn-focus-shadow-rgb: 49, 132, 253;
                    --bs-btn-active-color: #fff;
                    --bs-btn-active-bg: #AD171C;
                    --bs-btn-active-border-color: #AD171C;
                    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
                    --bs-btn-disabled-color: #fff;
                    --bs-btn-disabled-bg: #AD171C;
                    --bs-btn-disabled-border-color: #AD171C
                ">
                    Đăng nhập
                </button>
            </form>
        </div>
        <div class="col-md-6 table-container">
            <h2 class="text-center">Top 3 Students with Highest GPA</h2>
            <?php
            if ($top_students->num_rows > 0) {
                echo '<table class="table table-striped mt-3"><thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>Class</th><th>GPA</th></tr></thead><tbody>';
                while ($row = $top_students->fetch_assoc()) {
                    $rounded_gpa = number_format($row['GPA'], 2);
                    echo '<tr>
                    <td>' . $row['MaSV'] . '</td>
                    <td>' . $row['HoTen'] . '</td>
                    <td>' . $row['MaLop'] . '</td>
                    <td>' . $rounded_gpa . '</td>
                </tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p>No students found.</p>';
            }
            ?>
        </div>
    </div>
</div>

<!-- ======= Footer ======= -->
<footer id="footer"></footer><!-- End  Footer -->

<a href="#" class="back-to-top pivot_center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/typed.js/typed.umd.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>