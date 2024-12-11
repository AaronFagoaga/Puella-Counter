<?php
session_start();
if ($_SESSION['userName'] == "") {
    header("Location: ../../../index.php");
    exit();
}

require_once __DIR__ . '/../../../app/controllers/ReportController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new ReportController();

switch ($action) {
    case 'sellReports':
        $controller->sellReports();
        break;

    case 'buyReports':
        $controller->buyReports();
        break;

    default:
        $controller->buyReports();
        break;
}