<?php
include '../template/header.php';
//require_once(dirname(__FILE__) . "/../../../core/authRol.php");
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Creación de usuario</h2>
        <form action="" method="POST" name="frmCreate" novalidate>
            <div class="mb-3">
                <label for="user_name" class="form-label">Nombre:</label>
                <input type="text" id="user_name" name="user_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label">Correo:</label>
                <input type="email" id="user_email" name="user_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="user_login_name" class="form-label">Nombre de usuario:</label>
                <input type="text" id="user_login_name" name="user_login_name" class="form-control" required pattern="^\S+$" title="No se permiten espacios">
            </div>
            <div class="mb-3">
                <label for="user_password" class="form-label">Contraseña:</label>
                <input type="password" id="user_password" name="user_password" class="form-control" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i id="password-icon" class="fa fa-eye"></i>
                </button>
            </div>
            <div class="mb-3">
                <label for="id_rol" class="form-label">Rol:</label>
                <select id="id_rol" name="id_rol" class="form-select" required>
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id_rol']; ?>"><?php echo $role['rol_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('user_password');
        var icon = document.getElementById('password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<?php include '../template/footer.php'; ?>