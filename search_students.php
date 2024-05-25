<?php
// Include necessary files and initialize database connection
session_start();
include 'functions/student_functions.php';

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
                            <button class=\"btn\" style=\"background: #AD171C; color: whitesmoke\" onclick=\"openPopup('update_student.php?id={$row['MaSV']}')\">Cập nhật</button>
                            <button class=\"btn\" style=\"background: #AD171C; color: whitesmoke\" onclick=\"openPopup('show_gpa.php?id={$row['MaSV']}')\">Xem Điểm</button>
                            <button class=\"btn\" style=\"background: whitesmoke; color: #AD171C; border: 1px solid #AD171C;\" onclick=\"openPopup('delete_student.php?id={$row['MaSV']}')\">Xóa</button>
                        </td>
                    </tr>";
    }
    echo "</table>";
  } else {
    // No students found with the given search term
    echo "No students found.";
  }
} else {
  // No search term provided in the request
  echo "No search term provided.";
}
