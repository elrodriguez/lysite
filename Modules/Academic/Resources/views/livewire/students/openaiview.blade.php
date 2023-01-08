<div style="margin-left: 30px">



    <div class="card card-default card-body">
    <form wire:submit.prevent='save'>
        <input class="form-controls" type="checkbox" wire:model="parafrasear" name="" id=""><p class="text-bold">parafrasear</p>


        <div class="form-controls">
            <label class="label-danger">Escoge el modelo de IA a usar</label><br>
            <input type="radio" name="valor" value="text-davinci-003" wire:model="modelo"> Da Vinci ++++
            <input type="radio" name="valor" value="text-curie-001" wire:model="modelo"> Curie +++
            <input type="radio" name="valor" value="text-babbage-001" wire:model="modelo"> Babbage ++
            <input type="radio" name="valor" value="text-ada-001" wire:model="modelo"> Ada +
        </div>


        <textarea class="input text-primary text-justify form-controls" style="height: 150px" type="text" name="frase_text" id="frase_text" wire:model="frase_text" cols="30" rows="30" height="250px"></textarea>

        <button class="button-large flex-center" type="submit" wire:loading.attr="disabled" wire:target="save" wire:click.prevent="save" >Consultar</button>

    </form>
    <p><h1>{{ $result_text }}</h1></p><br>
    <hr>
    <label class="alert-success">Tokens Consumidos en la consulta</label>
    <p>{{ $query_tokens }}</p><br><hr>

    <label class="alert-success">Tokens Consumidos en la respuesta actual</label>
    <p>{{ $result_tokens }}</p><br><hr>

    <label class="alert-success">Suma Total de Tokens Consumidos en esta oportunidad</label>
    <p>{{ $consumed_tokens }}</p><br><hr>
    </div>

    <p>Modelo usado: {{ $modelo }}</p>
    </div>
