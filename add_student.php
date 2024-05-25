<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit();
}

include 'functions/class_functions.php';
include 'templates/header.php';
include 'functions/student_functions.php';

// Retrieve the list of classes from the database
$classes = getAllClasses();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $class = $_POST['class'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];

  if (addStudent($name, $class, $dob, $address, $gender)) {
    echo "Student added successfully.";
    header("Location: students_manager.php");
    exit();
  } else {
    echo "Error adding student.";
  }
}
?>

<div class="container w-50 border rounded shadow-sm p-3 mb-5 bg-white rounded text-dark">
  <h2 class="text-dark ">Add Student</h2>
  <form method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="class">Class:</label>
      <select id="class" name="class" class="form-control" required>
        <?php while ($row = $classes->fetch_assoc()) { ?>
          <option value="<?php echo $row['MaLop']; ?>"><?php echo $row['TenLop']; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group">
      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="gender">Gender:</label><br>
      <input type="radio" id="male" name="gender" value="Male" required>
      <label for="male">Male</label>
      <input type="radio" id="female" name="gender" value="Female" required>
      <label for="female">Female</label>
    </div>

    <div class="form-group d-flex justify-content-center">
      <input type="submit" value="Add Student" class="btn btn-primary">
    </div>
  </form>
</div>

<?php include 'templates/footer.php'; ?>