<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';
?>

<!-- Include JavaScript for dynamic search suggestions -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var suggestionBox = document.getElementById("suggestionBox");

    // Fetch all students when the page finishes loading
    fetchAllStudents();

    function fetchAllStudents() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          suggestionBox.innerHTML = xhr.responseText;
        }
      };
      xhr.open("GET", "functions/get_all_students.php", true); // Change the URL to the correct path
      xhr.send();
    }

    var searchInput = document.getElementById("searchInput");
    var timeout = null;

    searchInput.addEventListener("input", function() {
      clearTimeout(timeout);
      var searchQuery = searchInput.value.trim();
      if (searchQuery.length >= 0) {
        // Fetch suggestions after a short delay to avoid excessive requests
        timeout = setTimeout(function() {
          fetchSuggestions(searchQuery);
        }, 300);
      } else {
        // If search query is empty, fetch all students
        fetchAllStudents();
      }
    });

    function fetchSuggestions(query) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          suggestionBox.innerHTML = xhr.responseText;
        }
      };
      xhr.open("GET", "search_students.php?search=" + query, true);
      xhr.send();
    }
  });
</script>



<!-- HTML for search input and suggestion box -->
<h2>All Students</h2>

<div>
  <input type="text" id="searchInput" placeholder="Search by Name" class="d-inline">
  <button onclick="window.location.href='add_student.php'">Add Student</button>
  <div id="suggestionBox"></div>
</div>


<!-- <div id="studentList">
  <?php
  $students = getAllStudents();
  if ($students->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Class</th><th>DOB</th><th>Address</th><th>Actions</th></tr>";
    while ($row = $students->fetch_assoc()) {
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
  ?>
</div> -->

<script>
  function openPopup(url) {
    window.open(url, '_self', 'width=600,height=400');
  }
</script>

<?php include 'templates/footer.php'; ?>