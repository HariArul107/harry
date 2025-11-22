<?php
$fname = htmlspecialchars($_POST['Fname']);
$lname = htmlspecialchars($_POST['Lname']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$dob = htmlspecialchars($_POST['dob']);
$gender = htmlspecialchars($_POST['gender']);
$yop = htmlspecialchars($_POST['YOP']);
$skills = isset($_POST['skills']) ? $_POST['skills'] : [];
$address = htmlspecialchars($_POST['address']);

$output = "<h2>Your Input:</h2>";
$output .= "<p><strong>Name:</strong> $fname $lname</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Phone:</strong> $phone</p>";
$output .= "<p><strong>DOB:</strong> $dob</p>";
$output .= "<p><strong>Gender:</strong> $gender</p>";
$output .= "<p><strong>Year of Passing:</strong> $yop</p>";
$output .= "<p><strong>Skills:</strong></p><ul>";

foreach ($skills as $skill) {
    $output .= "<li>$skill</li>";
}
$output .= "</ul>";
$output .= "<p><strong>Address:</strong> $address</p>";
echo $output;
