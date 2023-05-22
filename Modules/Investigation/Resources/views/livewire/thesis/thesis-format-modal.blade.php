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
                <button wire:click="addTitlePart" type="button" class="btn btn-primary btn-sm mb-4"><i class="fa fa-plus mr-1"></i>Titulo</button>
                <ul class="list-point-none">
                    @if(count($parts) > 0)
                        @foreach($parts as $k => $part)
                            <li>
                                <div class="btn-group mr-3">
                                    <button wire:click="" type="button" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <button wire:click="" type="button" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button onclick="" type="button" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </div>
                                <a href="#" id="formattitle{{ $k }}" data-type="text" data-pk="{{ $k }}" data-title="Escriba Titulo"></a>
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
        $('#formattitle'+index).editable();
    });
</script>
</div>