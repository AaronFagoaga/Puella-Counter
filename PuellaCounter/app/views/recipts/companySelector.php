<?php
include '../template/header.php';
require_once(dirname(__FILE__) . "/../../../config/config.php");
require_once(dirname(__FILE__) . "/../../../core/database.php");

$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT id_company, company_name FROM tbl_company";
$stmt = $conn->prepare($sql);
$stmt->execute();
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Gestor de comprobantes</h2>
        <form action="recipts.php" method="GET">
            <div class="mb-3">
                <label for="empresa" class="form-label">Seleccione la empresa</label>
                <select name="id_company" id="empresa" class="form-select" required>
                    <option value="">-- Seleccione una empresa --</option>
                    <?php
                    if (count($companies) > 0) {
                        foreach ($companies as $company) {
                            echo '<option value="' . htmlspecialchars($company['id_company']) . '">' . htmlspecialchars($company['company_name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay empresas disponibles</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mostrar comprobantes</button>
        </form>
    </div>
</div>

<?php
$conn = null;
include '../template/footer.php';
?>
