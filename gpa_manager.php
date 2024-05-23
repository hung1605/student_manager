<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';
include 'functions/gpa_functions.php';
?>

    <!-- Include JavaScript for dynamic search suggestions -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var suggestionBox = document.getElementById("suggestionBox");

            // Fetch all students when the page finishes loading
            fetchSuggestions("")

            var searchInput = document.getElementById("searchInput");
            var timeout = null;

            searchInput.addEventListener("input", function () {
                clearTimeout(timeout);
                var searchQuery = searchInput.value.trim();
                if (searchQuery.length >= 0) {
                    // Fetch suggestions after a short delay to avoid excessive requests
                    timeout = setTimeout(function () {
                        fetchSuggestions(searchQuery);
                    }, 300);
                }
            });

            function fetchSuggestions(query) {
                fetch("search_students.php?search=" + query)
                    .then(response => response.text())
                    .then(data => {
                        suggestionBox.innerHTML = data;
                    });
            }
        });
    </script>


    <!-- HTML for search input and suggestion box -->
    <h2>Student Subjects Point</h2>

    <div>
        <input type="text" id="searchInput" placeholder="Search by Name" class="d-inline">
        <button onclick="window.location.href='add_student.php'">Add Student</button>
        <div id="suggestionBox"></div>
    </div>

    <script>
        function openPopup(url) {
            window.open(url, '_self', 'width=600,height=400');
        }
    </script>

<?php include 'templates/footer.php'; ?>