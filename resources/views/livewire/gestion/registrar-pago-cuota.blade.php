<div>
    <!-- Modal -->
    <div class="modal fade @if($showModal) show @endif" id="pagoModal" style="@if(!$showModal) display: none; @endif" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Pago en Cuotas</h5>
                    <button type="button" class="btn-close" wire:click="$emit('closeModal')"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form wire:submit.prevent="savePayment">
                        <div class="mb-3">
                            <label for="mes" class="form-label">Mes</label>
                            <input type="number" id="mes" wire:model="mes" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" id="anio" wire:model="anio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="montoPago" class="form-label">Monto a Pagar</label>
                            <input type="number" step="0.01" min="0.00" id="montoPago" wire:model="montoPago" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="medioPago" class="form-label">Medio de Pago</label>
                            <select id="medioPago" wire:model="medioPago" class="form-control">
                                @foreach($mediosPago as $medio)
                                    <option value="{{ $medio->idMedioPago }}">{{ $medio->MedioPago_desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar Pago</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('paymentRegistered', event => {
            // Cerrar el modal al registrar un pago
            document.querySelector('.modal').classList.remove('show');
        });
    </script>
</div>
