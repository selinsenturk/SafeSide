<?php
$db = new mysqli("localhost","root","","veri_gizliligi");

// Check connection
if ($db -> connect_errno) {
  echo "Failed to connect to MySQL: " . $db -> connect_error;
  exit();
}
?>