<div>
    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormatStudent" tabindex="-1" aria-labelledby="modalFormatStudentLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormatStudentLabel">Crear Mi Formato</h5>
                <button id="btn-add-format-title" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label" for="xnormative_thesis">{{ __('labels.Normative') }}/
                                {{ __('labels.Style') }} </label>
                            *</label>
                            <select wire:model.defer="xnormative_thesis" type="select" class="form-control"
                                id="xnormative_thesis">
                                <option value="">Seleccionar</option>
                                @foreach ($xenum_normatives as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('xnormative_thesis')
                                <span class="invalid-feedback-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label class="form-label" for="xtype_thesis">{{ __('labels.Type Thesis') }}
                                *</label>
                            <select wire:model.defer="xtype_thesis" type="select" class="form-control"
                                id="xtype_thesis">
                                <option value="">Seleccionar</option>
                                @foreach ($xenum_types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('xtype_thesis')
                                <span class="invalid-feedback-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="xname">{{ __('labels.Format name') }} *</label>
                            <input wire:model="xname" type="text" class="form-control" id="xname">
                            @error('xname')
                                <span class="invalid-feedback-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                @if(!$this->xformat_id)
                    <button onclick="saveNewFormatStudentJS()" type="button" class="btn btn-primary btn-sm mb-4"><i class="fa fa-check mr-1"></i>Crear Formato</button>
                @endif
                @if($this->xformat_id)
                    <button onclick="addTitlePartNewJS()" type="button" class="btn btn-primary btn-sm mb-4"><i class="fa fa-plus mr-1"></i>Titulo</button>
                @endif
                <ul class="list-point-none">
                    @if(count($xparts) > 0)
                        @foreach($xparts as $k => $part)
                            <li>
                                <div class="btn-group mr-3">
                                    <button wire:click="" type="button" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <button onclick="" type="button" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </div>
                                <a href="#" id="formattitle{{ $k }}" data-type="text" data-pk="{{ $part['id'] }}" data-title="Escriba Titulo">{{ $part['description'] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $.fn.editable.defaults.mode = 'inline';
    window.addEventListener('inve-thesis-student-format-add', event => {
        let index = event.detail.keytitle;
        $('#formattitle'+index).editable({
            url: function(params) {
                var d = new $.Deferred();
                if(params.value === 'abc') {
                    return d.reject('error message');
                } else {
                    @this.set('xdescription', params.value);
                    @this.set('xnumber_order', index + 1);
                    @this.savePartEstudentNew();
                }
            }
        });
    });
    window.addEventListener('thesis-format-create-estudent', event => {
        alert('Se registro correctamente.')
    });
    function saveNewFormatStudentJS(){
        let selectElement = document.getElementById('school_id');
        let selectedValue = selectElement.value;

        if (selectedValue === '') {
            alert('Por favor, selecciona una Escuela.');
            return;
        } 

        @this.set('xschool_id', selectedValue);
        @this.saveFormatStudentNew();
    }
    function addTitlePartNewJS(){
        @this.addTitlePartNew();
    }
</script>
</div>