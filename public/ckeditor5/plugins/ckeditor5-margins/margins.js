// Archivo margenes-plugin.js
import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';
import ModalView from '@ckeditor/ckeditor5-ui/src/modal/modalview';
import InputTextView from '@ckeditor/ckeditor5-ui/src/inputtext/inputtextview';

export default class margins extends Plugin {
    init() {
        const editor = this.editor;
        const t = editor.t;

        editor.ui.componentFactory.add( 'margins', locale => {
            const view = new ButtonView( locale );
            view.set( {
                label: t( 'Agregar margenes' ),
                withText: true
            } );

            view.on( 'execute', () => {
                const modal = new ModalView( locale );
                const derechoInput = new InputTextView( locale );
                const izquierdoInput = new InputTextView( locale );
                const arribaInput = new InputTextView( locale );
                const abajoInput = new InputTextView( locale );

                derechoInput.label = t( 'Margen derecho' );
                izquierdoInput.label = t( 'Margen izquierdo' );
                arribaInput.label = t( 'Margen arriba' );
                abajoInput.label = t( 'Margen abajo' );

                modal.children.add( derechoInput );
                modal.children.add( izquierdoInput );
                modal.children.add( arribaInput );
                modal.children.add( abajoInput );

                modal.header = t( 'Agregar margenes' );
                modal.content = `
                    <form>
                        <div class="ck-form-group">
                            ${ derechoInput.element.outerHTML }
                        </div>
                        <div class="ck-form-group">
                            ${ izquierdoInput.element.outerHTML }
                        </div>
                        <div class="ck-form-group">
                            ${ arribaInput.element.outerHTML }
                        </div>
                        <div class="ck-form-group">
                            ${ abajoInput.element.outerHTML }
                        </div>
                    </form>
                `;

                modal.footer = `
                    <button type="button" class="ck-button ck-button-primary">${ t( 'Agregar' ) }</button>
                    <button type="button" class="ck-button ck-button-default">${ t( 'Cancelar' ) }</button>
                `;

                modal.show();
                modal.listenTo( modal, 'submit', evt => {
                    evt.preventDefault();

                    const derecho = derechoInput.value;
                    const izquierdo = izquierdoInput.value;
                    const arriba = arribaInput.value;
                    const abajo = abajoInput.value;

                    editor.model.change( writer => {
                        writer.setSelectionAttribute( 'style', `margin-right: ${ derecho }px; margin-left: ${ izquierdo }px; margin-top: ${ arriba }px; margin-bottom: ${ abajo }px;` );
                    } );

                    modal.hide();
                } );
            } );

            return view;
        } );
    }
}
