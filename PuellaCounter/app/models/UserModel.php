<?php
class UserModel
{
    private $conn;
    private $table_name = "tbl_user";

    public $id_user;
    public $user_name;
    public $user_email;
    public $user_login_name;
    public $user_password;
    public $id_rol;
    public $rol_name; //Para el nombre del rol

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_insert_user(:user_name, :user_email, :user_login_name, :user_password, :id_rol);";
        $stmt = $this->conn->prepare($query);

        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_login_name = htmlspecialchars(strip_tags($this->user_login_name));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        $this->id_rol = htmlspecialchars(strip_tags($this->id_rol));

        $this->user_password = md5($this->user_password);

        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->bindParam(":user_login_name", $this->user_login_name);
        $stmt->bindParam(":user_password", $this->user_password);
        $stmt->bindParam(":id_rol", $this->id_rol);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getUsers()
    {
        $query = "CALL sp_get_all_users();";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getUserByID()
    {
        $query = "CALL sp_get_user_by_id(:id_user);";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->user_name = $row["user_name"];
            $this->user_email = $row["user_email"];
            $this->user_login_name = $row["user_login_name"];
            $this->user_password = $row['user_password'];
            $this->id_rol = $row["id_rol"];
        }
    }

    public function update()
    {
        $query = "CALL sp_update_user(:id_user, :user_name, :user_email, :user_login_name, :user_password, :id_rol);";

        $stmt = $this->conn->prepare($query);

        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_login_name = htmlspecialchars(strip_tags($this->user_login_name));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        $this->id_rol = htmlspecialchars(strip_tags($this->id_rol));

        $this->user_password = md5($this->user_password);

        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->bindParam(":user_login_name", $this->user_login_name);
        $stmt->bindParam(":user_password", $this->user_password);
        $stmt->bindParam(":id_rol", $this->id_rol);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "CALL sp_delete_user(:id_user);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_user", $this->id_user);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getRoles()
    {
        $query = "SELECT id_rol, rol_name FROM tbl_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
