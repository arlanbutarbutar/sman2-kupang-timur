<?php
$conn = mysqli_connect("localhost", "root", "", "sman_2_kupang_timur");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
