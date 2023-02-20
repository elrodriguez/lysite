import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';

export default class completethesis extends Plugin {
    init() {
        const editor = this.editor;
        // The button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add('completethesis', () => {
            // The button will be an instance of ButtonView.
            const button = new ButtonView();

            button.set( {
                label: 'Ver Tesis Completa',
                withText: true
            } );

            button.on( 'execute', () => {
                let thesis = document.getElementById('xthesis_id').value;
                window.open(`../../../investigation/thesis/export/complete/`+thesis, '_blank');
            } );

            return button;
        } );
        
    }
}