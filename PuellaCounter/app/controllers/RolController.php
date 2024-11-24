<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/RolModel.php");

class RolController
{
    private $db;
    private $rol;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rol = new RoleModel($this->db);
    }

    public function index()
    {
        $result = $this->rol->getRoles();
        $roles = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/rol/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->rol->rol_name = $_POST['rol_name'];
            $this->rol->rol_info = $_POST['rol_info'];

            header("Location: ../rol/rol.php");
            return $this->rol->create(); 
        }
        include(dirname(__FILE__) . '/../views/rol/create.php');
    }

    public function edit($id)
    {
        $this->rol->id_rol = $id;
        $this->rol->getRoleByID();

        if ($_POST) {
            $this->rol->rol_name = $_POST['rol_name'];
            $this->rol->rol_info = $_POST['rol_info'];

            header("Location: ../rol/rol.php");
            return $this->rol->update();
        }
        $roles = $this->rol;
        include(dirname(__FILE__) . '/../views/rol/update.php');
    }

    public function delete($id)
    {
        $this->rol->id_rol = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->rol->delete()) {
                    header("Location: ../rol/rol.php");
                    exit();
                }
            } else {
                header("Location: ../rol/rol.php");
                exit();
            }
        }

        $this->rol->getRoleByID();
        $roles = $this->rol;

        include(dirname(__FILE__) . '/../views/rol/delete.php');
    }
}
