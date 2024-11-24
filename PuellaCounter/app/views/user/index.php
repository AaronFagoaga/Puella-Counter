<?php
include '../template/header.php';
//require_once(dirname(__FILE__) . "/../../../core/authRol.php");
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de usuarios</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?action=create" class="btn btn-success">Crear usuario</a>
        </div>
        <div class="table-responsive">
            <table id="genericTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">UserName</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id_user']); ?></td>
                            <td><?= htmlspecialchars($user['user_name']); ?></td>
                            <td><?= htmlspecialchars($user['user_email']); ?></td>
                            <td><?= htmlspecialchars($user['user_login_name']); ?></td>
                            <td><?= htmlspecialchars($user['rol_name']); ?></td>
                            <td>
                                <span id="password-<?= $user['id_user'] ?>" class="password-value">********</span>
                                <button type="button" class="btn password-toggle" onclick="togglePassword(<?= $user['id_user'] ?>)">
                                    <i id="password-icon-<?= $user['id_user'] ?>" class="fa fa-eye"></i>
                                </button>
                                <input type="hidden" id="password-raw-<?= $user['id_user'] ?>" value="<?= htmlspecialchars($user['user_password']); ?>">
                            </td>
                            <td class="text-center">
                                <a href="?action=edit&id=<?= $user['id_user'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?action=delete&id=<?= $user['id_user'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function togglePassword(userId) {
        var passwordElement = document.getElementById('password-' + userId);
        var passwordInput = document.getElementById('password-raw-' + userId);
        var button = document.getElementById('password-icon-' + userId);

        if (passwordElement.textContent === '********') {
            passwordElement.textContent = passwordInput.value;
            button.classList.remove('fa-eye');
            button.classList.add('fa-eye-slash');
        } else {
            passwordElement.textContent = '********';
            button.classList.remove('fa-eye-slash');
            button.classList.add('fa-eye');
        }
    }
</script>

<?php include '../template/footer.php'; ?>
