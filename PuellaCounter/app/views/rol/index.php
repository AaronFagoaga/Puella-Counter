<?php
include '../template/header.php';
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de Roles</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?action=create" class="btn btn-success">Crear Rol</a>
        </div>
        <div class="table-responsive">
            <table id="genericTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Rol</th>
                        <th scope="col">Descripción del Rol</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?= htmlspecialchars($role['id_rol']); ?></td>
                            <td><?= htmlspecialchars($role['rol_name']); ?></td>
                            <td><?= htmlspecialchars($role['rol_info']); ?></td>
                            <td class="text-center">
                                <a href="?action=edit&id=<?= $role['id_rol'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?action=delete&id=<?= $role['id_rol'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>
