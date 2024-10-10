<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Rate limiting settings
    $maxSubmissions = 10; // Maximum submissions allowed
    $submissionTimeframe = 1; // 1 hour in seconds

    // Set up database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tutora"; // The name of your database

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the user's IP address
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Check if there's a record for this IP address
    $sql = "SELECT * FROM submissions_tracking WHERE ip_address = '$ipAddress'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the submission count exceeds the limit
        if ($row['submission_count'] >= $maxSubmissions) {
            echo "You have reached the maximum allowed submissions within the timeframe.";
            exit();
        }

        // Check if the timeframe has elapsed
        $currentTime = time();
        if ($currentTime - $row['last_submission_time'] > $submissionTimeframe) {
            // Reset the submission count and time
            $sqlUpdate = "UPDATE submissions_tracking SET submission_count = 1, last_submission_time = $currentTime WHERE ip_address = '$ipAddress'";
            $conn->query($sqlUpdate);
        } else {
            // Increment the submission count
            $newCount = $row['submission_count'] + 1;
            $sqlUpdate = "UPDATE submissions_tracking SET submission_count = $newCount WHERE ip_address = '$ipAddress'";
            $conn->query($sqlUpdate);
        }
    } else {
        // Insert a new record for this IP address
        $currentTime = time();
        $sqlInsert = "INSERT INTO submissions_tracking (ip_address, submission_count, last_submission_time) VALUES ('$ipAddress', 1, $currentTime)";
        $conn->query($sqlInsert);
    }

    // Process form data
    $name = $_POST["name"];
    $prenom = $_POST["prenom"];
    $apec = $_POST["apec"];
    $phone = $_POST["phone"];
    $nbrpassager = $_POST["nbrpassager"];
    $destination = $_POST["destination"];
    $email = $_POST["email"];
    $prestation = $_POST["prestation"];
    $message = $_POST["message"];

    // Insert data into database
    $sql = "INSERT INTO submissions (name, prenom, prestation , email, nbrpassager, message , apec , phone  , destination  ) VALUES ('$name', '$prenom', '$prestation' , '$email', '$nbrpassager', '$message' , '$apec', '$phone' , '$destination')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to success page
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}

?>
