<div>
    <div class="lyon" style="margin-bottom: 20px">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-3 col-sm-12">
                    <div class="row">
                        <div class="text-bot field-text-a">
                            <p style="text-align: left; color: orange; font-size: 1.8rem;"><STRONG>IA LYON</STRONG></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                    <div class="image-der mr-3">
                        <img src="{{ asset('theme-lyontech/images/ai-blanco.jpg') }}" alt="Card image cap"
                            style="width: 100px; height: 100px; margin: auto;">
                    </div>
                    <div class="texto">
                        <h5 class="mb-0" style="margin-left: -30px;"><strong
                                style="font-size: 1.8rem;letter-spacing: 0.0em;">CONSULTAS IA</strong></h5>
                    </div>
                </div>
                <!--               <div class="col-md-3 col-sm-12">
                    <div class="image-der">
                      <img src="images/ai-blanco.jpg"  alt="Card image cap" style="width: 100px; height: 100px; margin: auto;">
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-12 justify-content-center align-items-center">
                  <div class="row mt-5 ">
                    <h5 class="mb-0 "><strong style="font-size: 1.8rem;letter-spacing: 0.0em;">CONSULTAS IA</strong></h5>
                  </div>
                </div> -->

                <div class="col-md-3 col-sm-12">
                    <div class="row">
                        <div class="text-bot field-text">
                            <p><strong>OPORTUNIDADES:</strong>1500</p>
                            <p><strong>UTILIZADOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                </strong>0</p>
                            <p style="color: red;">
                                <strong>DISPONIBLES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>1500
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-bottom: 60px">
            <div class="col-md-4">
                <div class="card ">
                    <div class="btn-group-vertical">
                        <button class="btn-with-icon boton" wire:click="setBtnActive(1)">
                            <div class="con-boton">
                                <img src="{{ asset('theme-lyontech/images/8a.jpg') }}" alt="Icono">
                            </div>
                            <div class="contenido">
                                <h5 class="mb-0">PARAFRASEDOR</h5>
                                <p class="mt-0">Cambia textos para mejorar su originalidad.</p>
                            </div>
                        </button>
                        <button class="btn-with-icon boton" wire:click="setBtnActive(2)">
                            <div class="con-boton">
                                <img src="{{ asset('theme-lyontech/images/8b.jpg') }}" alt="Icono">
                            </div>
                            <div class="contenido">
                                <h5>RECOMENDADOR</h5>
                                <p>Accede a la recomendación de articulos cientificos.</p>
                            </div>
                        </button>
                        <button class="btn-with-icon boton" wire:click="setBtnActive(3)">
                            <div class="con-boton">
                                <img src="{{ asset('theme-lyontech/images/8c.jpg') }}" alt="Icono">
                            </div>
                            <div class="contenido">
                                <h5>CORRECTOR</h5>
                                <p>Revisa y corrige errores gramaticales.</p>
                            </div>
                        </button>
                        <button class="btn-with-icon boton" wire:click="setBtnActive(4)">
                            <div class="con-boton">
                                <img src="{{ asset('theme-lyontech/images/8d.jpg') }}" alt="Icono">
                            </div>
                            <div class="contenido">
                                <h5>CHATBOT</h5>
                                <p>Haz consultas o sube archivos para cualquier duda.</p>
                            </div>
                        </button>
                        <button class="btn-with-icon boton" wire:click="setBtnActive(5)">
                            <div class="con-boton">
                                <img src="{{ asset('theme-lyontech/images/8e.jpg') }}" alt="Icono">
                            </div>
                            <div class="contenido">
                                <h5>REFERENCIADOR</h5>
                                <p>Referencia a la normativa con solo un enlace.</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if ($typeAction == 1)
                    <div class="card">
                        <div class="container container-b">
                            <form class="datos">
                                <div class="mt-2">
                                    <select wire:model="prompt" name="prompt" class="form-control"
                                        id="exampleFormControlSelect1">
                                        <option value="0">Como Investigador</option>
                                        <option value="1">Disminuir Similitud</option>
                                        <option value="2">Humanizar Texto</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <textarea wire:model="consulta" class="form-control" id="consulta" rows="6"
                                        placeholder="escribe aquí lo que desee parafrasear."></textarea>
                                </div>

                                <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                                    class="btn btn-primary orange-button">
                                    <div wire:loading wire:target="saveMessageUser" style="display: none"
                                        class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Procesar
                                </button>

                            </form>
                            <div class="mb-3">
                                <textarea wire:model="resultado" class="form-control"id="resultado" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                @elseif($typeAction == 2)
                    <div class="card">
                        <div class="container container-b">
                            <form class="datos">
                                <div class="mt-2">
                                    <label class="mb-0">&nbsp;&nbsp;Descripción:</label>
                                    <input wire:model="consulta" class="form-control" id="consulta">
                                </div>
                                <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                                    class="btn btn-primary orange-button">
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
                    <div class="card">
                        <div class="container container-b">
                            <form class="datos">
                                <div class="mt-2">
                                    <label class="mb-0">&nbsp;&nbsp;Texto:</label>
                                    <textarea wire:model="consulta" class="form-control" id="consulta" rows="6"
                                        placeholder="Escribe aquí lo que desee buscar"></textarea>
                                </div>
                                <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                                    class="btn btn-primary orange-button">
                                    <div wire:loading wire:target="saveMessageUser" style="display: none"
                                        class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    Corregir
                                </button>
                            </form>
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
                    <div class="row">
                        <div class="col-7 pr-0">
                            <div class="card">
                                <div class="container container-b">

                                    <div class="form-group mt-2 ">
                                        <div class="list-unstyled" id="messageContainer"
                                            style="max-height: 350px; overflow-y: auto;">
                                            @if (count($historyItems) > 0)
                                                @foreach ($historyItems as $item)
                                                    @if ($item->my_user)
                                                        <div
                                                            style="background: #fff;padding: 8px;border-radius: 5px;margin-bottom: 8px">

                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0 mb-1">{{ $history->user->name }}
                                                                    </h5>
                                                                    <p class="text-break">{{ $item->content }}</p>
                                                                    <small
                                                                        class="gpt-time_date">{{ $this->formatDateBox($item->created_at) }}</small>
                                                                </div>
                                                                @if ($history->user->avatar)
                                                                    <img src="{{ asset('storage/' . $history->user->avatar) }}"
                                                                        class="ml-3" alt="..."
                                                                        style="width: 64px">
                                                                @else
                                                                    <img src="{{ ui_avatars_url($history->user->name, 64, 'none') }}"
                                                                        class="ml-3" alt="..."
                                                                        style="width: 64px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="background: #fff;padding: 8px;border-radius: 5px;margin-bottom: 8px">
                                                            <div class="media">
                                                                <img src="https://www.lyonteach.com/assets/images/logo/white-60.png"
                                                                    class="mr-3" alt="...">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0">LyonTech</h5>
                                                                    <p class="text-break">{{ $item->content }}</p>
                                                                    <small
                                                                        class="gpt-time_date">{{ $this->formatDateBox($item->created_at) }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <textarea wire:model="message" class="form-control" rows="3"></textarea>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="button-wrapper">
                                                    <span class="label">
                                                        Seleccionar archivo
                                                    </span>

                                                    <input type="file" id="file" name="file"
                                                        wire:model="file" class="upload-box"
                                                        placeholder="Uplsdadoad File">

                                                </div>
                                            </div>
                                            <div class="col-5 pl-0 palabras">
                                                <label for="exampleFormControlInput1">Sin archivos
                                                    seleccionados</label>
                                            </div>
                                            <div class="col-3 mt-2">
                                                <button wire:click="saveMessageUser" wire:loading.attr="disabled"
                                                    wire:target="saveMessageUser" type="button"
                                                    class="orange-button">
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
                                </div>
                            </div>
                            <script>
                                scrollChatGptToBottom();
                            </script>
                        </div>
                        <div class="col-5 pl-0">


                            <h4 class="text-center">Palabras clave</h4>
                            <ul class="list-group list-group-flush">
                                <button wire:loading.attr="disabled" wire:target="r_prompts(1)" type="button"
                                    wire:click="r_prompts(1)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(1)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Objetivos
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(2)" type="button"
                                    wire:click="r_prompts(2)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(2)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Estructura de
                                    antecedente
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(3)" type="button"
                                    wire:click="r_prompts(3)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(3)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Problemática
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(4)" type="button"
                                    wire:click="r_prompts(4)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(4)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Teorías
                                    empleadas
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(5)" type="button"
                                    wire:click="r_prompts(5)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(5)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Definiciones de
                                    variables
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(6)" type="button"
                                    wire:click="r_prompts(6)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(6)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Aporte de
                                    estudio
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(7)" type="button"
                                    wire:click="r_prompts(7)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(7)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Resultados
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(8)" type="button"
                                    wire:click="r_prompts(8)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(8)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Recomendación
                                    principal
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(9)" type="button"
                                    wire:click="r_prompts(9)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(9)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Propuesta de
                                    mejora
                                </button>
                                <button wire:loading.attr="disabled" wire:target="r_prompts(10)" type="button"
                                    wire:click="r_prompts(10)" class="list-group-item list-group-item-action">
                                    <div wire:loading wire:target="r_prompts(10)"
                                        class="spinner-grow spinner-grow-sm mr-2" role="status"
                                        style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Resumen general
                                </button>
                            </ul>

                        </div>
                    </div>
                @elseif($typeAction == 5)
                    <div class="card">
                        <div class="container container-b">

                            <div class="mt-2">
                                <label class="mb-0">&nbsp;&nbsp;DOI:</label>
                                <input wire:model="consulta" id="input-doi-buscar-id" type="text"
                                    class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Coleque el enlace DOI">
                                <label class="mb-0">&nbsp;&nbsp;Normativa:</label>
                                <select wire:model="normativa" class="form-control" id="select-normativa"
                                    name="select-normativa">
                                    <option value="apa">APA</option>
                                    <option value="iso690">ISO</option>
                                    <option value="vancouver">Vancouver</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-10 mt-1">
                                    <button onclick="modifyCitation()" id="modify-citation-id" class="citas"
                                        type="button">Modificar cita</button>
                                    <button onclick="copyCitation()" class="citas" type="button">Copiar
                                        cita</button>
                                    <button onclick="hideBuscar()" id="cita-manual-id" data-toggle="collapse"
                                        data-target="#collapseWidthExample1" aria-expanded="false"
                                        aria-controls="collapseWidthExample1" class="citas" type="button">Cita
                                        manual</button>
                                </div>
                                <div class="col-2">
                                    <button wire:click="saveMessageUser" wire:loading.attr="disabled"
                                        id="ckgetBtnReference" type="button" class="btn btn-primary orange-button">
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
                                    <textarea onkeyup="manual_citation(event)" class="form-control form-control-sm" rows="2" id="input-autor"
                                        name="input-autor" placeholder="John Miguel, Gutierrez Sosa; Carmen María, Mendoza Villa"></textarea>
                                    <spam id="input-autor-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-institucion">Institución, Entidad o
                                        Revista:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-institucion" name="input-institucion"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-institucion-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-libro">N° de Libro:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-libro" name="input-libro"
                                        placeholder="Ejem. Libro segundo" />
                                    <spam id="input-libro-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-n-titulo">N° de Título:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-n-titulo" name="input-n-titulo"
                                        placeholder="Ejem. Título Noveno" />
                                    <spam id="input-n-titulo-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-capitulo">Capítulo N°:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-capitulo" name="input-capitulo"
                                        placeholder="Ejem. XII, I, IV, etc.">
                                    <spam id="input-capitulo-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-capitulo-nombre">Nombre del
                                        Capítulo:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-capitulo-nombre" name="input-capitulo-nombre"
                                        placeholder="Ejem. Peculado">
                                    <spam id="input-capitulo-nombre-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-titulo">Título:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-titulo" name="input-titulo"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-titulo-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-namepage">Nombre de la Página
                                        WEB:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-namepage" name="input-namepage"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-namepage-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-date">Fecha de publicación:</label>
                                    <input onchange="manual_citation(event)" class="form-control form-control-sm"
                                        type="date" id="input-date" name="input-date">
                                    <spam id="input-date-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-date-consulta">Fecha de
                                        Consulta:</label>
                                    <input onchange="manual_citation(event)" class="form-control form-control-sm"
                                        type="date" id="input-date-consulta" name="input-date-consulta">
                                    <spam id="input-date-consulta-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-grado">Grado Académico:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-grado" name="input-grado"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-grado-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-universidad">Universidad:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-universidad" name="input-universidad"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-universidad-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-pais">País o Ciudad:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-pais" name="input-pais"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-pais-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-siglas">Siglas Entidad/Nombre del
                                        Emisor:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-siglas" name="input-siglas"
                                        placeholder="Siglas de la entidad emisora o el nombre del emisor">
                                    <spam id="input-siglas-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-repositorio">Repositorio:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-repositorio" name="input-repositorio"
                                        placeholder="Ejemplos: Repositorio UCV, Repositorio UNMSM u otros...">
                                    <spam id="input-repositorio-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-isbn">ISBN:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-isbn" name="input-isbn"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-isbn-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-volumen">Volumen:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="number" id="input-volumen" name="input-volumen"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-volumen-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-numero">Número:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="number" id="input-numero" name="input-numero"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-numero-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-paginas">Páginas:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-paginas" name="input-paginas"
                                        placeholder="Ejem. 20-32">
                                    <spam id="input-paginas-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-editorr">Editor:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-editorr" name="input-editorr"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-editorr-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-editorial">Editorial:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-editorial" name="input-editorial"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-editorial-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-edicion">Número de Edición:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="number" id="input-edicion" name="input-edicion"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-edicion-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-enlace">Enlace URL o URI:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-enlace" name="input-enlace"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-enlace-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-doi-a">Código DOI:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-doi-a" name="input-doi-a"
                                        placeholder="Escriba aquí...">
                                    <spam id="input-doi-a-error"></span>
                                </div>
                                <div class="ly-ck-dialog-group-control">
                                    <label class="ly-ck-dialog-label" for="input-issn">ISSN:</label>
                                    <input onkeyup="manual_citation(event)" class="form-control form-control-sm"
                                        type="text" id="input-issn" name="input-issn"
                                        placeholder="Escriba aquí...">
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
</div>
