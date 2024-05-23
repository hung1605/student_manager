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
            var studentId = "<?php echo $student_id; ?>";
            // Fetch all students when the page finishes loading
            fetchSuggestions("");

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
                } else {
                    fetchSuggestions("");
                }
            });

            function fetchSuggestions(query) {
                var fetchQuery = query.length > 0 ? "search_gpa.php?search_gpa_subjects=" + query + "&id_student=" + studentId : "search_gpa.php?search_all_gpa=" + studentId;
                fetch(fetchQuery)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('suggestionBox').innerHTML = data;
                    })
            }
        });

        function editDiemHP(maHP) {
            createInputField(maHP);
            changeButtonChangeToButtonSave(maHP)
        }

        function createInputField(maHP) {
            // Lấy giá trị hiện tại của ô span
            var currentValue = document.getElementById('diemHP' + maHP).innerHTML;

            // Tạo ô input để nhập giá trị mới
            var inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.value = currentValue;
            inputField.id = 'inputDiemHP' + maHP;

            // Thay thế ô span bằng ô input
            document.getElementById('diemHP' + maHP).innerHTML = '';
            document.getElementById('diemHP' + maHP).appendChild(inputField);
        }

        function changeButtonChangeToButtonSave(maHP) {
            console.log(maHP)
            var buttonSave = document.getElementById('buttonDiemHP' + maHP)
            buttonSave.textContent = 'Lưu';
            buttonSave.onclick = function () {
                saveDiemHP(maHP, "<?php echo $student_id; ?>");
            };
        }

        function saveDiemHP(subjectId, studentId) {
            // Lấy giá trị mới từ ô input
            var inputField = document.getElementById('inputDiemHP' + subjectId);
            var newValue = inputField.value;

            console.log(newValue)

            // Tạo đối tượng dữ liệu để gửi đi
            var data = {
                save_gpa_subjects: subjectId,
                new_gpa: newValue,
                student_id: studentId
            };

            // Gửi yêu cầu POST bằng fetch
            fetch('search_gpa.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(_ => {
                    var query = document.getElementById('searchInput').value.trim();
                    var fetchQuery = query.length > 0 ? "search_gpa.php?search_gpa_subjects=" + query + "&id_student=" + studentId : "search_gpa.php?search_all_gpa=" + studentId;
                    fetch(fetchQuery)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('suggestionBox').innerHTML = data;
                        })
                })
                .catch(error => {
                    console.error('Đã xảy ra lỗi:', error);
                });
        }
    </script>
    <h2>Điểm các môn của sinh viên <?php echo $student['HoTen']; ?></h2>

    <div>
        <input type="text" id="searchInput" placeholder="Search subject by name" class="d-inline">
        <div id="suggestionBox"></div>
    </div>

<?php include 'templates/footer.php'; ?>