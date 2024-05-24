<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';
include 'functions/class_functions.php';

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

// Retrieve the list of classes from the database
$classes = getAllClasses();

// Update student data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $class = $_POST['class'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];

  if (updateStudent($student_id, $name, $class, $dob, $address, $gender)) {
    echo "Student updated successfully.";
    // Redirect to a page showing updated student details
    header("Location: students_manager.php?id=" . $student_id);
    exit();
  } else {
    echo "Error updating student.";
  }
}
?>

<div class="d-flex justify-content-center">
  <div class="container w-50 border rounded shadow-sm p-3 mb-5 bg-white rounded text-dark">
    <h2>Update Student</h2>

    <form method="post">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['HoTen']; ?>" required>
      </div>

      <div class="form-group">
        <label for="class">Class:</label>
        <select class="form-control" id="class" name="class" required>
          <?php while ($row = $classes->fetch_assoc()) { ?>
            <option value="<?php echo $row['MaLop']; ?>" <?php if ($row['MaLop'] == $student['MaLop']) echo 'selected'; ?>>
              <?php echo $row['TenLop']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $student['NgaySinh']; ?>" required>
      </div>

      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $student['DiaChi']; ?>" required>
      </div>

      <div class="form-group row align-items-center">
        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
        <div class="col-sm-10">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="male" name="gender" value="Male" <?php if ($student['GioiTinh'] == 'Male') echo 'checked'; ?> required>
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="female" name="gender" value="Female" <?php if ($student['GioiTinh'] == 'Female') echo 'checked'; ?> required>
            <label class="form-check-label" for="female">Female</label>
          </div>
        </div>
      </div>

      <div class="form-group d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

<?php include 'templates/footer.php'; ?>