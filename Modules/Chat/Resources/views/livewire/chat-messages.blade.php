<div>
    @if(count($chats) > 0)
        @php
            $i = 0;
        @endphp
        @foreach($chats as $k => $chat)
        <div class="ui-widget ui-chatbox" outline="0" style="width: 228px; right: {{ $i == 0 ? '0' : (228*$i)+(7*$i) }}px; display: block;">
            <div class="ui-widget-header ui-chatbox-titlebar online ui-dialog-header">
                <span>
                    <i title="online"></i>{{ $chat['name'] }}
                </span>
                <a wire:click="closeChat('{{ $k }}')" href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title="Hide" class="ui-chatbox-icon" role="button">
                    <i class="fa fa-times"></i>
                </a>
                @if($chat['display'] == 'block')
                    <a wire:click="minimizeChat('{{ $k }}')" href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title="Minimize" class="ui-chatbox-icon" role="button">
                        <i class="fa fa-minus"></i>
                    </a>
                @elseif($chat['display'] == 'none')
                    <a wire:click="maximizeChat('{{ $k }}')" href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title="Minimize" class="ui-chatbox-icon" role="button">
                        <i class="fa fa-window-maximize"></i>
                    </a>
                @endif
            </div>
            <div class="false ui-widget-content ui-chatbox-content" style="display: {{ $chat['display'] }};">
                <span class="alert-msg">null</span>
                <div id="cha{{ $k }}" class="ui-widget-content ui-chatbox-log custom-scroll2">
                    @foreach($chat['messages'] as $msg)
                    <div class="ui-chatbox-msg" style="max-width: 208px;"><b>{{ $msg['user_id'] == auth()->user()->id ? 'YO' : 'DICE' }}: </b><span>{{ $msg['message'] }}</span></div>
                    @endforeach
                </div>
                <div class="ui-widget-content ui-chatbox-input">
                    <textarea 
                        id="message{{ $k }}"
                        onkeyup="textareaWithoutEnter(event.keyCode, this.id,'{{ $k }}');" 
                        wire:model.defer="chats.{{ $k }}.message" 
                        class="ui-widget-content ui-chatbox-input-box" 
                        style="width: 218px;"></textarea>
                </div>
            </div>
        </div>
        @php
            $i++;
        @endphp
        @endforeach
    @endif
    <script>
        window.addEventListener('scroll-button', event => {
            let index = event.detail.index;
            $('#cha'+index).animate({ scrollTop: $('#cha'+index)[0].scrollHeight}, 10);
        });
        /* Suprimir el uso de la tecla ENTER en Textarea 
        Autor: John Sánchez Alvarez 
        Este código es libre de usar y modificarse*/ 

        //Me permite remplazar valores dentro de una cadena
        function str_replace($cambia_esto, $por_esto, $cadena) {
            return $cadena.split($cambia_esto).join($por_esto);
        }

        //Valida que no sean ingresado ENTER dentro del textarea
        function textareaWithoutEnter($char, $id, $index){

            $textarea = document.getElementById($id);
        
            if($char == 13){
                $texto_escapado = escape($textarea.value);
                if(navigator.appName == "Opera" || navigator.appName == "Microsoft Internet Explorer") $texto_sin_enter = str_replace("%0D%0A", "", $texto_escapado); 
                else $texto_sin_enter = str_replace("%0A", "", $texto_escapado);
                
                $textarea.value = unescape($texto_sin_enter); 
                @this.sendMessage($index);
                $("#cha"+$index).animate({ scrollTop: $('#cha'+$index)[0].scrollHeight}, 1000);
            }
        }
    </script>
</div>
