<?php
session_start();
$login = false;
$username = "";
$type = '';
if (isset($_SESSION['type'])) {
    $type = $_SESSION['type'];
    if ($type == 'admin') {
        $login = true;
        $username = $_SESSION['username'];
    } else {
        $login = false;
        header("Location:../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}

include "../conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Site Managment- Admin Panel</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/templatemo-kind-heart-charity.css" rel="stylesheet">

    <script src="../js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {

            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin-bottom: 20px;
        }

        #table-container {
            margin: 0 auto;
            width: 80%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }



        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {

            font-weight: bold;
        }
    </style>
</head>

<body id="section_1">

    <header class="site-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        Kingdom of Saudi Arabia
                    </p>

                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>

                        <a href="taatawaa@gmail.com">
                            taatawaa@gmail.com

                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-youtube"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="../images/logo.JPEG" class="logo img-fluid" alt=" Volunteer">
                <span>
                    Dashboard
                </span>

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="school_managment.php">Schools Managment</a>
                    </li>

                    <li class="nav-item ms-3">

                        <a class="nav-link btn-outline-danger custom-btn custom-border-btn btn" href="../logout.php">Logout</a>
                        <p class="d-inline"><?= $username ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>