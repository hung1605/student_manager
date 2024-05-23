<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit();
}

include_once 'functions/student_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
  $student_id = $_GET['id'];

  // Perform the deletion
  if (deleteStudent($student_id)) {
    echo "Student deleted successfully.";
    header("Location: students_manager.php");
  } else {
    echo "Error deleting student.";
  }
} else {
  echo "Invalid request.";
}
