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
            <div style="max-height: 300px;overflow-x: none;overflow-y: auto;">
                <div class="ly-ck-dialog-group-control">
                    <label class="ly-ck-dialog-label" for="input-doi">DOI*:</label>
                    <input class="ly-ck-dialog-input" type="text" id="input-doi" name="input-doi" placeholder="Escriba aquí...">
                    <spam id="input-doi-error"></span>
                </div> 
                <div class="ly-ck-dialog-group-control">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="input-type" id="inlineRadioArticle" value="article" checked>
                        <label class="form-check-label" for="inlineRadioArticle">Articulo</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="input-type" id="inlineRadioBook" value="book">
                        <label class="form-check-label" for="inlineRadioBook">Libro</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="input-type" id="inlineRadioThesis" value="thesis">
                        <label class="form-check-label" for="inlineRadioThesis">Tesis</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="input-type" id="inlineRadioDocument" value="document">
                        <label class="form-check-label" for="inlineRadioDocument">Documento</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="input-type" id="inlineRadioPage" value="page">
                        <label class="form-check-label" for="inlineRadioPage">Pagina</label>
                    </div>
                </div>
                <div class="ly-ck-dialog-group-control mb-2">
                    <label class="ly-ck-dialog-label" for="select-normativa">Normativa:</label>
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
                <div class="collapse width" id="collapseWidthExample1" >
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-doi">Autor/es:</label>
                        <textarea class="ly-ck-dialog-input" rows="4" id="input-autor" name="input-autor" placeholder="Escriba aquí, autor1| autor2| autor3| etc|"></textarea>
                        <spam id="input-autor-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-titulo">Título:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-titulo" name="input-titulo" placeholder="Escriba aquí...">
                        <spam id="input-titulo-error"></span>
                    </div> 
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-grado">Grado Académico:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-grado" name="input-grado" placeholder="Escriba aquí...">
                        <spam id="input-grado-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-universidad">Universidad:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-universidad" name="input-universidad" placeholder="Escriba aquí...">
                        <spam id="input-universidad-error"></span>
                    </div> 
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-pais">País:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-pais" name="input-pais" placeholder="Escriba aquí...">
                        <spam id="input-pais-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-institucion">Institución o entidad:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-institucion" name="input-institucion" placeholder="Escriba aquí...">
                        <spam id="input-institucion-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-issn">ISSN:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-issn" name="input-issn" placeholder="Escriba aquí...">
                        <spam id="input-issn-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-isbn">ISBN:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-isbn" name="input-isbn" placeholder="Escriba aquí...">
                        <spam id="input-isbn-error"></span>
                    </div> 
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-volumen">Volumen:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-volumen" name="input-volumen" placeholder="Escriba aquí...">
                        <spam id="input-volumen-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-editor">Editor:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-editor" name="input-editor" placeholder="Escriba aquí...">
                        <spam id="input-editor-error"></span>
                    </div>
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-editorial">Editorial:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-editorial" name="input-editorial" placeholder="Escriba aquí...">
                        <spam id="input-editorial-error"></span>
                    </div> 
                    <div class="ly-ck-dialog-group-control">
                        <label class="ly-ck-dialog-label" for="input-enlace">Enlace URL:</label>
                        <input class="ly-ck-dialog-input" type="text" id="input-enlace" name="input-enlace" placeholder="Escriba aquí...">
                        <spam id="input-enlace-error"></span>
                    </div> 
                    
                </div>
                <div id="ly-ck-dialog-references-result" class="ly-ck-dialog-group-control mb-2">
   
                </div>
            </div>
            <div class="ly-ck-dialog-buttons">
                <button class="ly-ck-dialog-button btn-info mr-2" type="button" data-toggle="collapse" data-target="#collapseWidthExample1" aria-expanded="false" aria-controls="collapseWidthExample1">
                    Configuración Avanzada
                </button>
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
            alert('Algunos campos son necesarios')
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

