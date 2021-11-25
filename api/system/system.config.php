<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

function numUsers() {
 global $db;

 $query = $db -> query("SELECT * FROM users");
 $num = $db -> numRows($query);

 return $num;
}


function XSS($var) {
  $var = trim($var);
  $var = htmlspecialchars($var);
  $var = stripslashes($var);

  return $var;
}
