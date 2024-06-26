<!DOCTYPE html>
<html>

<head>
  <title>Student List</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #f5f5f5;
    }
  </style>
</head>

<body>

  <?php
  include_once 'db/config.php';

  if (isset($_GET['classId'])) {
    $classId = $_GET['classId'];

    $sql = "SELECT MaSV, HoTen, NgaySinh, DiaChi FROM sinhvien WHERE MaLop = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $classId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo "<table id=\"classSelectionContainer\"><tr><th>ID</th><th>Name</th><th>DOB</th><th>Address</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>{$row['MaSV']}</td>
              <td>{$row['HoTen']}</td>
              <td>{$row['NgaySinh']}</td>
              <td>{$row['DiaChi']}</td>
            </tr>";
      }
      echo "</table>";
    } else {
      echo "No students found for the selected class.";
    }

    $stmt->close();
  }
  ?>

</body>

</html>