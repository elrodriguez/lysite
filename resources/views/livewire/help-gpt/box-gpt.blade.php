<div class="gpt-container" style="margin-top: 20px">
    <h3 class="text-center">AYUDA</h3>
    <div class="gpt-messaging">
        <div class="gpt-inbox_msg">
            <div class="gpt-inbox_people">
                <div class="gpt-headind_srch">
                    <div class="gpt-recent_heading">
                        <h4>GPT</h4>
                    </div>
                    <div class="gpt-srch_bar">
                        {{-- <div class="gpt-stylish-input-group">
                            <input type="text" class="gpt-search-bar" placeholder="Search">
                            <span class="gpt-input-group-addon">
                                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                            </span>
                        </div> --}}
                    </div>
                </div>
                <div class="gpt-inbox_chat">
                    <div class="gpt-chat_list" wire:click="setBtnActive(1)">
                        <div class="gpt-chat_people">
                            <div class="gpt-chat_img">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="37" height="32"
                                    viewBox="0 0 37 32">
                                    <path fill="#fd6a00"
                                        d="M21.042 28.559l-0.38-0.308 0.284-1.155c0.156-0.635 0.401-1.569 0.543-2.075l0.259-0.919 3.366-3.385c3.962-3.985 3.312-3.792 5.467-1.629l1.751 1.757-7.039 7.039-1.912 0.488c-1.051 0.268-1.922 0.489-1.935 0.491s-0.194-0.135-0.403-0.304zM4.775 25.352c-0.262-0.079-0.734-0.317-1.048-0.529l-0.571-0.386-0.83-1.654v-14.58l0.825-1.656 0.697-0.452c1.012-0.656 0.97-0.654 14.136-0.599l12.064 0.050 0.723 0.508c0.398 0.28 0.892 0.806 1.098 1.17l0.375 0.662 0.005 4.237-0.599 0.198c-0.33 0.109-0.856 0.423-1.17 0.699l-0.571 0.501v-4.905l-0.346-0.647h-24.377l-0.52 0.743v13.56l0.52 0.743h15.189l-0.244 0.543c-0.134 0.299-0.324 0.863-0.422 1.254l-0.178 0.71-7.14-0.014c-3.927-0.008-7.355-0.079-7.617-0.157zM31.694 17.694l-1.805-1.811 2.015-1.866 1.015-0.223 1.14 0.376 1.536 1.642v1.711l-0.945 0.991c-1.164 1.221-0.828 1.314-2.956-0.82zM8.013 18.622c-0.228-0.116-0.486-0.412-0.573-0.66l-0.158-0.449 0.195-0.428c0.107-0.235 0.389-0.502 0.626-0.592l0.431-0.164h11.034l0.365 0.192c0.878 0.462 0.878 1.661 0 2.123l-0.365 0.192-11.139-0.005zM8.013 13.606c-0.228-0.116-0.486-0.412-0.573-0.659l-0.158-0.449 0.195-0.428c0.107-0.235 0.389-0.502 0.626-0.592l0.431-0.164h16.049l0.365 0.192c0.49 0.258 0.611 0.467 0.611 1.062s-0.12 0.803-0.611 1.062l-0.365 0.192-16.154-0.005z">
                                    </path>
                                </svg>

                            </div>
                            <div class="gpt-chat_ib">
                                <h5>PARAFRASEAR </h5>
                                <p>Cambia texto utilizando palabras diferentes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="gpt-chat_list" wire:click="setBtnActive(2)">
                        <div class="gpt-chat_people">
                            <div class="gpt-chat_img">
                                <svg class="gpt-img" id="Layer_1" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" data-name="Layer 1">
                                    <path
                                        d="m8 8v-2h8v2zm-3 14a1 1 0 0 1 -1-1v-18a1 1 0 0 1 1-1h15v9.5a6.513 6.513 0 0 1 2 1.32v-12.82h-17a3 3 0 0 0 -3 3v18a3 3 0 0 0 3 3h12.5a6.475 6.475 0 0 1 -4.679-2zm17.543 1.957-2.657-2.657a4.457 4.457 0 0 1 -2.386.7 4.5 4.5 0 1 1 4.5-4.5 4.457 4.457 0 0 1 -.7 2.386l2.657 2.657zm-5.043-3.957a2.5 2.5 0 1 0 -2.5-2.5 2.5 2.5 0 0 0 2.5 2.5z" />
                                </svg>
                            </div>
                            <div class="gpt-chat_ib">
                                <h5>Recomendación de Artículos</h5>
                                <p>Te recomienda articulos científicos</p>
                            </div>
                        </div>
                    </div>
                    <div class="gpt-chat_list" wire:click="setBtnActive(3)">
                        <div class="gpt-chat_people">
                            <div class="gpt-chat_img">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="gpt-img"
                                    viewBox="0 0 37 32">
                                    <path fill="#fd6a00"
                                        d="M6.937 29.405c-0.249-0.137-0.552-0.487-0.673-0.779l-0.22-0.531 0.117-1.036c0.412-3.643 3.384-6.994 6.699-7.554l0.716-0.121 0.293 0.266c0.161 0.146 0.799 1.287 1.416 2.535 1.336 2.7 1.257 2.668 1.744 0.699l0.388-1.57-0.542-0.872c-0.298-0.48-0.542-1.060-0.542-1.289v-0.416l0.336-0.18c0.185-0.099 0.888-0.18 1.563-0.18h1.227l0.347 0.347c0.442 0.442 0.445 0.419-0.244 1.621l-0.581 1.013 0.341 1.33c0.187 0.731 0.404 1.443 0.482 1.582l0.141 0.252 2.476-4.943 0.282-0.108c0.376-0.144 1.655 0.202 2.834 0.767l0.955 0.458 2.459 2.458 0.457 0.974c0.582 1.24 0.808 2.226 0.813 3.553l0.004 1.055-0.896 0.842-21.939 0.077zM14.673 26.668c-0.067-0.215-0.582-1.313-1.146-2.439l-1.024-2.048-0.702 0.395c-1.347 0.757-2.714 2.536-3.013 3.919l-0.122 0.564h6.129zM27.588 26.408c-0.477-1.738-2.456-4.037-3.474-4.037h-0.232l-2.337 4.688h6.222zM16.594 16.41c-5.213-1.331-7.142-8.155-3.462-12.248l0.749-0.833 2.022-1.078 2.277-0.42 1.111 0.196c2.283 0.402 4.17 1.797 5.14 3.8l0.485 1.001 0.133 4.168-0.352 1.002c-0.928 2.64-3.198 4.343-6.061 4.548l-1.174 0.084zM19.98 13.674c0.972-0.44 1.663-1.084 2.123-1.978l0.354-0.689 0.086-1.073c0.103-1.285-0.078-2.665-0.361-2.759-0.113-0.037-0.533-0.152-0.935-0.255s-0.97-0.389-1.264-0.636l-0.534-0.449-1.684 1.575-0.921 0.274c-0.507 0.15-1.37 0.274-1.918 0.274h-0.997l-0.116 0.528c-0.176 0.799 0.064 2.232 0.539 3.232l0.426 0.894 0.604 0.461c0.838 0.639 1.739 0.937 2.86 0.947l0.955 0.008z">
                                    </path>
                                </svg>
                            </div>
                            <div class="gpt-chat_ib">
                                <h5>Corrección de gramática</h5>
                                <p>Revisar y corregir errores gramaticales.</p>
                            </div>
                        </div>
                    </div>
                    <div class="gpt-chat_list" wire:click="setBtnActive(4)">
                        <div class="gpt-chat_people">
                            <div class="gpt-chat_img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="gpt-img"
                                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path
                                        d="M320 0c17.7 0 32 14.3 32 32V96H472c39.8 0 72 32.2 72 72V440c0 39.8-32.2 72-72 72H168c-39.8 0-72-32.2-72-72V168c0-39.8 32.2-72 72-72H288V32c0-17.7 14.3-32 32-32zM208 384c-8.8 0-16 7.2-16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H208zm96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H304zm96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H400zM264 256a40 40 0 1 0 -80 0 40 40 0 1 0 80 0zm152 40a40 40 0 1 0 0-80 40 40 0 1 0 0 80zM48 224H64V416H48c-26.5 0-48-21.5-48-48V272c0-26.5 21.5-48 48-48zm544 0c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H576V224h16z" />
                                </svg>
                            </div>
                            <div class="gpt-chat_ib">
                                <h5>Asistente <span class="chat_date">Nuevo</span></h5>
                                <p>Sube un archivo y haz tus consultas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="gpt-chat_list" wire:click="setBtnActive(5)">
                        <div class="gpt-chat_people">
                            <div class="gpt-chat_img">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="gpt-img"
                                    viewBox="0 0 37 32">
                                    <path fill="#fd6a00"
                                        d="M17.725 26.904c-0.613-0.137-1.596-0.506-2.186-0.82l-1.072-0.571-0.818-0.874c-0.45-0.481-1.061-1.394-1.359-2.030l-0.541-1.156-0.384-2.482 0.226-1.266c0.124-0.696 0.463-1.74 0.753-2.319l0.527-1.054 1.056-0.977c2.184-2.022 4.967-2.773 5.897-1.592l0.354 0.451v1.333l-0.718 0.913-0.789 0.168c-0.434 0.093-1.163 0.387-1.619 0.655l-0.83 0.486-0.511 0.806c-0.281 0.443-0.59 1.18-0.687 1.637l-0.177 0.831 0.164 0.87c0.292 1.546 1.379 2.832 2.879 3.405l0.784 0.3 11.061-0.109 0.82-0.482c1.872-1.1 2.716-3.281 2.086-5.391l-0.219-0.735-1.794-1.841-0.804-0.212c-0.442-0.117-1.061-0.322-1.375-0.456l-0.571-0.244-0.411-1.371 0.536-1.283 1.296-0.428 2.458 0.747 2.258 1.517 0.674 0.893c0.371 0.491 0.853 1.335 1.072 1.875l0.397 0.982 0.006 4.108-0.57 1.203c-1.035 2.185-2.416 3.466-4.61 4.276l-1.072 0.395-11.074 0.095zM6.908 21.62c-1.237-0.303-2.627-1.082-3.697-2.072l-1.056-0.977-0.527-1.054c-0.29-0.58-0.628-1.623-0.753-2.319l-0.226-1.266 0.384-2.482 1.082-2.312 1.679-1.795 2.427-1.214 2.503-0.422 10.471 0.14 1.072 0.395c2.186 0.805 3.585 2.099 4.588 4.244l0.548 1.172 0.182 3.198-0.628 2.322-0.669 1.034c-1.079 1.669-2.681 2.788-4.771 3.333l-1.028 0.268-1.176-0.388-0.265-0.512c-0.334-0.645-0.335-1.126-0.005-1.764l0.259-0.502 0.5-0.184c0.275-0.101 0.846-0.278 1.27-0.393l0.77-0.209 0.716-0.647c0.908-0.82 1.409-1.8 1.532-2.998l0.097-0.941-0.279-0.818c-0.38-1.114-1.092-2-2.073-2.577l-0.82-0.482-11.061-0.109-0.784 0.3c-1.5 0.573-2.587 1.859-2.879 3.405l-0.164 0.87 0.177 0.831c0.097 0.457 0.406 1.193 0.687 1.637l0.511 0.806 0.83 0.486c0.457 0.268 1.185 0.562 1.619 0.655l0.789 0.168 0.718 0.913v1.361l-0.804 0.913-0.536 0.078c-0.295 0.043-0.841 0.003-1.215-0.089z">
                                    </path>
                                </svg>

                            </div>
                            <div class="gpt-chat_ib">
                                <h5>Referencias</h5>
                                <p>Citar o fundamentar el trabajo de investigación.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gpt-mesgs">
                @if ($typeAction == 1)
                    <div class="form-group p-2">
                        <select wire:model="prompt" class="form-control" name="prompt">
                            <option value="0">Como Docente</option>
                            <option value="1">Como Investigador</option>
                            <option value="2">Disminuir Similitud</option>
                        </select>
                        <label for="consulta" class="mt-2">Escribe aquí lo que desee parafrasear</label>
                        <textarea wire:model="consulta" class="form-control mb-2" id="consulta" rows="6"></textarea>
                        <button wire:click="saveMessageUser" wire:loading.attr="disabled" type="button"
                            class="btn btn-secondary btn-sm">
                            <div wire:loading wire:target="saveMessageUser" style="display: none"
                                class="spinner-grow spinner-grow-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                            Procesar
                        </button>
                    </div>
                    <div class="p-2">
                        <textarea wire:model="resultado" class="form-control" id="resultado" rows="6"></textarea>
                    </div>
                @else
                    <div class="gpt-msg_history">
                        @if ($history)
                            @if (count($historyItems) > 0)
                                @foreach ($historyItems as $item)
                                    @if ($item->my_user)
                                        <div class="gpt-outgoing_msg">
                                            <div class="gpt-sent_msg">
                                                <p>{{ $item->content }}</p>
                                                <span
                                                    class="gpt-time_date">{{ $this->formatDateBox($item->created_at) }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="gpt-incoming_msg">
                                            <div class="gpt-incoming_msg_img">
                                                <img class="gpt-img"
                                                    src="https://ptetutorials.com/images/user-profile.png"
                                                    alt="sunil">
                                            </div>
                                            <div class="gpt-received_msg">
                                                <div class="gpt-received_withd_msg">
                                                    <p>{{ $item->content }}</p>
                                                    <span
                                                        class="gpt-time_date">{{ $this->formatDateBox($item->created_at) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="gpt-type_msg">
                        <div class="gpt-input_msg_write">
                            <textarea wire:model="message" class="gpt-write_msg" placeholder="Type a message"></textarea>
                            <button wire:click="saveMessageUser" class="gpt-msg_send_btn" type="button">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
