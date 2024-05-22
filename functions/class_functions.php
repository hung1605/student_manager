<?php

include_once 'db/config.php';

function getAllClasses() {
  global $conn;
  $sql = "SELECT MaLop, TenLop FROM lop";
  return $conn->query($sql);
}

