<?php
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=search.csv");
header("Pragma: no-cache");
header("Expires: 0");

echo "Full Name, Display Name, Email, Phone\n";
foreach ($results as $result) {
  echo $result->full_name.", ";
  echo $result->display_name.", ";
  echo $result->email.", ";
  echo $result->phone."\n";
}