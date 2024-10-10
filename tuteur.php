<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

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

// Fetch all submissions from the database
$sql = "SELECT * FROM submissionss";
$result = $conn->query($sql);

// Close the database connection
$conn->close();




// Assurez-vous que $rejected_count est définie
$rejected_count = 0;

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

// Requête SQL pour compter le nombre de soumissions rejetées
$sql_rejected = "SELECT COUNT(*) AS rejected_count FROM submissionss WHERE statut = 0";

// Exécuter la requête SQL
$result_rejected = $conn->query($sql_rejected);

// Vérifier si la requête a réussi
if ($result_rejected) {
    $row_rejected = $result_rejected->fetch_assoc();
    $rejected_count = $row_rejected['rejected_count'];
} else {
    // Gérer l'erreur si la requête échoue
    echo "Error: " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();

// Assurez-vous que $accepted_count et $pending_count sont définis
$accepted_count = 0;
$pending_count = 0;

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

// Requête SQL pour compter le nombre de soumissions acceptées
$sql_accepted = "SELECT COUNT(*) AS accepted_count FROM submissionss WHERE statut = 1";

// Exécuter la requête SQL
$result_accepted = $conn->query($sql_accepted);

// Vérifier si la requête a réussi
if ($result_accepted) {
    $row_accepted = $result_accepted->fetch_assoc();
    $accepted_count = $row_accepted['accepted_count'];
} else {
    // Gérer l'erreur si la requête échoue
    echo "Error: " . $conn->error;
}

// Requête SQL pour compter le nombre de soumissions en attente
$sql_pending = "SELECT COUNT(*) AS pending_count FROM submissionss WHERE statut != 0 AND statut != 1";

// Exécuter la requête SQL
$result_pending = $conn->query($sql_pending);

// Vérifier si la requête a réussi
if ($result_pending) {
    $row_pending = $result_pending->fetch_assoc();
    $pending_count = $row_pending['pending_count'];
} else {
    // Gérer l'erreur si la requête échoue
    echo "Error: " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();



// Assurez-vous que $accepted_count_month est défini
$accepted_count_month = 0;

// Obtenez la date de début et de fin du mois en cours
$first_day_of_month = date('Y-m-01');
$last_day_of_month = date('Y-m-t');

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

// Requête SQL pour compter le nombre de soumissions avec le statut "Accepté" dans le mois en cours
$sql_accepted_month = "SELECT COUNT(*) AS accepted_count_month 
                       FROM submissionss 
                       WHERE statut = 1 
                       AND created_at >= '$first_day_of_month' 
                       AND created_at <= '$last_day_of_month'";

// Exécuter la requête SQL
$result_accepted_month = $conn->query($sql_accepted_month);

// Vérifier si la requête a réussi
if ($result_accepted_month) {
    $row_accepted_month = $result_accepted_month->fetch_assoc();
    $accepted_count_month = $row_accepted_month['accepted_count_month'];
} else {
    // Gérer l'erreur si la requête échoue
    echo "Error: " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();













?>































<!DOCTYPE html>
<html lang="en" dir="">
<meta name="csrf-token" content="">
<meta name="url" content="" data-user="2">

<head>
    <title>Liste des soumissions</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Tutora" />
    <meta name="keywords" content="Dashboard Tutora" />
    <meta name="author" content="Tutora" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="Tutora" crossorigin="Tutora">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="icon" href="Tutora/favicons/favicon-16x16.png"
        type="image" sizes="16x16">



    <!-- font css -->
    <link rel="stylesheet" href="css/tabler-icons.min.css">
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/material.css">

    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/stylee.css">
    <!-- vendor css -->


    <link rel="stylesheet" href="css/styleee.css" id="style">

    <link rel="stylesheet" href="css/custom.css" id="style">


    <link rel="stylesheet" href="css/customizer.css">

    <link rel="stylesheet" href="css/customm.css">

    <link rel="stylesheet" href="css/main.css">
    <!-- date -->



    <style>
    [dir="rtl"] .dash-sidebar {
        left: auto !important;
    }

    [dir="rtl"] .dash-header {
        left: 0;
        right: 280px;
    }

    [dir="rtl"] .dash-header:not(.transprent-bg) .header-wrapper {
        padding: 0 0 0 30px;
    }

    [dir="rtl"] .dash-header:not(.transprent-bg):not(.dash-mob-header)~.dash-container {
        margin-left: 0px;
    }

    [dir="rtl"] .me-auto.dash-mob-drp {
        margin-right: 10px !important;
    }

    [dir="rtl"] .me-auto {
        margin-left: 10px !important;
    }
    </style>
    <style>
    {
        "status": "error", "message":"Invalid request method"
    }

    :root {
        --color-customColor: ;
    }
    </style>

</head>

<body class="theme-3">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <nav class="dash-sidebar light-sidebar transprent-bg">

        <div class="navbar-wrapper">
            <div class="m-header main-logo">
                <a href="#" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="Tutora/logo/logo bleu fond transparent.jpg" alt="" class="logo logo-lg" />
                    <img src="Tutora/logo/logo blanc fond transparent.jpg" alt="" class="logo logo-sm" />


                </a>
            </div>
            <div class="navbar-content">
                <ul class="dash-navbar">
                    <li class="dash-item">
                        <a href="dashboard.php" class="dash-link"><span class="dash-micon"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                </svg>
                            </span><span class="dash-mtext ">Parent/Eléve</span></a>
                    </li>
                    <li class="dash-item">
                        <a href="tuteur.php" class="dash-link"><span class="dash-micon"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                </svg>
                            </span><span class="dash-mtext ">Tuteur</span></a>
                    </li>
                    <li class="dash-item">
                        <a href="logout.php" class="dash-link"><span class="dash-micon "><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>
                            </span><span class="dash-mtext">Se déconnecter</span></a>
                    </li>

            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <div class="main-content position-relative">
        <header class="dash-header  transprent-bg">
            <div class="header-wrapper">
                <div class="me-auto dash-mob-drp">
                    <ul class="list-unstyled">
                        <li class="dash-h-item mob-hamburger">
                            <a href="#!" class="dash-head-link" id="mobile-collapse">
                                <div class="hamburger hamburger--arrowturn">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="dropdown dash-h-item drp-company">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">

                                <span class="hide-mob ms-2">Bonjour , Tutora</span>
                                
                            </a>
                            
                        </li>

                    </ul>
                </div>

            </div>
        </header>
        <div class="page-content">
            <!-- [ Main Content ] start -->
            <div class="dash-container">
                <div class="dash-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">

                    </div>
                    <!-- [ breadcrumb ] end -->
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <div class="col-xl-3 col-6">
                            <div class="card comp-card">
                                <div class="card-body" style="min-height: 143px;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-20">Total des soumissions acceptées</h6>
                                            <h3 class="text-primary"><?php echo $accepted_count; ?></h3>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-3 rounded-circle bg-success text-white"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                                    <path
                                                        d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-3 col-6">
                            <div class="card comp-card">
                                <div class="card-body" style="min-height: 143px;">
                                    <div class="row align-items-center">
                                        <div class="col">

                                            <h6 class="m-b-20 ">Accepté ce  mois-ci &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                            <h3 class="text-primary"><?php echo $accepted_count_month; ?></h3>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-3 rounded bg-info text-white"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-calendar2-check-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5m9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5m-2.6 5.854a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-6">
                            <div class="card comp-card">
                                <div class="card-body" style="min-height: 143px;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-20">Total des soumissions en attente</h6>
                                            <h3 class="text-primary"><?php echo $pending_count; ?></h3>
                                        </div>
                                        <div class="col-auto">
                                            <div class=" bg-warning  p-3 rounded-circle text-white"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-patch-exclamation"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0z" />
                                                    <path
                                                        d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z" />
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-6">
                            <div class="card comp-card">
                                <div class="card-body" style="min-height: 143px;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-20">Total des soumissions rejetées</h6>
                                            <h3 class="text-primary"><?php echo $rejected_count; ?></h3>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-3 bg-danger text-white rounded-circle"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                            <div class="card">
                                <div class="card-header card-body table-border-style">
                                    <!-- <h5></h5> -->
                                    <div class="table-responsive">
                                        <table class="table" id="pc-dt-simple">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prenom</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Mobile </th>
                                                    <th scope="col">Adresse </th>
                                                    <th scope="col" class="text-center">Niveau d'etudes</th>
                                                    <th scope="col">Etablissement</th>
                                                    <th scope="col">Préference Niveau scolaire</th>
                                                    <th scope="col">Préference Matiére</th>
                                                    <th scope="col">Commentaire</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()) { 
                                                    $file_path = "uploads/" . $row['filename']; ?>
                                                <tr class="font-style">
                                                    <td><a href="#" class="btn btn-outline-primary"><?= $row['id'] ?></a>
                                                    </td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['prenom'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><?= $row['phone'] ?></td>
                                                    <td><?= $row['prestation'] ?></td>
                                                    <td><?= $row['apec'] ?></td>
                                                    <td><?= $row['destination'] ?></td>
                                                    <td><?= $row['nbrpassager'] ?></td>
                                                    <td><?= $row['preference'] ?></td>
                                                    <td style="overflow: auto; white-space: nowrap; max-width: 550px;"><?= $row['message'] ?></td>
                                                    <td>
                                                        <?php
        if (isset($row['statut'])) {
            if ($row['statut'] == 1) {
                echo '<span class="status_badge badge bg-primary p-2 px-3 rounded">Accepté</span>';
            } elseif ($row['statut'] == 0) {
                echo '<span class="status_badge badge bg-danger p-2 px-3 rounded">Rejeté</span>';
            } else {
                echo '<span class="status_badge badge bg-warning p-2 px-3 rounded">attend</span>';
            }
        } 
        ?>
                                                    </td>
                                                
                                                    <td
                                                        class="action text-right d-flex justify-content-around align-items-center">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-sm bg-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showModal<?= $row['id'] ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="white" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                        </button>










                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-sm ms-3 me-3 btn-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal<?= $row['id'] ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                            </svg>
                                                        </button>
                                                        <div class="action-btn ms-2 me-3">
                                                            <form id="deleteForm" method="POST"
                                                                action="delete_submissionn.php" accept-charset="UTF-8">
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <input name="submission_id" type="hidden"
                                                                    value="<?= $row['id'] ?>">
                                                                    <button type="button" class="mx-3 btn btn-sm d-flex  btn btn-danger align-items-center delete-btn"
        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
        data-submission-id="<?= $row['id'] ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
    </svg>
</button>


                                                            </form>
                                                        </div>
                                                        <?php

if ($row['filename'] != NULL) {
    echo '<a href="' . $file_path . '" class="download-btn" download><i class="fas fa-download"></i></a>';
}
?>

                                                        <!-- Confirm Delete Modal -->
                                                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                                            aria-labelledby="confirmDeleteModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="confirmDeleteModalLabel">Confirmation de
                                                                            suppression</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Êtes-vous sûr de vouloir supprimer cette
                                                                        soumission ?
                                                                    </div>
                                                                    <div
                                                                        class="modal-footer d-flex justify-content-center align-items-center mb-3">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                            id="confirmDeleteButton">Supprimer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>





                                                    </td>
                                                </tr>

                                                <!-- Show Modal -->

                                                <!-- Show Modal -->
                                                <div class="modal fade" id="showModal<?= $row['id'] ?>" tabindex="-1"
                                                    aria-labelledby="showModalLabel<?= $row['id'] ?>"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="showModalLabel<?= $row['id'] ?>">Détails de la soumission</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body d-flex flex-column">
                                                                <p><strong>Nom:</strong> <?= $row['name'] ?></p>
                                                                <p><strong>Prenom:</strong> <?= $row['prenom'] ?></p>
                                                                <p><strong>Email:</strong> <?= $row['email'] ?></p>
                                                                <p><strong>Adresse:</strong>
                                                                    <?= $row['prestation'] ?></p>
                                                                <p><strong>Etablissement:</strong>
                                                                    <?= $row['destination'] ?></p>
                                                                <p><strong>Message:</strong> <?= $row['message'] ?></p>
                                                                <p><strong>Niveau d'études :</strong>
                                                                    <?= $row['apec'] ?></p>
                                                                    <p><strong>Matiére de préference :</strong>
                                                                    <?= $row['preference'] ?></p>
                                                                <p><strong>Niveau de préference:</strong> <?= $row['nbrpassager'] ?></p>
                                                                <p><strong>Mobile:</strong>
                                                                    <?= $row['phone'] ?></p>
                                                                
                                                                <p><strong>Statut:</strong>
                                                                    <?= $row['statut'] == 1 ? 'Accepté' : ($row['statut'] == 0 ? 'Rejeté' : 'En Attente') ?>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>













                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1"
                                                    aria-labelledby="editModalLabel<?= $row['id'] ?>"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel<?= $row['id'] ?>">Modifier </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Edit Form -->
                                                                <form method="POST" action="update_entryy.php">
                                                                    <input type="hidden" name="entry_id"
                                                                        value="<?= $row['id'] ?>">

                                                                    <!-- Name Field -->
                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="form-label">Nom</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="<?= $row['name'] ?>">
                                                                    </div>

                                                                    <!-- Prenom Field -->
                                                                    <div class="mb-3">
                                                                        <label for="prenom"
                                                                            class="form-label">Prenom</label>
                                                                        <input type="text" class="form-control"
                                                                            id="prenom" name="prenom"
                                                                            value="<?= $row['prenom'] ?>">
                                                                    </div>

                                                                    <!-- Email Field -->
                                                                    <div class="mb-3">
                                                                        <label for="email"
                                                                            class="form-label">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            id="email" name="email"
                                                                            value="<?= $row['email'] ?>">
                                                                    </div>

                                                                    <!-- Prestation Field -->
                                                                    <div class="mb-3">
                                                                        <label for="prestation"
                                                                            class="form-label">Adresse</label>
                                                                        <input type="text" class="form-control"
                                                                            id="prestation" name="prestation"
                                                                            value="<?= $row['prestation'] ?>">
                                                                    </div>

                                                                    <!-- Destination Field -->
                                                                    <div class="mb-3">
                                                                        <label for="destination"
                                                                            class="form-label">Etablissement</label>
                                                                        <input type="text" class="form-control"
                                                                            id="destination" name="destination"
                                                                            value="<?= $row['destination'] ?>">
                                                                    </div>

                                                                    <!-- Message Field -->
                                                                    <div class="mb-3">
                                                                        <label for="message"
                                                                            class="form-label">Message</label>
                                                                        <textarea class="form-control" id="message"
                                                                            name="message"><?= $row['message'] ?></textarea>
                                                                    </div>

                                                                    <!-- NbrPassager Field -->
                                                                    <div class="mb-3">
                                                                        <label for="nbrpassager"
                                                                            class="form-label">Niveau de préférence</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nbrpassager" name="nbrpassager"
                                                                            value="<?= $row['nbrpassager'] ?>">
                                                                    </div>
                                                                    <!-- Restitution Field -->
                                                                    <div class="mb-3">
                                                                        <label for="restitution"
                                                                            class="form-label">Mobile</label>
                                                                        <input type="tel" class="form-control"
                                                                            id="restitution" name="phone"
                                                                            value="<?= $row['phone'] ?>">
                                                                    </div>

                                                                    <!-- APEC Field -->
                                                                    <div class="mb-3">
                                                                        <label for="apec"
                                                                            class="form-label">Niveau d'études</label>
                                                                        <input type="text" class="form-control"
                                                                            id="apec" name="apec"
                                                                            value="<?= $row['apec'] ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="apec"
                                                                            class="form-label">Matiére de préference</label>
                                                                        <input type="text" class="form-control"
                                                                            id="apec" name="preference"
                                                                            value="<?= $row['preference'] ?>">
                                                                    </div>



                                                                    <!-- DPEC Field -->
                                                                    

                                                                    <!-- Statut Field -->
                                                                    <div class="mb-3">
                                                                        <label for="statut"
                                                                            class="form-label">Statut</label>
                                                                        <select class="form-select" id="statut"
                                                                            name="statut">
                                                                            <option value="1"
                                                                                <?= isset($row['statut']) && $row['statut'] == 1 ? 'selected' : '' ?>>
                                                                                Accepté</option>
                                                                            <option value="0"
                                                                                <?= isset($row['statut']) && $row['statut'] == 0 ? 'selected' : '' ?>>
                                                                                Rejeté</option>
                                                                            <option value="2"
                                                                                <?= isset($row['statut']) && $row['statut'] == 2 ? 'selected' : '' ?>>
                                                                                En Attente</option>
                                                                        </select>
                                                                    </div>


                                                                    <!-- Buttons -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Sauvegarder les modifications</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>









                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body body">
                    <textarea>hello</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleOverModal" tabindex="-1" role="dialog" aria-labelledby="exampleOverModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title1 " id="exampleOverModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="commonModalOver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/perfect-scrollbar.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/feather.min.js"></script>
    <script src="js/dash.js"></script>
    
    
    

    
    <script src="js/main.min.js"></script>

   


    <script src="js/simple-datatables.js"></script>
    <script>
    if ($("#pc-dt-simple").length > 0) {
        const dataTable = new simpleDatatables.DataTable("#pc-dt-simple");
    }
    </script>


    

    <!-- date -->
    

    <!--Botstrap switch-->
    

    
    

    


   
    <script>
    if ($(".multi-select").length > 0) {
        $($(".multi-select")).each(function(index, element) {
            var id = $(element).attr('id');
            var multipleCancelButton = new Choices(
                '#' + id, {
                    removeItemButton: true,
                }
            );
        });
    }
    </script>
    <!-- report data table-->
    <script>
    if ($("#pc-dt-export").length > 0) {
        const table = new simpleDatatables.DataTable(".pc-dt-export");

    }
    </script>

    <script>
    function taskCheckbox() {
        var checked = 0;
        var count = 0;
        var percentage = 0;

        count = $("#check-list input[type=checkbox]").length;
        checked = $("#check-list input[type=checkbox]:checked").length;
        percentage = parseInt(((checked / count) * 100), 10);
        if (isNaN(percentage)) {
            percentage = 0;
        }
        $(".custom-label").text(percentage + "%");
        $('#taskProgress').css('width', percentage + '%');


        $('#taskProgress').removeClass('bg-warning');
        $('#taskProgress').removeClass('bg-primary');
        $('#taskProgress').removeClass('bg-success');
        $('#taskProgress').removeClass('bg-danger');

        if (percentage <= 15) {
            $('#taskProgress').addClass('bg-danger');
        } else if (percentage > 15 && percentage <= 33) {
            $('#taskProgress').addClass('bg-warning');
        } else if (percentage > 33 && percentage <= 70) {
            $('#taskProgress').addClass('bg-primary');
        } else {
            $('#taskProgress').addClass('bg-success');
        }
    }
    </script>



   






   



    



    ​

    



    <script>
    var exampleModal = document.getElementById('exampleModal')

    exampleModal.addEventListener('show.bs.modal', function(event) {

        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        var url = button.getAttribute('data-url')
        var size = button.getAttribute('data-size');
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')
        modalTitle.textContent = recipient
        $("#exampleModal .modal-dialog").addClass('modal-' + size);
        $.ajax({
            url: url,
            success: function(data) {
                $('#exampleModal .modal-body').html(data);
                $("#exampleModal").modal('show');
            },
            error: function(data) {
                data = data.responseJSON;
                toastrs('Error', data.error, 'error')
            }
        });
    })



    var exampleOverModal = document.getElementById('exampleOverModal')

    exampleOverModal.addEventListener('show.bs.modal', function(event) {
        console.log('b');
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        var url = button.getAttribute('data-url')
        var size = button.getAttribute('data-size');
        var modalTitle = exampleOverModal.querySelector('.modal-title1')

        var modalBodyInput = exampleOverModal.querySelector('.modal-body input')
        modalTitle.textContent = recipient
        $("#exampleOverModal .modal-dialog").addClass('modal-' + size);
        $.ajax({
            url: url,
            success: function(data) {
                //   $("#exampleOverModal").modal('hide');

                $('#exampleOverModal .modal-body').html(data);
                $("#exampleOverModal").modal('show');
            },
            error: function(data) {
                data = data.responseJSON;
                toastrs('Error', data.error, 'error')
            }
        });
    })




    function arrayToJson(form) {
        var data = $(form).serializeArray();
        var indexed_array = {};

        $.map(data, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    $(document).on('click', '.local_calender .fc-daygrid-event', function(e) {
        //  var calender_type = $('#calender_type :selected').val();
        // if(calender_type == 'local_calender'){
        // if (!$(this).hasClass('project')) {
        e.preventDefault();
        var event = $(this);
        var title = $(this).find('.fc-event-title').html();
        var size = 'md';
        var url = $(this).attr('href');
        $("#exampleModal .modal-title").html(title);
        $("#exampleModal .modal-dialog").addClass('modal-' + size);
        $.ajax({
            url: url,
            success: function(data) {
                $('#exampleModal .modal-body').html(data);
                $("#exampleModal").modal('show');

            },
            error: function(data) {
                data = data.responseJSON;
                toastrs('Error', data.error, 'error')
            }
        });
        // }
        // }
    });
    </script>



    ​ ​
    <script>
    // Add event listeners to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Get the submission ID associated with this row
            var submissionId = this.getAttribute('data-submission-id');
            // Set the value of the hidden input field to the submission ID
            document.querySelector('#deleteForm input[name="submission_id"]').value = submissionId;
        });
    });

    // Add event listener to the confirm delete button
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>
    ​
    
</body>

</html>