<?php include '../template/header.php'; 
$id_company = isset($_GET['id_company']) ? $_GET['id_company'] : null;
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Crear Comprobante</h2>

        <form action="recipts.php?action=store" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="type" class="form-label">Tipo de Comprobante</label>
                <select name="type" id="type" class="form-select" required onchange="toggleFields()">
                    <option value="">Seleccione un tipo de comprobante</option>
                    <option value="sell">Venta</option>
                    <option value="buy">Compra</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Tipo de factura</label>
                <select name="class" id="class" class="form-select" required onchange="toggleFields()">
                    <option value="">Seleccione un tipo de factura</option>
                    <option value="Consumidor final">Consumidor final</option>
                    <option value="Crédito fiscal">Crédito fiscal</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="date" id="date" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Monto</label>
                <input type="text" class="form-control" name="amount" id="amount" pattern="^\d+(\.\d{1,2})?$" required title="Ingrese un número válido con hasta 2 decimales.">
            </div>

            <div class="mb-3" id="clientField" style="display: none;">
                <label for="client" class="form-label">Cliente (solo para Venta)</label>
                <input type="text" class="form-control" name="client" id="client">
            </div>

            <div class="mb-3" id="providerField" style="display: none;">
                <label for="provider" class="form-label">Proveedor (solo para Compra)</label>
                <input type="text" class="form-control" name="provider" id="provider">
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Archivo</label>
                <input type="file" class="form-control" name="file" id="file" accept=".pdf, .json">
            </div>

            <input type="hidden" name="id_company" value="<?= htmlspecialchars($id_company); ?>">

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script>
    function toggleFields() {
        const type = document.getElementById('type').value;
        const clientField = document.getElementById('clientField');
        const providerField = document.getElementById('providerField');

        if (type === 'sell') {
            clientField.style.display = 'block';
            providerField.style.display = 'none';
        } else if (type === 'buy') {
            clientField.style.display = 'none';
            providerField.style.display = 'block';
        } else {
            clientField.style.display = 'none';
            providerField.style.display = 'none';
        }
    }
</script>

<?php include '../template/footer.php'; ?>
