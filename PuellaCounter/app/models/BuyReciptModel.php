<?php

class BuyReciptModel{
    private $conn;
    private $table_name = "tbl_buy_recipt";

    public $id_buy_recipt;
    public $buy_type;
    public $buy_number;
    public $buy_date;
    public $buy_amount;
    public $buy_provider;
    public $buy_file;
    public $id_company;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_insert_buy_recipt(:buy_type, :buy_date, :buy_amount, :buy_provider, :buy_file, :id_company);";
        $stmt = $this->conn->prepare($query);
        $this->sanitize();

        // Convertir el contenido del archivo a un parámetro binario
        $stmt->bindParam(":buy_type", $this->buy_type);
        $stmt->bindParam(":buy_date", $this->buy_date);
        $stmt->bindParam(":buy_amount", $this->buy_amount);
        $stmt->bindParam(":buy_provider", $this->buy_provider);
        $stmt->bindParam(":buy_file", $this->buy_file, PDO::PARAM_LOB);
        $stmt->bindParam(":id_company", $this->id_company);

        return $stmt->execute();
    }
    public function getBuyRecipts()
    {
        $query = "CALL sp_get_buy_recipt_by_company_id(:id_company);";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id_company", $this->id_company);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        return $result; 
    }

    public function getBuyReciptByID()
    {
        $query = "CALL sp_get_buy_recipt_by_id(:id_buy_recipt);";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_buy_recipt", $this->id_buy_recipt);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->buy_type = $row["buy_type"];
            $this->buy_number = $row["buy_number"];
            $this->buy_date = $row["buy_date"];
            $this->buy_amount = $row["buy_amount"];
            $this->buy_provider = $row["buy_provider"];
            $this->buy_file = $row["buy_file"];
            $this->id_company = $row["id_company"];
        }
    }

    public function update()
    {
        $query = "CALL sp_update_buy_recipt(:id_buy_recipt, :buy_type, :buy_date, :buy_amount, :buy_provider, :buy_file);";
        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":id_buy_recipt", $this->id_buy_recipt);
        $stmt->bindParam(":buy_type", $this->buy_type);
        $stmt->bindParam(":buy_date", $this->buy_date);
        $stmt->bindParam(":buy_amount", $this->buy_amount);
        $stmt->bindParam(":buy_provider", $this->buy_provider);
        $stmt->bindParam(":buy_file", $this->buy_file);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "CALL sp_delete_buy_recipt(:id_buy_recipt);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_buy_recipt", $this->id_buy_recipt);

        return $stmt->execute();
    }
    public function getFileContent($id)
    {
        $query = "SELECT buy_file FROM tbl_buy_recipt WHERE id_buy_recipt = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['buy_file'] : null;
    }

    private function sanitize()
    {
        $this->buy_type = htmlspecialchars(strip_tags($this->buy_type));
        $this->buy_number = htmlspecialchars(strip_tags($this->buy_number));
        $this->buy_date = htmlspecialchars(strip_tags($this->buy_date));
        $this->buy_amount = htmlspecialchars(strip_tags($this->buy_amount));
        $this->buy_provider = htmlspecialchars(strip_tags($this->buy_provider));
        $this->buy_file = htmlspecialchars(strip_tags($this->buy_file));
        $this->id_company = htmlspecialchars(strip_tags($this->id_company));
    }

}