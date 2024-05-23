<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';
include 'functions/class_functions.php';
include 'functions/gpa_functions.php';

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
?>
    <!-- Include JavaScript for dynamic search suggestions -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var suggestionBox = document.getElementById("suggestionBox");
            var studentId = "<?php echo $student_id; ?>"
            // Fetch all students when the page finishes loading
            fetchAllSubjects()

            var searchInput = document.getElementById("searchInput");
            var timeout = null;

            searchInput.addEventListener("input", function () {
                clearTimeout(timeout);
                var searchQuery = searchInput.value.trim();
                if (searchQuery.length > 0) {
                    // Fetch suggestions after a short delay to avoid excessive requests
                    timeout = setTimeout(function () {
                        fetchSuggestions(searchQuery);
                    }, 300);
                }
                else {
                    fetchAllSubjects()
                }
            });

            function fetchSuggestions(query) {
                var xhr = new XMLHttpRequest();
                console.log(query)
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        suggestionBox.innerHTML = xhr.responseText;
                    }
                };
                xhr.open("GET", "search_gpa.php?search_gpa_subjects=" + query + "&id_student=" + studentId, true);
                xhr.send();
            }

            function fetchAllSubjects() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        suggestionBox.innerHTML = xhr.responseText;
                    }
                };
                xhr.open("GET", "search_gpa.php?search_all_gpa=" + studentId, true);
                xhr.send();
            }
        });
    </script>

    <h2>Điểm các môn của sinh viên <?php echo $student['HoTen']; ?></h2>

    <div>
        <input type="text" id="searchInput" placeholder="Search subject by name" class="d-inline">
        <div id="suggestionBox"></div>
    </div>

<?php include 'templates/footer.php'; ?>