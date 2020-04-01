<div class="modal fade" id="exportForm" tabindex="-1" role="dialog" aria-labelledby="exportForm" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Filtración de Reporte</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" id="frmSearch" action="{{ route('report.index') }}" method="GET">
        <div class="modal-body mx-3">
          <div class="md-form mb-5">
            <div class="input-group">
              <i class="far fa-calendar-alt" style="margin: 6px"></i>
              <input type="date" id="firstCreationDate" name="firstCreationDate" data-date-format="YYYY-MM-DD" class="form-control" required>
            </div>
            <label data-error="wrong" data-success="right" for="firstCreationDate">Primera fecha de creación</label>
          </div>

          <div class="md-form mb-5">
            <div class="input-group">
              <i class="far fa-calendar-alt" style="margin: 6px"></i>
              <input type="date" id="finalCreationDate" name="finalCreationDate" data-date-format="YYYY-MM-DD" class="form-control" required>
            </div>
            <label data-error="wrong" data-success="right" for="finalCreationDate">Ultima fecha de creación</label>
          </div>

          <div class="md-form mb-5">
            <div class="input-group">
              <i class="fas fa-tag input-group-prefix grey-text" style="margin: 6px"></i>
              <select name="state" class="form-control" id="state" required>
                <option value="all" selected>Selecciona una opción: </option>
                <option value="paid">Pago</option>
                <option value="pending">Pendiente</option>
                <option value="unpaid">No pago</option>
                <option value="overdue">Vencido</option>
                <option value="annuled">Anulado</option>
              </select>
            </div>
            <label data-error="wrong" data-success="right" for="state">Estado de Factura</label>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-success" type="submit">Consultar <i class="fas fa-paper-plane-o "></i></button>
        </div>
    </div>
    </form>
  </div>
</div>