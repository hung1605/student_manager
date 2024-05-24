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
      xhr.open("GET", "get_all_students.php", true); // Change the URL to the correct path
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

  // document.addEventListener("DOMContentLoaded", function() {
  //   var suggestionBox = document.getElementById("suggestionBox");

  //   // Fetch all students when the page finishes loading
  //   fetchSuggestions("")

  //   var searchInput = document.getElementById("searchInput");
  //   var timeout = null;

  //   searchInput.addEventListener("input", function() {
  //     clearTimeout(timeout);
  //     var searchQuery = searchInput.value.trim();
  //     if (searchQuery.length >= 0) {
  //       // Fetch suggestions after a short delay to avoid excessive requests
  //       timeout = setTimeout(function() {
  //         fetchSuggestions(searchQuery);
  //       }, 300);
  //     }
  //   });

  //   function fetchSuggestions(query) {
  //     fetch("search_gpa.php?search=" + query)
  //       .then(response => response.text())
  //       .then(data => {
  //         suggestionBox.innerHTML = data;
  //       });
  //   }
  // });


  function openPopup(url) {
    window.open(url, '_self', 'width=600,height=400');
  }
</script>

<!-- CSS Styles -->
<style>
  table {
    width: 100%;
    /* Table takes full width of its container */
    border-collapse: collapse;
    /* Remove default spacing between table cells */
  }

  th,
  td {
    padding: 8px;
    border: 1px solid #ddd;
    color: black;
  }

  body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
    margin-bottom: 60px;
  }

  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    color: #333;
    margin-bottom: 20px;
  }

  .input-group {
    margin-bottom: 20px;
    display: flex;
    align-items: center;
  }

  .input-group input[type="text"] {
    width: 70%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .input-group button {
    padding: 10px 20px;
    background-color: #007bff;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
  }

  .suggestion-table {
    width: 100%;
    border-collapse: collapse;
    color: black;
  }

  .suggestion-table th,
  .suggestion-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }

  .suggestion-table th {
    background-color: #007bff;
    color: #fff;
  }

  .suggestion-table tr:hover {
    background-color: #f2f2f2;
  }
</style>

<div class="container">
  <h2>All Students</h2>

  <!-- Search Input -->
  <div class="input-group">
    <input type="text" id="searchInput" placeholder="Search by Name">
    <button onclick="window.location.href='add_student.php'">Add Student</button>
  </div>

  <!-- Suggestion Box -->
  <div id="suggestionBox"></div>
</div>

<!-- Footer -->
<footer>
  <hr>
  <p>&copy; 2024 Student Management System</p>
</footer>

<?php include 'templates/footer.php'; ?>