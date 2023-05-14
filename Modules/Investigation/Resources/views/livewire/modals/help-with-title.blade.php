<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalContent" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Ayuda para crear Títulos
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         <p>Ayudanos brindando información de lo que deseas para tu tesis</p>
                            <div class="form-group">
                                <label class="form-label" for="name" title="temas relacionados a tu carrera y lo que quieres investigar">Palabras Clave*</label>
                                <input wire:model="keywords" type="text" class="form-control" id="keywords" placeholder="palabras relacionadas a tu investigación y carrera">
                                @error('keywords') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="name">Respuesta</label>
                                <textarea rows="8" class="form-control" wire:model='resultado' name="text1" id="text1">{{ $resultado }}</textarea>
                                @error('resultado') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  onclick="helpwithtitle()" >Procesar</button>
                                <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('labels.Close') }}</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('inve-helpwithtitle-open-modal', event => {
            $('#exampleModalContent').modal('show')
        });

        window.addEventListener('aca-content-delete', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        })
    </script>
</div>
