import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';

export default class paraphrase extends Plugin {
    init() {
        const editor = this.editor;
        // The button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add('paraphrase', () => {
            // The button will be an instance of ButtonView.
            const button = new ButtonView();

            button.set( {
                label: 'Parafrasear',
                withText: true
            } );

            button.on( 'execute', () => {
                // const now = new Date();

                // // Change the model using the model writer.
                // editor.model.change( writer => {

                //     // Insert the text at the user's current position.
                //     editor.model.insertContent( writer.createText( now.toString() ) );
                // } );


                let paraphrase = document.getElementById('paraphrase');
                let documentsheet = document.getElementById('documentsheet');
                paraphrase.style.display = 'block';

                documentsheet.classList.remove("col-12");
                documentsheet.classList.add("col-9");
            } );

            return button;
        } );
        
    }
}