<?php
include '../template/header.php';
    $id_company = isset($_GET['id_company']) ? $_GET['id_company'] : null;
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de Comprobantes</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?action=create&id_company=<?= $id_company ?>&type=buy" class="btn btn-success">Crear Comprobante</a>
        </div>

        <div sclass="mb-3">
        <button class="btn btn-primary" onclick="mostrarComprobantes('venta', '<?= $id_company ?>')">Comprobantes de Venta</button>
        <button class="btn btn-secondary" onclick="mostrarComprobantes('compra', '<?= $id_company ?>')">Comprobantes de Compra</button>
        <button class="btn btn-info" onclick="mostrarComprobantes('todos', '<?= $id_company ?>')">Mostrar Todos</button>
        </div>

        <div class="table-responsive">
            <h3 id="ventaTitle" class="d-none">Comprobantes de venta</h3>
            <table id="ventaTable" class="table table-striped table-bordered d-none">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Archivo</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sellRecipts as $sellRecipt): ?>
                        <tr>
                            <td><?= htmlspecialchars($sellRecipt['id_sell_recipt']); ?></td>
                            <td><?= htmlspecialchars($sellRecipt['sell_type']); ?></td>
                            <td><?= htmlspecialchars($sellRecipt['sell_number']); ?></td>
                            <td><?= htmlspecialchars($sellRecipt['sell_date']); ?></td>
                            <td><?= htmlspecialchars($sellRecipt['sell_amount']); ?></td>
                            <td><?= htmlspecialchars($sellRecipt['sell_client']); ?></td>
                            <td>
                                <?php if (!empty($sellRecipt['sell_file'])): ?>
                                    <a href="./recipts.php?action=downloadFile&type=sell&id=<?= $sellRecipt['id_sell_recipt'] ?>&id_company=<?= $id_company ?>" 
                                    class="btn btn-info btn-sm" target="_blank">Ver Archivo</a>
                                <?php else: ?>
                                    <span class="text-danger">Archivo no existente</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                            <a href="?action=editSell&id=<?= $sellRecipt['id_sell_recipt'] ?>&id_company=<?= $sellRecipt['id_company'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?action=deleteSell&id=<?= $sellRecipt['id_sell_recipt'] ?>&id_company=<?= $sellRecipt['id_company'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3 id="compraTitle" class="d-none">Comprobantes de compra</h3>
            <table id="compraTable" class="table table-striped table-bordered d-none">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Archivo</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buyRecipts as $buyRecipt): ?>
                        <tr>
                            <td><?= htmlspecialchars($buyRecipt['id_buy_recipt']); ?></td>
                            <td><?= htmlspecialchars($buyRecipt['buy_type']); ?></td>
                            <td><?= htmlspecialchars($buyRecipt['buy_number']); ?></td>
                            <td><?= htmlspecialchars($buyRecipt['buy_date']); ?></td>
                            <td><?= htmlspecialchars($buyRecipt['buy_amount']); ?></td>
                            <td><?= htmlspecialchars($buyRecipt['buy_provider']); ?></td>
                            <td>
                                <?php if (!empty($buyRecipt['buy_file'])): ?>
                                    <a href="?action=downloadFile&type=buy&id=<?= $buyRecipt['id_buy_recipt'] ?>&id_company=<?= $id_company ?>" 
                                    class="btn btn-info btn-sm" target="_blank">Ver Archivo</a>
                                <?php else: ?>
                                    <span class="text-danger">Archivo no existente</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="?action=editBuy&id=<?= $buyRecipt['id_buy_recipt'] ?>&id_company=<?= $buyRecipt['id_company'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?action=deleteBuy&id=<?= $buyRecipt['id_buy_recipt'] ?>&id_company=<?= $buyRecipt['id_company'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>

<script>
    function mostrarComprobantes(tipo, idCompany) {
        console.log("ID de empresa:", idCompany);

        document.getElementById('ventaTable').classList.add('d-none');
        document.getElementById('compraTable').classList.add('d-none');
        document.getElementById('ventaTitle').classList.add('d-none');
        document.getElementById('compraTitle').classList.add('d-none');
        
        if (tipo === 'venta') {
            document.getElementById('ventaTable').classList.remove('d-none');
            document.getElementById('ventaTitle').classList.remove('d-none');
        } else if (tipo === 'compra') {
            document.getElementById('compraTable').classList.remove('d-none');
            document.getElementById('compraTitle').classList.remove('d-none');
        } else {
            document.getElementById('ventaTable').classList.remove('d-none');
            document.getElementById('compraTable').classList.remove('d-none');
            document.getElementById('ventaTitle').classList.remove('d-none');
            document.getElementById('compraTitle').classList.remove('d-none');
        }
    }
</script>
