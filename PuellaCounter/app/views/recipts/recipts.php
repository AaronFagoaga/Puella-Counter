<?php
require_once __DIR__ . '/../../../app/controllers/ReciptController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$id_company = isset($_GET['id_company']) ? $_GET['id_company'] : ''; 

$controller = new ReciptController();

switch ($action) {
    case 'create':
        $controller->create();
        break;

    case 'editSell':
        if ($id) {
            $controller->editSell($id);
        } else {
            break;
        }

    case 'editBuy':
        if ($id) {
            $controller->editBuy($id);
        } else {
            break;
        }    

    case 'deleteBuy':
        if ($id) {
            $controller->deleteBuy($id);
        } else {
            break;
        }

    case 'deleteSell':
        if ($id) {
            $controller->deleteSell($id);
        } else {
            break;
        }

    case 'store':
        $controller->store();
            break;
    
       default:
        if ($id_company) {
            $controller->index($id_company);
        } else {
            echo "ID de empresa no proporcionado.";
        }
        break;
}
?>
