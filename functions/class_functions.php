<?php

function getAllClasses()
{
  global $conn;
  $sql = "SELECT MaLop, TenLop FROM lop";
  return $conn->query($sql);
}