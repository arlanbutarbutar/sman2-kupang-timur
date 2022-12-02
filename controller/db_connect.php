<?php
$conn = mysqli_connect("localhost", "root", "", "sman_2_kupang_timur2");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
