<?php
// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le champ 'entry_id' existe dans la requête POST
    if (isset($_POST['entry_id'])) {
        // Récupérer l'ID de l'entrée à mettre à jour
        $entry_id = $_POST['entry_id'];

        // Connexion à la base de données (remplacez les valeurs par vos propres paramètres de connexion)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tutora"; // Le nom de votre base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Préparer les données du formulaire
        $name = $_POST['name'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $prestation = $_POST['prestation'];
        $destination = $_POST['destination'];
        $message = $_POST['message'];
        $nbrpassager = $_POST['nbrpassager'];
        $apec = $_POST['apec'];
        $statut = $_POST['statut']; 
        $phone = $_POST['phone']; // Champ de sélection du statut

        // Préparer la requête SQL de mise à jour avec une requête préparée
        $sql = "UPDATE submissions SET 
            name = ?, 
            prenom = ?, 
            email = ?, 
            prestation = ?, 
            destination = ?, 
            message = ?, 
            nbrpassager = ?, 
            apec = ?,  
            statut = ?,
            phone = ?
            WHERE id = ?";

        // Initialiser la requête préparée
        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bind_param("ssssssssisi", $name, $prenom, $email, $prestation, $destination, $message, $nbrpassager, $apec , $statut, $phone, $entry_id);

        // Exécuter la requête de mise à jour
        if ($stmt->execute()) {
            header("Location: dashboard.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Fermer la requête préparée et la connexion à la base de données
        $stmt->close();
        $conn->close();
    } else {
        echo "Entry ID not provided";
    }
} else {
    echo "Invalid request method";
}
?>
