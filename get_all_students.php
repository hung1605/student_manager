<?php
include_once 'db/config.php';

$sql = "SELECT MaSV, HoTen, MaLop, NgaySinh, DiaChi FROM sinhvien";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Class</th><th>DOB</th><th>Address</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['MaSV']}</td>
            <td>{$row['HoTen']}</td>
            <td>{$row['MaLop']}</td>
            <td>{$row['NgaySinh']}</td>
            <td>{$row['DiaChi']}</td>
            <td>
              <button onclick=\"openPopup('update_student.php?id={$row['MaSV']}')\">Update</button>
              <button onclick=\"openPopup('delete_student.php?id={$row['MaSV']}')\">Delete</button>
            </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "No students found.";
}

$conn->close();
?>

<script>
  function openPopup(url) {
    window.open(url, '_self', 'width=600,height=400');
  }
</script>