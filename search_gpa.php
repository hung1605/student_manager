<?php
// Include necessary files and initialize database connection
session_start();
include 'functions/student_functions.php';
include 'functions/gpa_functions.php';

// Check if the search term is provided in the request
if (isset($_GET['search'])) {
    // Get the search term from the request
    $searchTerm = $_GET['search'];

    // Call the function to search for students based on the provided search term
    $filteredStudents = searchStudents($searchTerm);

    // Check if any students are found
    if ($filteredStudents->num_rows > 0) {
        // Display the filtered student data
        echo "<table class='table table-striped mt-3'><tr><th>ID</th><th>Name</th><th>Class</th><th>DOB</th><th>Address</th><th>Actions</th></tr>";
        while ($row = $filteredStudents->fetch_assoc()) {
            echo "<tr>
                        <td>{$row['MaSV']}</td>
                        <td>{$row['HoTen']}</td>
                        <td>{$row['MaLop']}</td>
                        <td>{$row['NgaySinh']}</td>
                        <td>{$row['DiaChi']}</td>
                        <td>
                            <button class=\"btn\" style=\"background: #AD171C\" onclick=\"openPopup('show_gpa.php?id={$row['MaSV']}')\">Xem Điểm</button>
                        </td>
                    </tr>";
        }
        echo "</table>";
    } else {
        // No students found with the given search term
        echo "No students found.";
    }
} else if (isset($_GET['search_all_gpa'])) {
    // Get the search term from the request
    $searchTerm = $_GET['search_all_gpa'];

    // Call the function to search for students based on the provided search term
    $filteredStudents = getAllStudentSubjects($searchTerm);

    // Check if any students are found
    if ($filteredStudents->num_rows > 0) {
        // Display the filtered student data
        echo "<table><tr><th>Mã Học Phần</th><th>Tên Học Phần</th><th>Số DVHT</th><th>Tên Ngành</th><th>Tên Khoa</th><th>Học Kỳ</th><th>Điểm Học Phần</th></tr>";
        while ($row = $filteredStudents->fetch_assoc()) {
            echo "<tr>
                        <td>{$row['MaHP']}</td>
                        <td>{$row['TenHP']}</td>
                        <td>{$row['SoDVHT']}</td>
                        <td>{$row['TenNganh']}</td>
                        <td>{$row['TenKhoa']}</td>
                        <td>{$row['HocKy']}</td>
                        <td><span id='diemHP{$row['MaHP']}'>{$row['DiemHP']}</span></td>
                        <td>
                            <button class=\"btn\" style=\"background: #AD171C; color: whitesmoke\" id='buttonDiemHP{$row['MaHP']}' onclick=\"editDiemHP('{$row['MaHP']}')\">Sửa</button>
                        </td>
                    </tr>";
        }
        echo "</table>";
    } else {
        // No students found with the given search term
        echo "Sinh viên không có điểm học phần nào.";
    }
} else if (isset($_GET['search_gpa_subjects']) && isset($_GET['id_student'])) {
    $searchTerm = $_GET['search_gpa_subjects'];
    $studentId = $_GET['id_student'];
    $allStudentSubjects = getAllStudentSubjects($studentId);
    $filteredStudentSubjects = [];

    if (!empty($searchTerm)) {
        while ($row = $allStudentSubjects->fetch_assoc()) {
            $subject = $row['TenHP'];
            if (stripos($subject, $searchTerm) !== false) {
                $filteredStudentSubjects[] = $row;
            }
        }
    } else {
        $filteredStudentSubjects = $allStudentSubjects;
    }

    if (count($filteredStudentSubjects) > 0) {
        // Display the filtered student data
        echo "<table><tr><th>Mã Học Phần</th><th>Tên Học Phần</th><th>Số DVHT</th><th>Tên Ngành</th><th>Tên Khoa</th><th>Học Kỳ</th><th>Điểm Học Phần</th></tr>";
        foreach ($filteredStudentSubjects as $subject) {
            echo "<tr>
                        <td>{$subject['MaHP']}</td>
                        <td>{$subject['TenHP']}</td>
                        <td>{$subject['SoDVHT']}</td>
                        <td>{$subject['TenNganh']}</td>
                        <td>{$subject['TenKhoa']}</td>
                        <td>{$subject['HocKy']}</td>
                        <td><span id='diemHP{$subject['MaHP']}'>{$subject['DiemHP']}</span></td>
                        <td>
                            <button class=\"btn\" style=\"background: #AD171C; color: whitesmoke\" id='buttonDiemHP{$subject['MaHP']}' onclick=\"editDiemHP('{$subject['MaHP']}')\">Sửa</button>
                        </td>
                    </tr>";
        }
        echo "</table>";
    } else {
        // No students found with the given search term
        echo "Sinh viên không có điểm học phần nào.";
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_data = file_get_contents("php://input");
    $post_data = json_decode($input_data, true);
    $subjectID = $post_data["save_gpa_subjects"];
    $newGPA = $post_data["new_gpa"];
    $studentID = $post_data["student_id"];
    saveGPAChanges($studentID, $subjectID, $newGPA);
} else {
    // No search term provided in the request
    echo "Không tồn tại sinh viên.";
}
?>
