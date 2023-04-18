import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';
import addComment from './theme/icons/add-comment.svg';

//import '../theme/link.css';
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
        ckFormComment.className = "div_comments";
        var user_name = localStorage.getItem("user_name");
        var divComment = `<div class="card">
                            <div class="card-body">
                                <div>
                                    <textarea class="form-control form-control-sm" rows="2"></textarea>
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
            if (selection.isCollapsed) {
                console.log('No hay contenido seleccionado.');
            } else {
                const selectedContent = editor.model.getSelectedContent(selection);

                const selectedArray = selectedContent._children._nodes;
                let selectedText = '';
                for (let i = 0; i < selectedArray.length; i++) {
                    selectedText += selectedArray[i]._data;
                }
                const randomNum = Math.random().toString();
                editor.conversion.for('downcast').elementToElement({
                    model: confComment.element,
                    view: ( modelElement, { writer } ) => {
                        return writer.createContainerElement(
                            'p', 
                                { 
                                    id: 'lyc-' + randomNum,
                                    class: 'ly-suggestion-marker-deletion' 
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
                    //this.__runAjax(parameters,);
                }
                _createSidebarComments();
                selectedText = '';
            }
        };
    }

    __runAjax(parameters, comment_id, comment_text) {
        // Crear objeto XMLHttpRequest
        const xhr = new XMLHttpRequest();
      
        // Si method es POST
        if (parameters.method === 'POST') {
            xhr.open('POST', parameters.url);
            parameters.data.comment_id = comment_id;
            parameters.data.comment_text = comment_text;
            // Setear header y enviar datos
            xhr.setRequestHeader('Content-Type', 'application/json');
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
            } else {
                // Manejar error
                console.error('Error en la petición:', xhr.status, xhr.statusText);
            }
        };
    }
      
    
}

function _createSidebarComments() { 
    var cksidebarComments = document.createElement("nav");
    cksidebarComments.id = "div_menu_comments";
    cksidebarComments.className = "div_menu_comments";
    var sidebar = `
                <input type="checkbox" class="menu-open-comments" name="menu-open" id="menu_open">
                <label for="menu_open" class="menu-open-button ">
                    <span class="app-shortcut-icon d-block"></span>
                </label>
                <a href="#" class="menu-item btn waves-effect waves-themed" data-toggle="tooltip" data-placement="left" title="" data-original-title="Scroll Top">
                    <i class="fal fa-arrow-up"></i>
                </a>`;
                    cksidebarComments.innerHTML = sidebar;
    document.body.appendChild(cksidebarComments);
}