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


    //****************************************************************** */

    
       // Process form data
    $namee = $_POST["namee"];
    $prenomm = $_POST["prenomm"];
    $emaill = $_POST["emaill"];
    $apecc = $_POST["apecc"];
    $phonee = $_POST["phonee"];
    $nbrpassagerr = $_POST["nbrpassagerr"];
    $destinationn = $_POST["destinationn"];
    $prestationn = $_POST["prestationn"];
    $messagee = $_POST["messagee"];
    $preference = $_POST["preference"];

    $filename = "";
    $filesize = 0;
    $filetype = "";

    // Check if a file was uploaded
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($file_size > 1048576) {
            echo "Sorry, the file size must be less than 1 MB.";
            exit();
        }

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
            exit();
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];
                // Debugging statements
                echo "File upload successful.<br>";
                echo "Filename: $filename<br>";
                echo "Filesize: $filesize<br>";
                echo "Filetype: $filetype<br>";
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
                exit();
            }
        }
    } else {
        if (isset($_FILES["file"])) {
            echo "File upload error: " . $_FILES["file"]["error"] . "<br>";
        } else {
            echo "No file was uploaded.<br>";
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO submissionss (name, prenom, prestation, email, nbrpassager, message, apec, phone, destination, preference, filename, filesize, filetype) 
            VALUES ('$namee', '$prenomm', '$prestationn', '$emaill', '$nbrpassagerr', '$messagee', '$apecc', '$phonee', '$destinationn', '$preference', '$filename', '$filesize', '$filetype')";

    if ($conn->query($sql) === TRUE) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}



?>
