<?php include '../template/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Comprobante de Venta</h2>
        <form action="" method="POST">
            <input type="hidden" name="id_company" value="<?= htmlspecialchars($theSellRecipt->id_company); ?>">

            <div class="mb-3">
                <label for="class" class="form-label">Tipo de factura:</label>
                <input type="text" id="class" name="class" value="<?= htmlspecialchars($theSellRecipt->sell_type); ?>" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Fecha:</label>
                <input type="text" id="date" name="date" value="<?= htmlspecialchars($theSellRecipt->sell_date); ?>" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Monto:</label>
                <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($theSellRecipt->sell_amount); ?>" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label for="client" class="form-label">Cliente:</label>
                <input type="text" id="client" name="client" value="<?= htmlspecialchars($theSellRecipt->sell_client); ?>" class="form-control" disabled>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?&id_company=<?= htmlspecialchars($theSellRecipt->id_company); ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>

<?php include '../template/footer.php'; ?>
