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

<h2>Add Student</h2>

<form method="post">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required><br>

  <label for="class">Class:</label><br>
  <select id="class" name="class" required>
    <?php while ($row = $classes->fetch_assoc()) { ?>
      <option value="<?php echo $row['MaLop']; ?>"><?php echo $row['TenLop']; ?></option>
    <?php } ?>
  </select><br>

  <label for="dob">Date of Birth:</label><br>
  <input type="date" id="dob" name="dob" required><br>

  <label for="address">Address:</label><br>
  <input type="text" id="address" name="address" required><br>

  <label for="gender">Gender:</label><br>
  <input type="radio" id="male" name="gender" value="Male" required>
  <label for="male">Male</label>
  <input type="radio" id="female" name="gender" value="Female" required>
  <label for="female">Female</label><br><br>

  <input type="submit" value="Add Student">
</form>

<?php include 'templates/footer.php'; ?>