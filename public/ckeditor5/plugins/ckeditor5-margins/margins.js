import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';

export default class margins extends Plugin {
    init() {
        const editor = this.editor;
		// Función para arrastrar el modal
		var isDragging = false;
		var currentX;
		var currentY;
		var initialX;
		var initialY;
		var xOffset = 0;
		var yOffset = 0;

        editor.ui.componentFactory.add('margins', locale => {
            const view = new ButtonView( locale );

            view.set( {
                label: 'Márgenes',
                withText: true,
                tooltip: true
            } );

            view.on( 'execute', () => {
                const form = `
					<div id="ckmodal" class="ckmodal">
						<div class="ckmodal-content">
							<span id="ckcloseBtn" class="ckcloseBtn">&times;</span>
							<form>
								<label for="left-margin">Margen Izquierdo en mm:</label>
								<input type="number" id="left-margin" name="left-margin">

								<label for="right-margin">Margen Derecho en mm:</label>
								<input type="number" id="right-margin" name="right-margin">

								<label for="top-margin">Margen Arriba en mm:</label>
								<input type="number" id="top-margin" name="top-margin">

								<label for="bottom-margin">Margen Abajo en mm:</label>
								<input type="number" id="bottom-margin" name="bottom-margin">

								<button type="button" id="submit-margins" onclick="saving()">
									<span class="fa fa-check"></span>
								</button>
							</form>
						</div>
					</div>

                `;


				document.getElementById('global-modal').innerHTML = form;
                //editor.editing.view.getDomRoot().innerHTML += form;

                const submitButton = document.querySelector( '#submit-margins' );

                submitButton.addEventListener( 'click', () => {
                    const leftMargin = document.querySelector( '#left-margin' ).value;
                    const rightMargin = document.querySelector( '#right-margin' ).value;
                    const topMargin = document.querySelector( '#top-margin' ).value;
                    const bottomMargin = document.querySelector( '#bottom-margin' ).value;

					document.getElementById('xleft-margin').value = leftMargin;
					document.getElementById('xright-margin').value = rightMargin;
					document.getElementById('xtop-margin').value = topMargin;
					document.getElementById('xbottom-margin').value = bottomMargin;

                    editor.editing.view.getDomRoot().style.paddingLeft = leftMargin + 'mm';
                    editor.editing.view.getDomRoot().style.paddingRight = rightMargin + 'mm';
                    editor.editing.view.getDomRoot().style.paddingTop = topMargin + 'mm';
                    editor.editing.view.getDomRoot().style.paddingBottom = bottomMargin + 'mm';
                } );

				opemModalMargin();
				closeModalMargin();
            } );

            return view;
        } );

		function opemModalMargin(){
			const modal = document.querySelector( '#ckmodal' );
			modal.style.display = "block";
		}

		function closeModalMargin(){
			const ckcloseBtn = document.querySelector( '#ckcloseBtn' );

			ckcloseBtn.addEventListener( 'click', () => {

				const modal = document.querySelector( '#ckmodal' );
				modal.style.display = "none";
			});

		}

    }

}
