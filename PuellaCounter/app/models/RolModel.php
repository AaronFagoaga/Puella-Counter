<?php
class RoleModel
{
    private $conn;
    private $table_name = "tbl_rol";

    public $id_rol;
    public $rol_name;
    public $rol_info;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_insert_rol(:rol_name, :rol_info);";
        $stmt = $this->conn->prepare($query);

        $this->rol_name = htmlspecialchars(strip_tags($this->rol_name));
        $this->rol_info = htmlspecialchars(strip_tags($this->rol_info));

        $stmt->bindParam(":rol_name", $this->rol_name);
        $stmt->bindParam(":rol_info", $this->rol_info);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getRoles()
    {
        $query = "CALL sp_get_all_roles();";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getRoleByID()
    {
        $query = "CALL sp_get_rol_by_id(:id_rol);";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $this->id_rol);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->rol_name = $row["rol_name"];
            $this->rol_info = $row["rol_info"];
        }
    }

    public function update()
    {
        $query = "CALL sp_update_rol(:id_rol, :rol_name, :rol_info);";
        $stmt = $this->conn->prepare($query);

        $this->rol_name = htmlspecialchars(strip_tags($this->rol_name));
        $this->rol_info = htmlspecialchars(strip_tags($this->rol_info));

        $stmt->bindParam(":id_rol", $this->id_rol);
        $stmt->bindParam(":rol_name", $this->rol_name);
        $stmt->bindParam(":rol_info", $this->rol_info);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "CALL sp_delete_rol(:id_rol);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $this->id_rol);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}