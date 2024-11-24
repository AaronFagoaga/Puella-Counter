<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Rol</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="rolId" class="form-label">ID:</label>
                <input type="text" id="rolId" name="rolId" value="<?= htmlspecialchars($roles->id_rol) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="rolName" class="form-label">Nombre del Rol:</label>
                <input type="text" id="rolName" name="rolName" value="<?= htmlspecialchars($roles->rol_name) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="rol_info" class="form-label">Descripción del Rol:</label>
                <textarea id="rol_info" name="rol_info" class="form-control" rows="4" disabled><?= htmlspecialchars($roles->rol_info) ?></textarea>
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