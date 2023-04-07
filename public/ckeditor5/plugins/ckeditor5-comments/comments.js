import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';
import BalloonPanelView from '@ckeditor/ckeditor5-ui/src/panel/balloon/balloonpanelview';

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
               
                withText: true,
                //tooltip: true
            } );

            button.on( 'execute', () => {
                this._createDialog();
            } );

            return button;
        } );
        
        
    }
    
    _createDialog() {
        const editor = this.editor;
        const t = editor.t;

        const dialog = editor.plugins.get('Dialog');

        const panelView = new BalloonPanelView(editor.locale, {
            heading: 'Ingrese el texto',
            autoClose: true,
            content: ''
        });

        const textarea = document.createElement('textarea');
        textarea.style.width = '100%';
        textarea.style.height = '200px';
        panelView.content.appendChild(textarea);

        const saveButton = document.createElement('button');
        saveButton.textContent = t('Guardar');
        saveButton.addEventListener('click', () => {
            console.log(textarea.value); // Aquí puedes hacer lo que quieras con el texto ingresado
            panelView.remove();
        });
        panelView.footerView.element.appendChild(saveButton);

        const cancelButton = document.createElement('button');
        cancelButton.textContent = t('Cancelar');
        cancelButton.addEventListener('click', () => {
            panelView.remove();
        });
        panelView.footerView.element.appendChild(cancelButton);

        dialog.add(panelView);
        dialog.openPanel(panelView);
    }
}