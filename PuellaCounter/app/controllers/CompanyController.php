<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/CompanyModel.php");

class CompanyController
{
    private $db;
    private $company;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->company = new CompanyModel($this->db);
    }

    public function index()
    {
        $result = $this->company->getCompanies();
        $companies = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/company/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->company->company_name = $_POST['company_name'];
            $this->company->company_type = $_POST['company_type'];
            $this->company->company_address = $_POST['company_address'];
            $this->company->company_phone = $_POST['company_phone'];
            $this->company->company_email = $_POST['company_email'];

            if ($this->company->create()) {
                header("Location: ../company/company.php");
                exit();
            }
        }
        include(dirname(__FILE__) . '/../views/company/create.php');
    }

    public function edit($id)
    {
        $this->company->id_company = $id;
        $this->company->getCompanyByID();

        if ($_POST) {
            $this->company->company_name = $_POST['company_name'];
            $this->company->company_type = $_POST['company_type'];
            $this->company->company_address = $_POST['company_address'];
            $this->company->company_phone = $_POST['company_phone'];
            $this->company->company_email = $_POST['company_email'];

            if ($this->company->update()) {
                header("Location: ../company/company.php");
                exit();
            }
        }
        $companies = $this->company;
        include(dirname(__FILE__) . '/../views/company/update.php');
    }

    public function delete($id)
    {
        $this->company->id_company = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->company->delete()) {
                    header("Location: ../company/company.php");
                    exit();
                }
            } else {
                header("Location: ../company/company.php");
                exit();
            }
        }

        $this->company->getCompanyByID();
        $companies = $this->company;

        include(dirname(__FILE__) . '/../views/company/delete.php');
    }
}
