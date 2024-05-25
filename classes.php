<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
include 'functions/class_functions.php';
include 'functions/student_functions.php';

$classes = getAllClasses();
?>

    <style>
        table {
            width: 100%;
            /* Table takes full width of its container */
            border-collapse: collapse;
            /* Remove default spacing between table cells */
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            color: black;
        }

        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin-bottom: 60px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }
    </style>

    <div class="d-flex justify-content-center"
         style="width: 100%;height: 100vh;background: url('assets/img/hero-bg.jpg' ) top center;background-size: cover;">
        <div class="container">
            <h2 class="d-flex justify-content-center">Danh Sách Lớp</h2>

            <div class="d-flex justify-content-center">
                <div class="form-group w-50">
                    <select id="classSelect" class="form-control">
                        <option value="">Chọn lớp</option>
                        <?php
                        while ($row = $classes->fetch_assoc()) {
                            echo "<option value='{$row['MaLop']}'>{$row['TenLop']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <h2 id=title_search_class class="d-flex justify-content-center">Danh sách sinh viên</h2>
            <div id="studentList"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var classSelect = document.getElementById("classSelect");
            var studentList = document.getElementById("studentList");
            var titleSearchClass = document.getElementById("title_search_class");

            classSelect.addEventListener("change", function () {
                var classId = classSelect.value;
                if (classId) {
                    fetchStudents(classId);
                    titleSearchClass.innerHTML = "Danh sách sinh viên lớp " + classSelect.options[classSelect.selectedIndex].text;
                } else {
                    titleSearchClass.innerHTML = "Danh sách sinh viên";
                    studentList.innerHTML = "";
                }
            });

            function fetchStudents(classId) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        studentList.innerHTML = xhr.responseText;
                    }
                };
                xhr.open("GET", "get_students_by_class.php?classId=" + classId, true);
                xhr.send();
            }
        });
    </script>

<?php include 'templates/footer.php'; ?>