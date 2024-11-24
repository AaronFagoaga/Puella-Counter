<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/database.php");
require_once(dirname(__FILE__) . "/../app/models/UserModel.php");

class Auth
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new UserModel($this->db);
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userLoginName = htmlspecialchars(strip_tags($_POST['user_login_name']));
            $userPassword = md5(htmlspecialchars(strip_tags($_POST['user_password'])));

            $query = "SELECT * FROM tbl_user WHERE user_login_name = :userLoginName AND user_password = :userPassword";
            $result = $this->db->prepare($query);
            $result->bindParam(":userLoginName", $userLoginName);
            $result->bindParam(":userPassword", $userPassword);
            $result->execute();

            if ($result->rowCount() == 1) {
                $userData = $result->fetch(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION["UserID"] = $userData['id_user'];
                $_SESSION["userName"] = $userData['user_name'];
                $_SESSION["userEmail"] = $userData['user_email'];
                $_SESSION["RolID"] = $userData['id_rol'];
                
                header("Location: index.php");
                exit();
            } else {
                $error = "Inicio de sesión fallido. Nombre de usuario o contraseña incorrectos.";
            }
        }
    }
}
