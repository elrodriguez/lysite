import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';
import BalloonPanelView from '@ckeditor/ckeditor5-ui/src/panel/balloon/balloonpanelview';
import FormView from '@ckeditor/ckeditor5-ui/src/form/formview';
import InputTextView from '@ckeditor/ckeditor5-ui/src/inputtext/inputtextview';
import FocusTracker from '@ckeditor/ckeditor5-utils/src/focustracker';
import FocusCycler from '@ckeditor/ckeditor5-ui/src/focuscycler';
import KeystrokeHandler from '@ckeditor/ckeditor5-utils/src/keystrokehandler';

export default class MarginPlugin extends Plugin {
    init() {
        const editor = this.editor;
        const model = editor.model;
        const t = editor.t;

        editor.ui.componentFactory.add( 'marginButton', locale => {
            const view = new ButtonView( locale );
            view.set( {
                label: 'Márgenes',
                icon: 'margin',
                tooltip: true
            } );

            view.on( 'execute', () => {
                editor.execute( 'openMarginDialog' );
            } );

            return view;
        } );

        editor.commands.add( 'openMarginDialog', {
            async execute() {
                const dialog = new BalloonPanelView();
                const form = new FormView();

                dialog.children.add( form );

                form.children.add( new InputTextView( {
                    label: t( 'Izquierdo' ),
                    class: 'ck-input-text'
                } ) );

                form.children.add( new InputTextView( {
                    label: t( 'Derecho' ),
                    class: 'ck-input-text'
                } ) );

                form.children.add( new InputTextView( {
                    label: t( 'Arriba' ),
                    class: 'ck-input-text'
                } ) );

                form.children.add( new InputTextView( {
                    label: t( 'Abajo' ),
                    class: 'ck-input-text'
                } ) );

                const saveButton = new ButtonView();
                saveButton.label = t( 'Aplicar' );
                saveButton.class = 'ck-button-save';
                saveButton.on( 'execute', () => {
                    const inputs = form.children;
                    const left = inputs.get( 0 ).inputView.element.value;
                    const right = inputs.get( 1 ).inputView.element.value;
                    const top = inputs.get( 2 ).inputView.element.value;
                    const bottom = inputs.get( 3 ).inputView.element.value;

                    model.change( writer => {
                        writer.setAttribute(
                            writer.setAttribute( 'margin-left', left + 'px', editor.document.getRoot() );
                            writer.setAttribute( 'margin-right', right + 'px', editor.document.getRoot() );
                            writer.setAttribute( 'margin-top', top + 'px', editor.document.getRoot() );
                            writer.setAttribute( 'margin-bottom', bottom + 'px', editor.document.getRoot() );
                        } );

                        editor.editing.view.focus();
                        dialog.hide();
                    } );

                    form.children.add( saveButton );

                    form.delegate( 'submit', 'cancel' );

                    const focusTracker = new FocusTracker( {
                        element: dialog.element
                    } );

                    const focusCycler = new FocusCycler( {
                        focusables: form.focusables,
                        focusTracker,
                        keystrokeHandler: new KeystrokeHandler( editor.locale ),
                        actions: {
                            focusPrevious: 'shift + tab',
                            focusNext: 'tab'
                        }
                    } );

                    form.keystrokes.set( 'Esc', ( data, cancel ) => {
                        dialog.hide();
                        cancel();
                    } );

                    dialog.keystrokes.set( 'Tab', ( data, cancel ) => {
                        focusCycler.focusNext();
                        cancel();
                    } );

                    dialog.keystrokes.set( 'Shift+Tab', ( data, cancel ) => {
                        focusCycler.focusPrevious();
                        cancel();
                    } );

                    editor.ui.add( dialog );
                    dialog.show();
                    focusTracker.focusFirst();
                }
            });
        }
    }
    
}
    