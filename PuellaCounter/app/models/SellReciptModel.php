<?php
class SellReciptModel{
    private $conn;
    private $table_name = "tbl_sell_recipt";

    public $id_sell_recipt;
    public $sell_type;
    public $sell_number;
    public $sell_date;
    public $sell_amount;
    public $sell_client;
    public $sell_file;
    public $id_company;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_insert_sell_recipt(:sell_type, :sell_date, :sell_amount, :sell_client, :sell_file, :id_company);";
        $stmt = $this->conn->prepare($query);
        $this->sanitize();

        // Convertir el contenido del archivo a un parámetro binario
        $stmt->bindParam(":sell_type", $this->sell_type);
        $stmt->bindParam(":sell_date", $this->sell_date);
        $stmt->bindParam(":sell_amount", $this->sell_amount);
        $stmt->bindParam(":sell_client", $this->sell_client);
        $stmt->bindParam(":sell_file", $this->sell_file, PDO::PARAM_LOB);
        $stmt->bindParam(":id_company", $this->id_company);

        return $stmt->execute();
    }

    public function getsellRecipts()
    {
        $query = "CALL sp_get_sell_recipt_by_company_id(:id_company);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_company", $this->id_company);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    public function getsellReciptByID()
    {
        $query = "CALL sp_get_sell_recipt_by_id(:id_sell_recipt);";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_sell_recipt", $this->id_sell_recipt);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->sell_type = $row["sell_type"];
            $this->sell_number = $row["sell_number"];
            $this->sell_date = $row["sell_date"];
            $this->sell_amount = $row["sell_amount"];
            $this->sell_client = $row["sell_client"];
            $this->sell_file = $row["sell_file"];
            $this->id_company = $row["id_company"];
        }
    }

    public function update()
    {
        $query = "CALL sp_update_sell_recipt(:id_sell_recipt, :sell_type, :sell_date, :sell_amount, :sell_client, :sell_file);";
        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":id_sell_recipt", $this->id_sell_recipt);
        $stmt->bindParam(":sell_type", $this->sell_type);
        $stmt->bindParam(":sell_date", $this->sell_date);
        $stmt->bindParam(":sell_amount", $this->sell_amount);
        $stmt->bindParam(":sell_client", $this->sell_client);
        $stmt->bindParam(":sell_file", $this->sell_file);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "CALL sp_delete_sell_recipt(:id_sell_recipt);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_sell_recipt", $this->id_sell_recipt);

        return $stmt->execute();
    }

    public function getFileContent($id)
    {
        $query = "SELECT sell_file FROM tbl_sell_recipt WHERE id_sell_recipt = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['sell_file'] : null;
    }


    private function sanitize()
    {
        $this->sell_type = htmlspecialchars(strip_tags($this->sell_type));
        $this->sell_number = htmlspecialchars(strip_tags($this->sell_number));
        $this->sell_date = htmlspecialchars(strip_tags($this->sell_date));
        $this->sell_amount = htmlspecialchars(strip_tags($this->sell_amount));
        $this->sell_client = htmlspecialchars(strip_tags($this->sell_client));
        $this->sell_file = htmlspecialchars(strip_tags($this->sell_file));
        $this->id_company = htmlspecialchars(strip_tags($this->id_company));
    }

}