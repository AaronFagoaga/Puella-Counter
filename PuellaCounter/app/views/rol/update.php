<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Actualizar Rol</h2>
        <form action="" method="POST" name="frmUpdate" onsubmit="return validateForm()" novalidate>
            <div class="mb-3">
                <label for="rol_name" class="form-label">Nombre del Rol:</label>
                <input 
                    type="text" 
                    id="rol_name" 
                    name="rol_name" 
                    value="<?= htmlspecialchars($roles->rol_name) ?>" 
                    class="form-control" 
                    required>
            </div>
            <div class="mb-3">
                <label for="rol_info" class="form-label">Descripción del Rol:</label>
                <textarea 
                    id="rol_info" 
                    name="rol_info" 
                    class="form-control" 
                    rows="4" 
                    required><?= htmlspecialchars($roles->rol_info) ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
                <a href="?" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    function validateForm() {
        const rolName = document.getElementById('rol_name').value.trim();
        const rolInfo = document.getElementById('rol_info').value.trim();

        if (rolName === '') {
            alert('El nombre del rol no puede estar vacío.');
            return false;
        }

        if (rolInfo === '') {
            alert('La descripción del rol no puede estar vacía.');
            return false;
        }

        return true;
    }
</script>

<?php include '../template/footer.php'; ?>
