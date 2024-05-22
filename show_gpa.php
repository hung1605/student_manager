<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';
include 'functions/class_functions.php';
include 'functions/gpa_functions.php';

// Retrieve student data by ID
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $student = getStudentById($student_id);
    if (!$student) {
        header("Location: error.php");
        exit();
    }
} else {
    header("Location: error.php");
    exit();
}
?>

    <h2>Điểm các môn của sinh viên <?php echo $student['HoTen']; ?></h2>

    <form method="post">
        <script>
            var xhr = new XMLHttpRequest();
            var studentId = "<?php echo $student_id; ?>";
            xhr.open("GET", "search_gpa.php?search_all_gpa=" + studentId, true);
            xhr.send();
        </script>
    </form>

<?php include 'templates/footer.php'; ?>