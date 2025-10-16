<!-- MODAL DE PAGO -->
<div class="modal fade" id="popupPago" tabindex="-1" aria-labelledby="popupPagoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="popupPagoLabel">Método de Pago</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
<form id="formPago" method="POST" action="{{ route('pedido.realizar') }}">
          @csrf
          <input type="hidden" name="metodo_pago" value="Tarjeta">

          <div class="mb-3">
            <label class="form-label">Número de Tarjeta</label>
            <input type="text" class="form-control" name="numero" id="numero" placeholder="1234567812345678" required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Fecha de Caducidad</label>
              <input type="text" class="form-control" name="caducidad" id="caducidad" placeholder="MM/AA" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">CVV</label>
              <input type="text" class="form-control" name="cvv" id="cvv" placeholder="123" required>
            </div>
          </div>

          <div class="alert alert-info text-center">
            Se enviará confirmación a tu correo.
          </div>

          <div class="modal-footer d-flex justify-content-end">
            <button type="button" class="btn btn-primary" onclick="if (validarFormularioPago()) abrirConfirmacionDesdePago();">
              Finalizar Compra
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL DE CONFIRMACIÓN -->
<div class="modal fade" id="confirmarPedidoModal" tabindex="-1" aria-labelledby="confirmarPedidoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content popup-content">
      <div class="modal-header">
        <h2 class="modal-title" id="confirmarPedidoLabel">Confirmar pedido</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p>¿Estás seguro de que deseas realizar la compra?</p>
        <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="document.getElementById('formPago').submit();">
          Sí, continuar
        </button>
      </div>
    </div>
  </div>
</div>
