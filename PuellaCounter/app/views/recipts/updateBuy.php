<?php include '../template/header.php'; ?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Editar Comprobante</h2>

        <form action="" method="POST" name="frmUpdate">
            <input type="hidden" name="id_company" value="<?= htmlspecialchars( $theBuyRecipt->id_company); ?>">

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
                <input type="date" class="form-control" name="date" id="date" value="<?= htmlspecialchars($theBuyRecipt->buy_date); ?>" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Monto</label>
                <input type="number" class="form-control" name="amount" id="amount" value="<?= htmlspecialchars($theBuyRecipt->buy_amount); ?>" required>
            </div>

            <div class="mb-3">
                <label for="provider" class="form-label">Proveedor</label>
                <input type="text" class="form-control" name="provider" id="provider" value="<?= htmlspecialchars($theBuyRecipt->buy_provider); ?>" required>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Archivo</label>
                <input type="file" class="form-control" name="file" id="file">
                <?php if (!empty($theBuyRecipt->buy_file)): ?>
                    <p>Archivo actual: <a href="../../uploads/<?= htmlspecialchars($theBuyRecipt->buy_file); ?>" target="_blank"><?= htmlspecialchars($theBuyRecipt->buy_file); ?></a></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

<?php include '../template/footer.php'; ?>