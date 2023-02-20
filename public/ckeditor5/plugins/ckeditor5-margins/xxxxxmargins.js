// Archivo margenes-plugin.js
import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';
import InputTextView from '@ckeditor/ckeditor5-ui/src/inputtext/inputtextview';
import { createDropdown } from 'ckeditor5/src/ui';
import { CKEditorError } from 'ckeditor5/src/utils';

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

                const derechoInput = new InputTextView( locale );
                const izquierdoInput = new InputTextView( locale );
                const arribaInput = new InputTextView( locale );
                const abajoInput = new InputTextView( locale );

                derechoInput.label = t( 'Margen derecho' );
                izquierdoInput.label = t( 'Margen izquierdo' );
                arribaInput.label = t( 'Margen arriba' );
                abajoInput.label = t( 'Margen abajo' );

                const modal = document.createElement("div");
                modal.innerHTML = `
                  <div class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Agregar márgenes</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group">
                              <label for="right-margin">Margen derecho</label>
                              <input type="text" class="form-control" id="right-margin" placeholder="Margen derecho">
                            </div>
                            <div class="form-group">
                              <label for="left-margin">Margen izquierdo</label>
                              <input type="text" class="form
                              </div>
                              <div class="form-group">
                                <label for="top-margin">Margen superior</label>
                                <input type="text" class="form-control" id="top-margin" placeholder="Margen superior">
                              </div>
                              <div class="form-group">
                                <label for="bottom-margin">Margen inferior</label>
                                <input type="text" class="form-control" id="bottom-margin" placeholder="Margen inferior">
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Aplicar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  `;

                const applyButton = modal.querySelector(".btn-primary");
                
                applyButton.addEventListener("click", () => {
                    const rightMargin = modal.querySelector("#right-margin").value;
                    const leftMargin = modal.querySelector("#left-margin").value;
                    const topMargin = modal.querySelector("#top-margin").value;
                    const bottomMargin = modal.querySelector("#bottom-margin").value;
                    
                    editor.editing.view.change(writer => {
                        writer.setStyle("margin-right", rightMargin + "px");
                        writer.setStyle("margin-left", leftMargin + "px");
                        writer.setStyle("margin-top", topMargin + "px");
                        writer.setStyle("margin-bottom", bottomMargin + "px");
                    });
                    // editor.model.change( writer => {
                    //     writer.setSelectionAttribute( 'style', `margin-right: ${ derecho }px; margin-left: ${ izquierdo }px; margin-top: ${ arriba }px; margin-bottom: ${ abajo }px;` );
                    // } );
                    $(modal).modal("hide");
                });

                document.getElementById('global-modal').innerHTML = modal;
                $(modal).modal("show");
            } );

            

            return view;
        } );
    }
}
