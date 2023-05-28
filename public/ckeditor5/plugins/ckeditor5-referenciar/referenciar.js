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
                openModalReference(editor);
            } );

            return button;
        } );
        
    }
}

function openModalReference(editor){
    const form = `
    <div class="ly-ck-dialog ly-ck-dialog-800">
        <div class="ly-ck-dialog-header">
            <div><strong>Referenciar</strong></div>
            <div id="ly-ck-btn-dialog-close-icon" class="ly-ck-dialog-close-icon">&#10005;</div>
        </div>
        <form id="ly-ck-form-referenciar" class="ly-ck-dialog-form">
            <div class="ly-ck-dialog-group-control">
                <label class="ly-ck-dialog-label" for="input-doi">DOI:</label>
                <input class="ly-ck-dialog-input" type="text" id="input-doi" name="input-doi" placeholder="Escriba aquí...">
                <spam id="input-doi-error"></span>
            </div> 
            <div class="ly-ck-dialog-group-control mb-2">
                <label class="ly-ck-dialog-label" for="select-normativa">Normativa:</label>
                <select class="ly-ck-dialog-select" id="select-normativa" name="select-normativa">
                    <option value="apa">APA</option>
                    <option value="iso690">ISO</option>
                    <option value="vancouver">Vancouver</option>
                </select>
            </div>
            <div id="ly-ck-dialog-references-result" class="ly-ck-dialog-group-control mb-2">
                
            </div>
            <div class="ly-ck-dialog-buttons">
                <button id="ckgetBtnReference" class="ly-ck-dialog-button mr-2" type="submit"><i class="fas fa-search"></i>Buscar</button>
                <button id="ckcloseBtnReference" class="ly-ck-dialog-button" type="button"><i class="fas fa-times"></i>Cancelar</button>
            </div>
        </form>
    </div>`;

    var modalReference = document.createElement("div");
    modalReference.className = "div-form-center";
    modalReference.innerHTML = form;
    document.body.appendChild(modalReference);

    const ckcloseBtnReferenceIcon = document.querySelector( '#ly-ck-btn-dialog-close-icon' );
    const ckcloseBtnReference = document.querySelector( '#ckcloseBtnReference' );

    ckcloseBtnReference.addEventListener( 'click', () => {
        modalReference.remove();
    });

    ckcloseBtnReferenceIcon.addEventListener( 'click', () => {
        modalReference.remove();
    });

    const formSubmit = document.getElementById('ly-ck-form-referenciar');
    const xhr = new XMLHttpRequest();

    formSubmit.addEventListener('submit', (event) => {
        event.preventDefault();

        const input = document.getElementById('input-doi');
        const error = document.getElementById('input-doi-error');

        if (input.value.length === 0) {
            error.textContent = 'Este campo no puede estar vacío';
        } else {
            const spinner = `<div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>`;

            const content = document.getElementById('ly-ck-dialog-references-result');
            content.innerHTML = spinner;

            const parameters = editor.config.get('references') || 'empty';
            const formData = new FormData(formSubmit);
            
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    content.innerHTML = `<div class="alert alert-primary" role="alert">
                                            ${JSON.parse(xhr.responseText).cita}
                                        </div>`;
                }
            };

            xhr.open('POST', parameters.url, true);

            // Definir token de seguridad antes de establecer los headers
            const token = parameters.headers['X-CSRF-TOKEN'];
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);

            const formDataJson = {};
            for (const [key, value] of formData.entries()) {
                formDataJson[key] = value;
            }
            
            xhr.send(JSON.stringify(formDataJson));
        }
    });

    
}

