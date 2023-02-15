<!DOCTYPE html><!--
	Copyright (c) 2014-2023, CKSource Holding sp. z o.o. All rights reserved.
	This file is licensed under the terms of the MIT License (see LICENSE.md).
-->

<html lang="en" dir="ltr">
	<head>
		<title>Exportar Thesis</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="{{ url('assets/images/logo/white-60.png') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('ckeditor5/sample/styles.css') }}">
	</head>
	<body data-editor="DecoupledDocumentEditor" data-collaboration="false" data-revision-history="false">
		<header>
			<div class="centered">
				<h1>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ url('assets/images/logo/white-60.png') }}" alt="{{ env('APP_NAME', 'Laravel') }}">
                        {{ env('APP_NAME', 'Laravel') }}
                    </a>
                </h1>
				<nav>
					<ul>
						{{-- <li><a href="https://ckeditor.com/docs/ckeditor5/" target="_blank" rel="noopener noreferrer">Documentation</a></li> --}}
						<li><a href="{{ route('logout') }}" rel="noopener noreferrer">Cerrar sesión</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<main>
			<div class="message">
				<div class="centered">
					<h2>Con esta herramienta puede exportar su tesis</h2>
				</div>
			</div>
			<div class="centered">
				<div class="row">
					<div class="document-editor__toolbar"></div>
				</div>
				<div class="row row-editor">
					<div class="editor-container">
						<div class="editor">
							
						</div>
					</div>
				</div></div>
			</div>
		</main>
		<footer>
			<p>Copyright © 2003-2023,
				<a href="https://cksource.com/" target="_blank" rel="noopener">{{ env('APP_NAME', 'Laravel') }}</a>
				Reservados todos los derechos.
			</p>
		</footer>
		<script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
		<script>DecoupledDocumentEditor
				.create( document.querySelector( '.editor' ), {
					
					licenseKey: 'AH9z8JZzCLSSQ0QH0GEZwxX2c65Li7fafzEp7GaVXKRtezRZlEIY7lFoyIdA',
					
					exportWord: {
						tokenUrl: 'https://95003.cke-cs.com/token/dev/deef23ee76d3e57a9b8590e70cef52a187724c3781598bd7e08e2cfad5f1?limit=10',
						fileName: 'my-file.docx',
						converterOptions: {
							format: 'A4', // Default value, you don't need to specify it explicitly for A4.
							margin_top: '20mm',
							margin_bottom: '20mm',
							margin_right: '12mm',
							margin_left: '12mm'
						}
					}
					
				} )
				.then( editor => {
					window.editor = editor;
			
					// Set a custom container for the toolbar.
					document.querySelector( '.document-editor__toolbar' ).appendChild( editor.ui.view.toolbar.element );
					document.querySelector( '.ck-toolbar' ).classList.add( 'ck-reset_all' );

				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: kehfuamz5tol-66hszd8qikx0' );
					console.error( error );
				} );
		</script>
	</body>
</html>