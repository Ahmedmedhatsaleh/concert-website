<?php
// Connect to PostgreSQL database
$conn = pg_connect("host=localhost dbname=concert user=postgres password=admin");

if (!$conn) {
    die("Database connection failed.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the user exists
    $query = "SELECT * FROM users WHERE email = $1 AND password = $2";
    $result = pg_query_params($conn, $query, array($email, $password));

    if (pg_num_rows($result) == 1) {
        echo "<h2>Login successful! 🎉 Welcome to Concert Pulse!</h2>";
    } else {
        echo "<h2 style='color:red;'>Invalid email or password. Please try again.</h2>";
    }
}
?>
