<?php
$mysqli = new mysqli("localhost", "admin", "123456", "thedxm");
$mysqli->set_charset("utf8");


if ($mysqli->connect_errno) {
  echo "Kết nối MYSQLi lỗi: " . $mysqli->connect_error;
  exit();
}
