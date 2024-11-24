<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Empresa</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="companyId" class="form-label">ID:</label>
                <input type="text" id="companyId" name="companyId" value="<?= htmlspecialchars($companies->id_company) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="companyName" class="form-label">Nombre de la Empresa:</label>
                <input type="text" id="companyName" name="companyName" value="<?= htmlspecialchars($companies->company_name) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="companyAddress" class="form-label">Dirección:</label>
                <textarea id="companyAddress" name="companyAddress" class="form-control" rows="4" disabled><?= htmlspecialchars($companies->company_address) ?></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?" class="btn btn-secondary">Cancelar</a>
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
