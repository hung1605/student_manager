<?php
include_once 'db/config.php';

function addStudent($name, $class, $dob, $address, $gender)
{
  global $conn;
  $sql = "INSERT INTO sinhvien (HoTen, MaLop, NgaySinh, DiaChi, GioiTinh) VALUES ('$name', '$class', '$dob', '$address', '$gender')";
  return $conn->query($sql);
}


function updateStudent($id, $name, $class, $dob, $address, $gender)
{
  global $conn;
  // Escape and quote the parameters to prevent SQL injection
  $id = $conn->real_escape_string($id);
  $name = $conn->real_escape_string($name);
  $class = $conn->real_escape_string($class);
  $dob = $conn->real_escape_string($dob);
  $address = $conn->real_escape_string($address);
  $gender = $conn->real_escape_string($gender);

  $sql = "UPDATE sinhvien SET HoTen='$name', MaLop='$class', NgaySinh='$dob', DiaChi='$address', GioiTinh='$gender' WHERE MaSV='$id'";
  return $conn->query($sql);
}



function deleteStudent($id)
{
  global $conn;
  $id = $conn->real_escape_string($id);

  // Delete related records in diemhp table
  $sql_delete_related = "DELETE FROM diemhp WHERE MaSV='$id'";
  $conn->query($sql_delete_related);

  // Then delete the student record
  $sql_delete_student = "DELETE FROM sinhvien WHERE MaSV='$id'";
  return $conn->query($sql_delete_student);
}



function getTopStudents()
{
  global $conn;
  $sql = "SELECT sv.MaSV, sv.HoTen, sv.MaLop, AVG(dhp.DiemHP) as GPA
            FROM sinhvien sv
            JOIN diemhp dhp ON sv.MaSV = dhp.MaSV
            GROUP BY sv.MaSV
            ORDER BY GPA DESC
            LIMIT 3";
  return $conn->query($sql);
}

function getAllStudents()
{
  global $conn;
  $sql = "SELECT * FROM sinhvien";
  return $conn->query($sql);
}

function getStudentById($id)
{
  global $conn;
  // Escape and quote the $id parameter to prevent SQL injection
  $id = $conn->real_escape_string($id);
  $sql = "SELECT * FROM sinhvien WHERE MaSV='$id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

function searchStudents($searchTerm)
{
  global $conn;

  // Prepare the SQL statement to search for students by name
  $sql = "SELECT * FROM sinhvien WHERE HoTen LIKE ?";

  // Add wildcard '%' to the search term to perform a partial match
  $searchTerm = '%' . $searchTerm . '%';

  // Prepare and execute the statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $searchTerm);
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  return $result;
}

function getTotalStudents()
{
  global $conn;
  $sql = "SELECT COUNT(*) as count FROM sinhvien";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row['count'];
}

function getTotalClasses()
{
  global $conn;
  $sql = "SELECT COUNT(*) as count FROM lop";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row['count'];
}

function getTotalCourses()
{
  global $conn;
  $sql = "SELECT COUNT(*) as count FROM hocphan";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row['count'];
}

function getRecentStudents()
{
  global $conn;
  $sql = "SELECT MaSV, HoTen, MaLop, NgaySinh, DiaChi FROM sinhvien ORDER BY MaSV DESC LIMIT 5";
  return $conn->query($sql);
}

?>