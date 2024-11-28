<?php
session_start();
if ($_SESSION['userName'] == "") {
    header("Location: ../../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Puella Counter</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../../public/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../../public/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../../public/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../../../public/assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../../public/assets/images/favicon.png" />
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../page/index.php">
                        <img src="../../../public/assets/images/logo.png" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="../page/index.php">
                        <img src="../../../public/assets/images/logo2.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Hola de nuevo, <span class="text-black fw-bold"><?php echo $_SESSION["userName"] ?></span></h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../../../public/assets/images/user.png" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../../../public/assets/images/user.png" alt="Profile image">
                                <p class="mb-1 mt-3 fw-semibold"><?php echo $_SESSION["userName"] ?></p>
                                <p class="fw-light text-muted mb-0"><?php echo $_SESSION["userEmail"] ?></p>
                            </div>
                            <hr>
                            <a href="../../../core/exit.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Cerrar Sesión</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../page/index.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Elementos</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                            <i class="menu-icon mdi mdi-table"></i>
                            <span class="menu-title">Tablas</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../company/company.php">Empresas</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../user/user.php">Usuarios</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../rol/rol.php">Roles</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Facturación</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../recipts/companySelector.php">Comprobantes</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../reports/report.php?action=buyReports">Reportes de compra</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../reports/report.php?action=sellReports">Reportes de ventas</a></li>
                            </ul>
                        </div>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-logout"></i>
                            <span class="menu-title">Salir</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../../core/exit.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">