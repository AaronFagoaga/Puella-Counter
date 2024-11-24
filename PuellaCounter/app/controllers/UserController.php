<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/UserModel.php");

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new UserModel($this->db);
    }

    public function index()
    {
        $result = $this->user->getUsers();
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/user/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->user->user_name = $_POST['user_name'];
            $this->user->user_email = $_POST['user_email'];
            $this->user->user_login_name = $_POST['user_login_name'];
            $this->user->user_password = $_POST['user_password'];
            $this->user->id_rol = $_POST['id_rol'];

            header("Location: ../user/user.php");
            return $this->user->create(); 
        }

        $rolesResult = $this->user->getRoles();
        $roles = $rolesResult->fetchAll(PDO::FETCH_ASSOC);

        include(dirname(__FILE__) . '/../views/user/create.php');
    }

    public function edit($id)
    {
        $this->user->id_user = $id;
        $this->user->getUserByID();

        if ($_POST) {
            $this->user->user_name = $_POST['user_name'];
            $this->user->user_email = $_POST['user_email'];
            $this->user->user_login_name = $_POST['user_login_name'];
            $this->user->user_password = $_POST['user_password'];
            $this->user->id_rol = $_POST['id_rol'];

            header("Location: ../user/user.php");
            return $this->user->update();
        }

        $rolesResult = $this->user->getRoles();
        $roles = $rolesResult->fetchAll(PDO::FETCH_ASSOC);

        $users = $this->user;
        include(dirname(__FILE__) . '/../views/user/update.php');
    }

    public function delete($id)
    {
        $this->user->id_user = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->user->delete()) {
                    header("Location: ../user/user.php");
                    exit();
                }
            } else {
                header("Location: ../user/user.php");
                exit();
            }
        }

        $this->user->getUserByID();
        $user = $this->user;

        include(dirname(__FILE__) . '/../views/user/delete.php');
    }
}
