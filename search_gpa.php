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
        echo "<table><tr><th>ID</th><th>Name</th><th>Class</th><th>DOB</th><th>Address</th><th>Actions</th></tr>";
        while ($row = $filteredStudents->fetch_assoc()) {
            echo "<tr>
                        <td>{$row['MaSV']}</td>
                        <td>{$row['HoTen']}</td>
                        <td>{$row['MaLop']}</td>
                        <td>{$row['NgaySinh']}</td>
                        <td>{$row['DiaChi']}</td>
                        <td>
                            <button onclick=\"openPopup('show_gpa.php?id={$row['MaSV']}')\">Xem Điểm</button>
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
                        <td>{$row['HocKy']}</td>
                        <td>{$row['DiemHP']}</td>
                    </tr>";
        }
        echo "</table>";
    } else {
        // No students found with the given search term
        echo "Sinh viên không có điểm học phần nào.";
    }
} else {
    // No search term provided in the request
    echo "Không tồn tại sinh viên.";
}
