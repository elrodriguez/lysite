<div>
    <div class="bg-white box-section">
        <div class="container-section page__container">
            <div class="row">
                <div class="col-md-2 align-items-start" style="padding: 0px;">
                    <p class="title-ia-lyon">
                        <STRONG>IA LYON</STRONG>
                    </p>
                </div>
                <div class="col-md-8 d-flex justify-content-center align-items-center" style="padding: 0px;">
                    <div class="image-der mr-3">
                        <img src="{{ asset('assets/images/ai-blanco.jpg') }}" alt="Card image cap"
                            style="width: 70px; height: 70px; margin: auto;">
                    </div>
                    <div class="texto">
                        <h5 class="mb-0" style="margin-left: -10px;">
                            <strong style="font-size: 1.8rem;letter-spacing: 0.0em;">CONSULTAS IA</strong>
                        </h5>
                    </div>
                </div>
                <div class="col-md-2 align-items-end" style="padding: 0px;">
                    <p style="padding: 85px 0px 0px 0px;">
                        <strong style="font-weight: 700;">OPORTUNIDADES&nbsp;:</strong>1500 <br>
                        <strong
                            style="font-weight: 700;">UTILIZADOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        </strong>0 <br>
                        <strong style="color: red;">DISPONIBLES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>1500
                        <br>
                    </p>
                </div>
            </div>


            <div class="row box-chrerry">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="media tab-vertical" wire:click="setBtnActive(1)">
                                <img src="{{ asset('assets/images/8a.png') }}" alt="Icono"
                                    class="media-left rounded">
                                <span class="media-body">
                                    <h5 class="mb-0">PARAFRASEADOR</h5>
                                    <p class="mt-0" >Cambia textos para mejorar su originalidad.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="media tab-vertical" wire:click="setBtnActive(2)">
                                <img src="{{ asset('assets/images/8b.png') }}" alt="Icono"
                                    class="media-left rounded">
                                <span class="media-body">
                                    <h5 class="mb-0">RECOMENDADOR</h5>
                                    <p >Accede a la recomendación de articulos cientificos.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="media tab-vertical" wire:click="setBtnActive(3)">
                                <img src="{{ asset('assets/images/8c.png') }}" alt="Icono"
                                    class="media-left rounded">
                                <span class="media-body">
                                    <h5 class="mb-0">CORRECTOR</h5>
                                    <p >Revisa y corrige errores gramaticales.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="media tab-vertical" wire:click="setBtnActive(4)">
                                <img src="{{ asset('assets/images/8d.png') }}" alt="Icono"
                                    class="media-left rounded">
                                <span class="media-body">
                                    <h5 class="mb-0">CHATBOT</h5>
                                    <p>Haz consultas o sube archivos para cualquier duda.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="media tab-vertical" wire:click="setBtnActive(5)">
                                <img src="{{ asset('assets/images/8e.png') }}" alt="Icono"
                                    class="media-left rounded">
                                <span class="media-body">
                                    <h5 class="mb-0">REFERENCIADOR</h5>
                                    <p >Referencia a la normativa con solo un enlace.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @if ($typeAction == 1)
                        <div class="row align-items-center">
                            <div class="col-md-12">

                                <div class="mt-2">
                                    <select wire:model="prompt" name="prompt" class="form-control"
                                        id="exampleFormControlSelect1" style="background-color: #fff;">
                                        <option value="0">Como Investigador</option>
                                        <option value="1">Disminuir Similitud</option>
                                        <option value="2">Humanizar Texto</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <textarea wire:model="consulta" class="form-control" id="consulta" rows="6"
                                        placeholder="escribe aquí lo que desee parafrasear." style="background-color: #fff;"></textarea>
                                </div>

                                <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                                    class="btn btn-orange">
                                    <div wire:loading wire:target="saveMessageUser" style="display: none"
                                        class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Procesar
                                </button>


                                <div class="mb-3">
                                    <textarea wire:model="resultado" class="form-control"id="resultado" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    @elseif($typeAction == 2)
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <form class="datos">
                                    <div class="mt-2">
                                        <label class="mb-0">&nbsp;&nbsp;Descripción:</label>
                                        <input wire:model="consulta" class="form-control" id="consulta"
                                            style="background-color: #fff;">
                                    </div>
                                    <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                                        class="btn btn-orange mt-2">
                                        <div wire:loading wire:target="saveMessageUser" style="display: none"
                                            class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Procesar
                                    </button>

                                </form>
                                <div class="mb-3">
                                    @if ($resultado)
                                        <div class="alert alert-primary" role="alert">
                                            {!! $resultado !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif($typeAction == 3)
                        <div class="row align-items-center">
                            <div class="col-md-12">

                                <div class="mt-2">
                                    <label class="mb-0">&nbsp;&nbsp;Texto:</label>
                                    <textarea wire:model="consulta" class="form-control" id="consulta" rows="6"
                                        placeholder="Escribe aquí lo que desee buscar" style="background-color: #fff;"></textarea>
                                </div>
                                <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                                    class="btn btn-orange mt-2">
                                    <div wire:loading wire:target="saveMessageUser" style="display: none"
                                        class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    Corregir
                                </button>

                                <div class="mb-3">
                                    @if ($resultado)
                                        <div class="alert alert-primary" role="alert">
                                            {{ $resultado }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif($typeAction == 4)
                        <div class="row box-chrerry">
                            <div class="col-md-9" style="padding: 0px;">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="list-unstyled" id="messageContainer"
                                                style="max-height: 350px; overflow-y: auto; background:#fff;">
                                                @if (count($historyItems) > 0)
                                                    @foreach ($historyItems as $item)
                                                        @if ($item->my_user)
                                                            <div style="padding: 15px; margin-bottom: 8px">
                                                                <div class="media">
                                                                    <div class="media-body">
                                                                        <div class="box-orange-chat">
                                                                            <!--<h6 class="mb-0">{{ $history->user->name }}</h6>-->
                                                                            <p class="text-break">{{ $item->content }}</p>
                                                                        </div>
                                                                        <small class="gpt-time_date">{{ $this->formatDateBox($item->created_at) }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div style="padding: 15px; margin-bottom: 8px">
                                                                <div class="media">
                                                                    <img src="https://www.lyonteach.com/assets/images/logo/white-60.png"
                                                                        class="mr-3" alt="...">
                                                                    <div class="media-body">
                                                                        <div class="box-chrerry-chat">
                                                                            <!--<h6 class="mb-0">LyonTech</h6>-->
                                                                            <p class="text-break">{{ $item->content }}</p>
                                                                        </div>
                                                                        <small class="gpt-time_date">{{ $this->formatDateBox($item->created_at) }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <textarea wire:model="message" class="form-control" rows="3" placeholder="Escribe tu consultas aqui..." style="background-color: #fff;"></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding: 5px 0px;">
                                    <div class="col-md-8">
                                        <div class="file-upload">
                                            <button onclick="document.getElementById('file').click()" class="span-small">Seleccionar archivo</button>
                                            <input type="file" id="file" onchange="updateFileName()">
                                            <span class="file-name" id="file-name" style="font-size: 11px;">Ningún archivo seleccionado</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button wire:click="saveMessageUser" wire:loading.attr="disabled"
                                            wire:target="saveMessageUser" type="button"
                                            class="btn btn-orange" style="margin-top: -5px; width: 100%;">
                                            <i wire:loading.remove wire:target="saveMessageUser"
                                                class="fa fa-location-arrow mr-2"></i>
                                            <div wire:loading wire:target="saveMessageUser"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <span>Enviar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <p style="font-weight: 700;">Palabras claves</p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(1)" type="button" wire:click="r_prompts(1)">
                                            <div wire:loading wire:target="r_prompts(1)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Objetivos</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(2)" type="button" wire:click="r_prompts(2)">
                                            <div wire:loading wire:target="r_prompts(2)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Estructura de antecedentes</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a  wire:loading.attr="disabled" wire:target="r_prompts(3)" type="button" wire:click="r_prompts(3)">
                                            <div wire:loading wire:target="r_prompts(3)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Problematica</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(4)" type="button"
                                            wire:click="r_prompts(4)">
                                            <div wire:loading wire:target="r_prompts(4)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Teorias empleadas</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(5)" type="button"  wire:click="r_prompts(5)">
                                            <div wire:loading wire:target="r_prompts(5)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Definiciones de las variables</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(6)" type="button"
                                            wire:click="r_prompts(6)">
                                            <div wire:loading wire:target="r_prompts(6)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Aporte de estudio</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(7)" type="button" wire:click="r_prompts(7)">
                                            <div wire:loading wire:target="r_prompts(7)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Resultados</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(8)" type="button" wire:click="r_prompts(8)">
                                            <div wire:loading wire:target="r_prompts(8)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Recomendación principal</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(9)" type="button" wire:click="r_prompts(9)">
                                            <div wire:loading wire:target="r_prompts(9)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Propuesta de mejora</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 list-vertical" style="margin-top: -15px;">
                                        <a wire:loading.attr="disabled" wire:target="r_prompts(10)" type="button"
                                            wire:click="r_prompts(10)">
                                            <div wire:loading wire:target="r_prompts(10)"
                                                class="spinner-grow spinner-grow-sm mr-2" role="status"
                                                style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="mt-0">Resumen general</p>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($typeAction == 5)
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="mt-2">
                                    <label class="mb-0">&nbsp;&nbsp;DOI:</label>
                                    <input wire:model="consulta" id="input-doi-buscar-id" type="text"
                                        class="form-control" aria-label="Sizing example input"
                                        style="background-color: #fff;" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="Coleque el enlace DOI">
                                    <label class="mb-0">&nbsp;&nbsp;Normativa:</label>
                                    <select wire:model="normativa" class="form-control" id="select-normativa"
                                        name="select-normativa" style="background-color: #fff;">
                                        <option value="apa">APA</option>
                                        <option value="iso690">ISO</option>
                                        <option value="vancouver">Vancouver</option>
                                    </select>
                                </div>
                                <div class="row" style="padding: 5px 8px 5px 0px;">
                                    <div class="col-md-9 mt-1">
                                        <a href="#" onclick="modifyCitation()" id="modify-citation-id"
                                            class="btn-small" type="button">Modificar cita
                                        </a>
                                        <a href="#" onclick="copyCitation()" class="btn-small"
                                            type="button">Copiar cita
                                        </a>
                                        <a href="#" onclick="hideBuscar()" id="cita-manual-id"
                                            data-toggle="collapse" data-target="#collapseWidthExample1"
                                            aria-expanded="false" aria-controls="collapseWidthExample1"
                                            class="btn-small" type="button">Cita manual
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <button wire:click="saveMessageUser" wire:loading.attr="disabled"
                                            id="ckgetBtnReference" type="button" class="btn btn-orange" style="width: 100%;">
                                            <div wire:loading wire:target="saveMessageUser" style="display: none"
                                                class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Procesar
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse width p-2" id="collapseWidthExample1">

                                    <div class="ly-ck-dialog-group-control">

                                        <div class="btn-group btn-group-sm" role="group" aria-label="">
                                            <button onclick="select_citation('thesis')" type="button"
                                                class="btn btn-primary">Tesis</button>
                                            <button onclick="select_citation('article')" type="button"
                                                class="btn btn-primary">Artículo</button>
                                            <button onclick="select_citation('page')" type="button"
                                                class="btn btn-primary">Página Web</button>
                                            <button onclick="select_citation('book')" type="button"
                                                class="btn btn-primary">Libro Virtual</button>
                                            <button onclick="select_citation('book-fisico')" type="button"
                                                class="btn btn-primary">Libro Físico</button>
                                            <button onclick="select_citation('document-gubernamental')" type="button"
                                                class="btn btn-primary">Documento Gub.</button>

                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Doc. Legal
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a onclick="select_citation('document-legal-codigo-general')"
                                                        class="dropdown-item" href="#">Código general</a>
                                                    <a onclick="select_citation('document-legal-codigo-explicito')"
                                                        class="dropdown-item" href="#">Código explícito</a>
                                                    <a onclick="select_citation('document-legal-expedido-sala-penal')"
                                                        class="dropdown-item" href="#">Expedido por Salas
                                                        penales</a>
                                                    <a onclick="select_citation('document-legal-expedido-sala-corte-suprema')"
                                                        class="dropdown-item" href="#">Sala Penal perm. de Corte
                                                        Suprema</a>
                                                    <a onclick="select_citation('document-legal-reglamento-notarial')"
                                                        class="dropdown-item" href="#">Reglamento Notarial</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <h3 class="col-6 mx-auto" id="tipo-referencia"></h3>
                                    </div>

                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-autor">Autor/es:</label>
                                        <textarea style="background-color: #fff;" onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            rows="2" id="input-autor" name="input-autor"
                                            placeholder="John Miguel, Gutierrez Sosa; Carmen María, Mendoza Villa"></textarea>
                                        <spam id="input-autor-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-institucion">Institución, Entidad
                                            o
                                            Revista:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-institucion" name="input-institucion"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-institucion-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-libro">N° de Libro:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-libro" name="input-libro"
                                            placeholder="Ejem. Libro segundo" style="background-color: #fff;" />
                                        <spam id="input-libro-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-n-titulo">N° de Título:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-n-titulo" name="input-n-titulo"
                                            placeholder="Ejem. Título Noveno" style="background-color: #fff;" />
                                        <spam id="input-n-titulo-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-capitulo">Capítulo N°:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-capitulo" name="input-capitulo"
                                            placeholder="Ejem. XII, I, IV, etc." style="background-color: #fff;">
                                        <spam id="input-capitulo-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-capitulo-nombre">Nombre del
                                            Capítulo:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-capitulo-nombre" name="input-capitulo-nombre"
                                            placeholder="Ejem. Peculado" style="background-color: #fff;">
                                        <spam id="input-capitulo-nombre-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-titulo">Título:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-titulo" name="input-titulo"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-titulo-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-namepage">Nombre de la Página
                                            WEB:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-namepage" name="input-namepage"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-namepage-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-date">Fecha de
                                            publicación:</label>
                                        <input onchange="manual_citation(event)" class="form-control form-control-sm"
                                            type="date" id="input-date" name="input-date"
                                            style="background-color: #fff;">
                                        <spam id="input-date-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-date-consulta">Fecha de
                                            Consulta:</label>
                                        <input onchange="manual_citation(event)" class="form-control form-control-sm"
                                            type="date" id="input-date-consulta" name="input-date-consulta"
                                            style="background-color: #fff;">
                                        <spam id="input-date-consulta-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-grado">Grado Académico:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-grado" name="input-grado"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-grado-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-universidad">Universidad:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-universidad" name="input-universidad"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-universidad-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-pais">País o Ciudad:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-pais" name="input-pais"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-pais-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-siglas">Siglas Entidad/Nombre del
                                            Emisor:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-siglas" name="input-siglas"
                                            placeholder="Siglas de la entidad emisora o el nombre del emisor"
                                            style="background-color: #fff;">
                                        <spam id="input-siglas-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-repositorio">Repositorio:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-repositorio" name="input-repositorio"
                                            placeholder="Ejemplos: Repositorio UCV, Repositorio UNMSM u otros..."
                                            style="background-color: #fff;">
                                        <spam id="input-repositorio-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-isbn">ISBN:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-isbn" name="input-isbn"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-isbn-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-volumen">Volumen:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="number" id="input-volumen" name="input-volumen"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-volumen-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-numero">Número:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="number" id="input-numero" name="input-numero"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-numero-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-paginas">Páginas:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-paginas" name="input-paginas"
                                            placeholder="Ejem. 20-32" style="background-color: #fff;">
                                        <spam id="input-paginas-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-editorr">Editor:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-editorr" name="input-editorr"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-editorr-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-editorial">Editorial:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-editorial" name="input-editorial"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-editorial-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-edicion">Número de
                                            Edición:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="number" id="input-edicion" name="input-edicion"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-edicion-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-enlace">Enlace URL o URI:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-enlace" name="input-enlace"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-enlace-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-doi-a">Código DOI:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-doi-a" name="input-doi-a"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-doi-a-error"></span>
                                    </div>
                                    <div class="ly-ck-dialog-group-control">
                                        <label class="ly-ck-dialog-label" for="input-issn">ISSN:</label>
                                        <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                            type="text" id="input-issn" name="input-issn"
                                            placeholder="Escriba aquí..." style="background-color: #fff;">
                                        <spam id="input-issn-error"></span>
                                    </div>

                                </div>
                                <div class="p-2" id="ly-ck-dialog-references-result">
                                    @if ($resultado)
                                        <div id="citation-id" class="alert alert-primary" role="alert">
                                            {!! $resultado !!}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script src="{{ asset('assets/js/ckeditor/manual_citation.js') }}"></script>
        <script>
            function scrollChatGptToBottom() {
                var chatContainer = document.getElementById('messageContainer');
                if (chatContainer) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            }
        </script>
    @stop
    <script>
        window.addEventListener('scroll-messages-updated', event => {
            scrollChatGptToBottom();
        })
    </script>


    <script>
        function updateFileName() {
            const input = document.getElementById('file');
            const fileName = document.getElementById('file-name');
            fileName.textContent = input.files.length > 0 ? input.files[0].name : 'Ningún archivo seleccionado';
        }
    </script>
</div>
