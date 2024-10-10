<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submission_id'])) {
        $submission_id = $_POST['submission_id'];
        // Connexion à la base de données
        // Set up database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutora"; 
// The name of your database
$conn = new mysqli($servername, $username, $password, $dbname);
        
        // Vérifiez la connexion
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Requête SQL pour supprimer la soumission
        $sql = "DELETE FROM submissionss WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $submission_id);

        if ($stmt->execute()) {
            header("Location: tuteur.php");
        } else {
            echo "Error deleting submission: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
