<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/SellReciptModel.php");
require_once(dirname(__FILE__) . "/../models/BuyReciptModel.php");

class ReciptController
{
    private $db;
    private $sellRecipt;
    private $buyRecipt;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sellRecipt = new SellReciptModel($this->db);
        $this->buyRecipt = new BuyReciptModel($this->db);
    }

    public function index($id_company)
    {
        $this->buyRecipt->id_company = $id_company;
        $this->sellRecipt->id_company = $id_company;

        $buyRecipts = $this->buyRecipt->getBuyRecipts(); 
        $sellRecipts = $this->sellRecipt->getSellRecipts(); 

        require_once(dirname(__FILE__) . '/../views/recipts/index.php');
    }

    public function create()
    {
        require_once(dirname(__FILE__) . '/../views/recipts/create.php');
    }

    public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $type = $_POST['type']; 
        $file = $_FILES['file'];

        $allowedTypes = ['application/pdf', 'application/json'];
        if (!in_array($file['type'], $allowedTypes)) {
            header("Location: recipts.php?error=invalid_file_type");
            exit();
        }

        $fileContent = file_get_contents($file['tmp_name']);
        
        if ($type === 'sell') {
            $this->sellRecipt->sell_type = $_POST['class'];
            $this->sellRecipt->sell_date = $_POST['date'];
            $this->sellRecipt->sell_amount = $_POST['amount'];
            $this->sellRecipt->sell_client = $_POST['client'];
            $this->sellRecipt->sell_file = $fileContent;
            $this->sellRecipt->id_company = $_POST['id_company'];
            $this->sellRecipt->create();
        } elseif ($type === 'buy') {
            $this->buyRecipt->buy_type = $_POST['class'];
            $this->buyRecipt->buy_date = $_POST['date'];
            $this->buyRecipt->buy_amount = $_POST['amount'];
            $this->buyRecipt->buy_provider = $_POST['provider'];
            $this->buyRecipt->buy_file = $fileContent; 
            $this->buyRecipt->id_company = $_POST['id_company'];
            $this->buyRecipt->create();
        }

        header("Location: recipts.php?id_company=" . $_POST['id_company']);
    }
}

    public function editSell($id)
    {
            $this->sellRecipt->id_sell_recipt = $id;
            $this->sellRecipt->getSellReciptByID();
            if ($_POST) {
                $this->sellRecipt->id_sell_recipt = $id;
                $this->sellRecipt->sell_type = $_POST['class'];
                $this->sellRecipt->sell_number = $_POST['number'];
                $this->sellRecipt->sell_date = $_POST['date'];
                $this->sellRecipt->sell_amount = $_POST['amount'];
                $this->sellRecipt->sell_client = $_POST['client'];
                $this->sellRecipt->id_company = $_POST['id_company'];
                header("Location: recipts.php?id_company=" . $_POST['id_company']);
                return $this->sellRecipt->update();
            }
            
            $theSellRecipt = $this->sellRecipt;
            include(dirname(__FILE__) . '/../views/recipts/updateSell.php');
    }

    public function editBuy($id)
    {
            $this->buyRecipt->id_buy_recipt = $id;
            $this->buyRecipt->getbuyReciptByID();
            if ($_POST) {
                $this->buyRecipt->id_buy_recipt = $id;
                $this->buyRecipt->buy_type = $_POST['class'];
                $this->buyRecipt->buy_number = $_POST['number'];
                $this->buyRecipt->buy_date = $_POST['date'];
                $this->buyRecipt->buy_amount = $_POST['amount'];
                $this->buyRecipt->buy_provider = $_POST['provider'];
                $this->buyRecipt->id_company = $_POST['id_company'];
                header("Location: recipts.php?id_company=" . $_POST['id_company']);
                return $this->buyRecipt->update();
            }
            $theBuyRecipt = $this->buyRecipt;
            include(dirname(__FILE__) . '/../views/recipts/updateBuy.php');
    }

    public function deleteBuy($id)
    {
        $this->buyRecipt->id_buy_recipt = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->buyRecipt->delete()) {
                    header("Location: recipts.php?id_company=" . $_GET['id_company']);
                    exit();
                }
            } else {
                header("Location: recipts.php?id_company=" . $_GET['id_company']);
                exit();
            }
        }

        $this->buyRecipt->getBuyReciptByID();
        $theBuyRecipt = $this->buyRecipt;
        include(dirname(__FILE__) . '/../views/recipts/deleteBuy.php');
    }

    public function deleteSell($id)
    {
        $this->sellRecipt->id_sell_recipt = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->sellRecipt->delete()) {
                    header("Location: recipts.php?id_company=" . $_GET['id_company']);
                    exit();
                }
            } else {
                header("Location: recipts.php?id_company=" . $_GET['id_company']);
                exit();
            }
        }

        $this->sellRecipt->getSellReciptByID();
        $theSellRecipt = $this->sellRecipt;
        include(dirname(__FILE__) . '/../views/recipts/deleteSell.php');
    }
    public function downloadFile($type, $id)
    {
        try {
            if ($type === 'buy') {
                $this->buyRecipt->id_buy_recipt = $id;
                $fileContent = $this->buyRecipt->getFileContent($id);
                $fileName = "comprobante_compra_{$id}.pdf";
            } elseif ($type === 'sell') {
                $this->sellRecipt->id_sell_recipt = $id;
                $fileContent = $this->sellRecipt->getFileContent($id);
                $fileName = "comprobante_venta_{$id}.pdf"; 
            } else {
                throw new Exception("Tipo de comprobante inválido");
            }

            if ($fileContent === false) {
                throw new Exception("Archivo no encontrado");
            }

            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $mimeTypes = [
                'pdf' => 'application/pdf',
                'json' => 'application/json'
            ];
            $mimeType = $mimeTypes[$fileExtension] ?? 'application/octet-stream';

            header('Content-Type: ' . $mimeType);
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Length: ' . strlen($fileContent));

            echo $fileContent;
            exit();
        } catch (Exception $e) {
            header("HTTP/1.1 404 Not Found");
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
}
?>
