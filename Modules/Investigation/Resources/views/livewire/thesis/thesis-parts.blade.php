<script>
    $(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active">{{ __('investigation::labels.thesis_parts') }}</li>
        </ol>
    </div>


    <div class="container page__container">

        <div class="card card-body mb-0">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-point-none">
                        @if (count($parts) > 0)
                        @foreach ($parts as $part)
                        <li>
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-secondary btn-sm"
                                onclick="showVideo(event)">
                                    <i class="fa fa-video"></i>
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="{{ $part['information'] }}">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                                <!--  por si las dudas lo dejo luego se borra
                                @if ($part['body'] == true)
                                <button wire:click="$emit('openModalPartEditForm',{{ $part['id'] }})" type="button"
                                    class="btn btn-secondary btn-sm">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                                @endif
                                -->
                            </div>
                           <a href="{{ route('investigation_thesis_parts',[$thesis_id, $part['id']]) }}"> {{ $part['number_order'] . ' ' . $part['description'] }}</a>

                            {!! $part['items'] !!}
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-8">

                    <div class="flex">
                        <label class="form-label" for="content">{{ $focused_part->description }}</label>
                        @if ($focused_part->body == true)
                            <div class="row">
                                <textarea wire:model="content" class="form-control" id="editor" rows="40"
                                    cols="80"></textarea>
                                @error('content')
                                <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <div class="row">
                                <button type="button" class="btn-primary btn" wire:loading.attr="disabled" wire:click="save">{{ __('labels.Save') }}</button>
                            </div>

                        @else
                            <div>
                                <h4>Esta Sección solo es un título o subtitulo sin contenido.</h4>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>





















        <div class="ventana_flotante" style="display: none" id="video-flotante">

            <div class="content">

                <div class="header">

                    <h5 class="title" id="exampleModalLabel">ITUTLASOD ASD AS/</h5>

                    <button type="button" class="close" onclick="showVideo(event)" aria-label="Close">

                        <span aria-hidden="true close-btn">×</span>

                    </button>

                </div>

                <div class="body">

                    <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                        <div class="player embed-responsive-item">
                            <div class="player__content">
                                <div class="player__image"
                                    style="--player-image: url(assets/images/illustration/player.svg)">
                                </div>
                                <a href="" class="player__play">
                                    <span class="material-icons">play_arrow</span>
                                </a>
                            </div>

                            <div class="player__embed d-none">
                                <!-- Aqui abajo va el Video -->
                                @if (false)
                                <iframe class="embed-responsive-item"
                                    src="https://player.vimeo.com/video/{{ 'VARIABLE VIDEO' }}?title=0&amp;byline=0&amp;portrait=0"
                                    allowfullscreen=""></iframe>
                                @endif
                                @if (2 > 1)
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/{{ 'b1iwTYfY0dU' }}?title=0&amp;byline=0&amp;portrait=0"
                                    allowfullscreen=""></iframe>
                                @endif
                                <!-- Aqui arriba va el Video -->
                            </div>

                        </div>
                    </div>

                </div>

                <div class="footer">

                    <button type="button" onclick="showVideo(event)" class="btn btn-secondary close-btn">{{ __('labels.Close')
                        }}</button>
                </div>

            </div>

        </div>
    </div>
    <script>
        function deletes(id) {
            cuteAlert({
                type: "question",
                title: "¿Desea eliminar estos datos?",
                message: "Advertencia:¡Esta acción no se puede deshacer!",
                confirmText: "Okay",
                cancelText: "Cancel"
            }).then((e) => {
                if (e == ("confirm")) {
                    @this.destroy(id)
                }
            });
        }
        window.addEventListener('inve-part-create', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        })

        function showVideo(e) {
            if (document.getElementById('video-flotante').style.display == 'none') {
                document.getElementById('video-flotante').style.display = 'block';
            } else {
                document.getElementById('video-flotante').style.display = 'none';
            }
        }
        /*
                document.addEventListener('livewire:load', function () {

                    $('.popover-dismiss').popover({
          trigger: 'focus'
        })

        });
        */
    </script>
</div>

<style type="text/css">
    .ventana_flotante {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #DDDDDD;
        border-radius: 9px 9px 9px 9px;
        bottom: 50px;
        left: auto;
        margin-left: -120px;
        padding: 10px 0 0;
        position: fixed;
        text-align: center;
        width: 320px;
        z-index: 15;
    }
</style>
