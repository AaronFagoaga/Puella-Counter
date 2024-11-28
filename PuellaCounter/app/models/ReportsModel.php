<?php
class ReportsModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getBuyReports($company_id, $start_date, $end_date)
    {
        $query = "CALL sp_get_buy_recipt_by_period(:company_id, :start_date, :end_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":company_id", $company_id);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellReports($company_id, $start_date, $end_date)
    {
        $query = "CALL sp_get_sell_recipt_by_period(:company_id, :start_date, :end_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":company_id", $company_id);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
