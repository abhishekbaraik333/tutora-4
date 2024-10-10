<?php
session_start();

// Set up database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutora"; // The name of your database

$connn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connn->connect_error) {
    die("Connection failed: " . $connn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username_email"];
    $passwordd = $_POST["password"];

    // Validate credentials against the database
    $stmt = $connn->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $email, $password);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($passwordd, $password)) {
            // Password is correct, set session and redirect to the protected page
            echo "Redirecting...";
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "email ou mot de passe incorrect";
    }

    $stmt->close();
}

$connn->close();
?>
