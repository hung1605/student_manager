<?php
function authenticateUser($username, $password)
{
  global $conn;
  $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}
