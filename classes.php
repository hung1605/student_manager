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

<h2>Classes</h2>

<div>
  <label for="classSelect">Select Class:</label>
  <select id="classSelect">
    <option value="">Select a class</option>
    <?php
    while ($row = $classes->fetch_assoc()) {
      echo "<option value='{$row['MaLop']}'>{$row['TenLop']}</option>";
    }
    ?>
  </select>
</div>

<div id="studentList"></div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var classSelect = document.getElementById("classSelect");
    var studentList = document.getElementById("studentList");

    classSelect.addEventListener("change", function() {
      var classId = classSelect.value;
      if (classId) {
        fetchStudents(classId);
      } else {
        studentList.innerHTML = "";
      }
    });

    function fetchStudents(classId) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
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