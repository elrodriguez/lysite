import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';
import addComment from './theme/icons/add-comment.svg';
import removeComment from './theme/icons/remove-comment.svg';

const confComment = {
    element: 'lyComment'
}
export default class comments extends Plugin {

    init() {
        const editor = this.editor;
        // The button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add('comments', () => {
            // The button will be an instance of ButtonView.
            const button = new ButtonView();

            button.set( {
                label: 'Comentarios',
                icon:addComment,
                //withText: true,
                tooltip: true,
                //isEnabled: false // Deshabilitamos el botón por defecto
            } );

            button.on( 'execute', () => {
                this._createDialog();
            } );

            return button;
        });
        
        editor.model.schema.register(confComment.element, {
            isObject: true,
            allowWhere: '$block',
            allowContentOf: '$root',
        });

    }
    
    _createDialog() { 
        var ckFormComment = document.createElement("div");
        ckFormComment.id = "div_comments";
        ckFormComment.className = "div-form-comments";
        var user_name = localStorage.getItem("user_name");
        var divComment = `<div class="card">
                            <div class="card-body">
                                <div>
                                    <textarea id="form-comment-textarea" class="form-control form-control-sm" rows="2"></textarea>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-secondary btn-lg dialogClose"><i class="fas fa-times"></i></button>
                                        <button id="commentButtonSave" type="button" class="btn btn-success btn-lg"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                              </div>
                        </div>`;
                        ckFormComment.innerHTML = divComment;
        document.body.appendChild(ckFormComment);

        var buttons = document.getElementsByClassName("dialogClose");

        // Recorremos todos los botones y les agregamos el evento onclick
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].onclick = function() {
                ckFormComment.remove();
            };
        }

        var buttonSave = document.getElementById("commentButtonSave");

        buttonSave.onclick = function() {
            const selection = editor.model.document.selection;
            let selectedText = '';
            if (selection.isCollapsed) {
                alert('No hay contenido seleccionado.');
            } else {

                const textarea = document.getElementById("form-comment-textarea"); // Obtener el elemento textarea por su ID
                const contenido = textarea.value.trim(); // Obtener el valor del textarea y eliminar espacios en blanco al inicio y final

                if (contenido.length > 0) {
               
                    const selectedContent = editor.model.getSelectedContent(selection);

                    const selectedArray = selectedContent._children._nodes;
                    
                    for (let i = 0; i < selectedArray.length; i++) {
                        selectedText += selectedArray[i]._data;
                    }
                    const randomNum = Math.random().toString();
                    editor.conversion.for('downcast').elementToElement({
                        model: confComment.element,
                        view: ( modelElement, { writer } ) => {
                            return writer.createContainerElement(
                                'span', 
                                    { 
                                        id: 'lyc-' + randomNum,
                                        style: 'background: rgba(229,102,134,.35);border-bottom: 3px solid rgba(174,30,66,.35);border-top: 3px solid rgba(174,30,66,.35);text-decoration: line-through;text-decoration-color: rgba(87,15,33,.5);text-decoration-thickness: 3px;' 
                                    }
                            );
                        }
                    });

                    editor.model.change( writer => {
                        const commentElement =  writer.createElement(confComment.element, { id:'122'} )
                        writer.insertText(selectedText, commentElement)
                        editor.model.insertContent(commentElement);
                    } );

                    const parameters = editor.config.get('comments.ajax') || 'empty';

                    if(parameters != 'empty'){
                       __runAjax(parameters, randomNum, textarea.value, selectedText);
                    }
                    _createSidebarComments(textarea.value,randomNum);
                    console.log(editor.getData())
                } else {
                    alert("El textarea está vacío");
                }

                selectedText = '';
                ckFormComment.remove();
            }
        };
    }


      
    
}

function     __runAjax(parameters, selecction_id, comment_text,selectedText) {
    // Crear objeto XMLHttpRequest
    const xhr = new XMLHttpRequest();
  
    // Si method es POST
    if (parameters.method === 'POST') {
        xhr.open('POST', parameters.url);
        parameters.data.commentary = comment_text;
        parameters.data.selecction_id = selecction_id;
        parameters.data.selecction_text = selectedText;
        // Setear header y enviar datos
        var token = parameters.headers['X-CSRF-TOKEN'];
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        xhr.send(JSON.stringify(parameters.data));
    }
  
    // Si method es GET
    else if (parameters.method === 'GET') {
        xhr.open('GET', parameters.url);
        xhr.send();
    }
  
    // Si method no es ni POST ni GET
    else {
        console.error('Envíe "POST" o "GET" para ejecutar la petición.');
        return;
    }
  
    // Manejar respuesta
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Manejar respuesta exitosa
            console.log('Petición exitosa:', xhr.response);
            updateContent();
        } else {
            // Manejar error
            console.error('Error en la petición:', xhr.status, xhr.statusText);
        }
    };
}
function _createSidebarComments(text,id) { 
    var cksidebarComments = document.createElement("div");
    cksidebarComments.id = 'lyc-' + id + '-item';
    cksidebarComments.className = "ly-sidebar-comment";

    const svg = document.createElement('div');
    svg.innerHTML = removeComment;

    var sidebar = `<div class="ly-sidebar-item">
                        <div class="ly-annotation-wrapper" tabindex="-1">
                            <span class="ly-remove-comment" id="ly-btn-remove-${id}">
                                ${svg.innerHTML}
                            </span>
                            <div class="" tabindex="-1">
                                <div class="ck-thread__container">
                                    ${text}
                                </div>
                            </div>
                        </div>
                    </div>`;

    cksidebarComments.innerHTML = sidebar;
    
    document.body.appendChild(cksidebarComments);

    const button = document.getElementById("ly-btn-remove-"+id);
    const comment = document.getElementById('lyc-' + id + '-item');
    button.onclick = function() {
        comment.remove();
    };
}

