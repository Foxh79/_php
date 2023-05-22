<?php

// Get the birth year from the user
$birthYear = readline("Enter your birth year: ");

// Get the current year
$currentYear = date("Y");

// Calculate the age
$age = $currentYear - $birthYear;

// Print the age
echo "Your age is $age years old.";

?>
