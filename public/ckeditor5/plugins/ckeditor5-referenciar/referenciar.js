import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';
import iconReferenciar from './icons/referenciar.svg';

export default class referenciar extends Plugin {
    init() {
        const editor = this.editor;
        // The button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add('referenciar', () => {
            // The button will be an instance of ButtonView.
            const button = new ButtonView();

            button.set( {
                label: 'Referenciar',
                icon: iconReferenciar,
                tooltip: true
            } );

            button.on( 'execute', () => {
                openModalReference();
            } );

            return button;
        } );
        
    }
}

function openModalReference(){
    const form = `
    <div class="ly-ck-dialog ly-ck-dialog-800">
        <div class="ly-ck-dialog-header">
            <div><strong>Referenciar</strong></div>
            <div class="ly-ck-dialog-close-icon">&#10005;</div>
        </div>
        <form class="ly-ck-dialog-form">
            <div class="ly-ck-dialog-group-control">
                <label class="ly-ck-dialog-label" for="input-texto">DOI:</label>
                <input class="ly-ck-dialog-input" type="text" id="input-texto" name="input-texto" placeholder="Escriba aquí...">
            </div> 
            <div class="ly-ck-dialog-group-control mb-2">
                <label class="ly-ck-dialog-label" for="select-opcion">Normativa:</label>
                <select class="ly-ck-dialog-select" id="select-normativa" name="select-normativa">
                    <option value="apa">APA</option>
                    <option value="mla">MLA</option>
                    <option value="harvard">Harvard</option>
                    <option value="iso690">ISO690</option>
                    <option value="ieee">IEEE</option>
                    <option value="chicago">Chicago</option>
                    <option value="vancouver">Vancouver</option>
                </select>
            </div>
            <div class="ly-ck-dialog-buttons">
                <button class="ly-ck-dialog-button mr-2" type="submit"><i class="fas fa-search"></i>Buscar</button>
                <button id="ckcloseBtnReference" class="ly-ck-dialog-button" type="button"><i class="fas fa-times"></i>Cancelar</button>
            </div>
        </form>
    </div>`;

    var modalReference = document.createElement("div");
    modalReference.className = "div-form-center";
    modalReference.innerHTML = form;
    document.body.appendChild(modalReference);

    const ckcloseBtnReference = document.querySelector( '#ckcloseBtnReference' );

    ckcloseBtnReference.addEventListener( 'click', () => {
        modalReference.remove();
    });
}