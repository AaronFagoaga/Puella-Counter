<?php
session_start();
if ($_SESSION['userName'] == "" || $_SESSION["RolID"] != 1) {
    header("Location: ../../../index.php");
    exit();
}

require_once __DIR__ . '/../../../app/controllers/CompanyController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

$controller = new CompanyController();

switch ($action) {
    case 'create':
        $controller->create();
        break;

    case 'edit':
        if ($id) {
            $controller->edit($id);
        } else {
            $controller->index();
        }
        break;

    case 'delete':
        if ($id) {
            $controller->delete($id);
        } else {
            $controller->index();
        }
        break;

    default:
        $controller->index();
        break;
}
