<?php
class CompanyModel
{
    private $conn;
    private $table_name = "tbl_company";

    public $id_company;
    public $company_name;
    public $company_type;
    public $company_address;
    public $company_phone;
    public $company_email;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_insert_company(:company_name, :company_type, :company_address, :company_phone, :company_email);";
        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":company_name", $this->company_name);
        $stmt->bindParam(":company_type", $this->company_type);
        $stmt->bindParam(":company_address", $this->company_address);
        $stmt->bindParam(":company_phone", $this->company_phone);
        $stmt->bindParam(":company_email", $this->company_email);

        return $stmt->execute();
    }

    public function getCompanies()
    {
        $query = "CALL sp_get_all_companies();";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getCompanyByID()
    {
        $query = "CALL sp_get_company_by_id(:id_company);";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_company", $this->id_company);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->company_name = $row["company_name"];
            $this->company_type = $row["company_type"];
            $this->company_address = $row["company_address"];
            $this->company_phone = $row["company_phone"];
            $this->company_email = $row["company_email"];
        }
    }

    public function update()
    {
        $query = "CALL sp_update_company(:id_company, :company_name, :company_type, :company_address, :company_phone, :company_email);";
        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":id_company", $this->id_company);
        $stmt->bindParam(":company_name", $this->company_name);
        $stmt->bindParam(":company_type", $this->company_type);
        $stmt->bindParam(":company_address", $this->company_address);
        $stmt->bindParam(":company_phone", $this->company_phone);
        $stmt->bindParam(":company_email", $this->company_email);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "CALL sp_delete_company(:id_company);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_company", $this->id_company);

        return $stmt->execute();
    }

    private function sanitize()
    {
        $this->company_name = htmlspecialchars(strip_tags($this->company_name));
        $this->company_type = htmlspecialchars(strip_tags($this->company_type));
        $this->company_address = htmlspecialchars(strip_tags($this->company_address));
        $this->company_phone = htmlspecialchars(strip_tags($this->company_phone));
        $this->company_email = htmlspecialchars(strip_tags($this->company_email));
    }
}
