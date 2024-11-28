<?php include '../template/header.php'; ?>
<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Reporte de compras por periodo</h2>
        <form method="POST">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="empresa" class="form-label">Seleccione la empresa</label>
                    <select name="id_company" id="empresa" class="form-select" required>
                        <option value="">-- Seleccione una empresa --</option>
                        <?php
                        if (!empty($companies)) {
                            foreach ($companies as $company) {
                                echo '<option value="' . htmlspecialchars($company['id_company']) . '">' . htmlspecialchars($company['company_name']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No hay empresas disponibles</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Desde el:</label>
                    <input type="date" id="start_date" class="form-control" name="start_date" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Hasta el:</label>
                    <input type="date" id="end_date" class="form-control" name="end_date" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Generar Reporte</button>
        </form>

        <?php if (!empty($reports)) : ?>
            <div class="table-responsive mt-4">
                <table id="genericTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Número</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reports as $report) : ?>
                            <tr>
                                <td><?= htmlspecialchars($report['id_buy_recipt']) ?></td>
                                <td><?= htmlspecialchars($report['buy_type']) ?></td>
                                <td><?= htmlspecialchars($report['buy_number']) ?></td>
                                <td><?= htmlspecialchars($report['buy_date']) ?></td>
                                <td><?= number_format(htmlspecialchars($report['buy_amount']), 2) ?></td>
                                <td><?= htmlspecialchars($report['buy_provider']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                            <td colspan="2"><?= number_format($totalAmount, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../template/footer.php'; ?>
<script>
    $(document).ready(function () {
        $('#genericTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json"
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    title: 'Reporte de compras',
                    footer: true,
                    customize: function (xlsx) {
                        let sheet = xlsx.xl.worksheets['sheet1.xml'];
                        let lastRow = $('row', sheet).last();
                        let totalText = $('tfoot tr td:eq(0)').text();
                        let totalAmount = $('tfoot tr td:eq(1)').text();

                        lastRow.after(
                            `<row r="${parseInt(lastRow.attr('r')) + 1}">
                                <c t="inlineStr" r="A${parseInt(lastRow.attr('r')) + 1}">
                                    <is><t>${totalText}</t></is>
                                </c>
                                <c t="inlineStr" r="B${parseInt(lastRow.attr('r')) + 1}">
                                    <is><t>${totalAmount}</t></is>
                                </c>
                            </row>`
                        );
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'Exportar a CSV',
                    title: 'Reporte de compras',
                    footer: true 
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    title: 'Reporte de compras',
                    footer: true,
                    customize: function (doc) {
                        let totalText = $('tfoot tr td:eq(0)').text();
                        let totalAmount = $('tfoot tr td:eq(1)').text();

                        doc.content.push({
                            text: `${totalText}: ${totalAmount}`,
                            style: 'tableFooter'
                        });
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Reporte de compras',
                    footer: true
                }
            ]
        });
    });
</script>
