import { Plugin } from 'ckeditor5/src/core';
import { ButtonView } from 'ckeditor5/src/ui';

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
                withText: true
            } );

            button.on( 'execute', () => {
                // const now = new Date();

                // // Change the model using the model writer.
                // editor.model.change( writer => {

                //     // Insert the text at the user's current position.
                //     editor.model.insertContent( writer.createText( now.toString() ) );
                // } );



            } );

            return button;
        } );
        
    }
}