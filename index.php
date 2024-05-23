<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';
include 'functions/class_functions.php';

// Get total counts for summary
$totalStudents = getTotalStudents();
$totalClasses = getTotalClasses();
$totalCourses = getTotalCourses();
$recentStudents = getRecentStudents();
?>

<h2>Welcome to the Student Management System</h2>

<div class="summary">
    <div class="summary-item">
        <h3>Total Students</h3>
        <p><?php echo $totalStudents; ?></p>
    </div>
    <div class="summary-item">
        <h3>Total Classes</h3>
        <p><?php echo $totalClasses; ?></p>
    </div>
    <div class="summary-item">
        <h3>Total Courses</h3>
        <p><?php echo $totalCourses; ?></p>
    </div>
</div>

<h3>Recent Student Additions</h3>
<?php
if ($recentStudents->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Class</th><th>DOB</th><th>Address</th></tr>";
    while ($row = $recentStudents->fetch_assoc()) {
        echo "<tr>
            <td>{$row['MaSV']}</td>
            <td>{$row['HoTen']}</td>
            <td>{$row['MaLop']}</td>
            <td>{$row['NgaySinh']}</td>
            <td>{$row['DiaChi']}</td>
          </tr>";
    }
    echo "</table>";
} else {
    echo "No recent students found.";
}
?>

<h3>Quick Links</h3>
<ul>
    <li><a href="students_manager.php">View All Students</a></li>
    <li><a href="classes.php">View Classes</a></li>
</ul>

<?php include 'templates/footer.php'; ?>