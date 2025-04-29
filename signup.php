<?php
// Connect to PostgreSQL
$host = "localhost";
$dbname = "concert";
$user = "postgres";
$password = "admin"; // (your pgAdmin password)

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = pg_escape_string($conn, $_POST['first_name']);
    $last_name = pg_escape_string($conn, $_POST['last_name']);
    $dob = pg_escape_string($conn, $_POST['dob']);
    $email = pg_escape_string($conn, $_POST['email']);
    $password = pg_escape_string($conn, $_POST['password']);
    $confirm_password = pg_escape_string($conn, $_POST['confirm_password']);

    // Optional: check if password and confirm_password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Insert into database
    $query = "INSERT INTO users (first_name, last_name, dob, email, password, confirm_password) 
              VALUES ('$first_name', '$last_name', '$dob', '$email', '$password', '$confirm_password')";

    $result = pg_query($conn, $query);

    if ($result) {
        echo "Signup successful!";
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>
