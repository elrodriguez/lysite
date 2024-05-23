<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME', 'Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('setting_subscriptions') }}">Modos de Suscripción</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Formulario de registro</h4>
                        <p class="text-70">todos los campos que tienen * son obligatorios para el registro</p>
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <form wire:submit.prevent="save" class="flex">
                            <div class="form-group">
                                <label class="form-label" for="name">Nombre *</label>
                                <input wire:model="name" type="text" class="form-control" id="name"
                                    placeholder="Nombre ..">
                                @error('name')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="price">Precio *</label>
                                <input wire:model="price" type="text" class="form-control" id="price"
                                    placeholder="price ..">
                                @error('price')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_one">Forma de pago *</label>
                                <input wire:model="detail_one" type="text" class="form-control" id="detail_one"
                                    placeholder="Forma de pago ..">
                                @error('detail_one')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_two">Detalle uno *</label>
                                <input wire:model="detail_two" type="text" class="form-control" id="detail_two"
                                    placeholder="Detalle uno ..">
                                @error('detail_two')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_three">Detalle dos *</label>
                                <input wire:model="detail_three" type="text" class="form-control" id="detail_three"
                                    placeholder="Detalle dos ..">
                                @error('detail_three')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_four">Detalle tres *</label>
                                <input wire:model="detail_four" type="text" class="form-control" id="detail_four"
                                    placeholder="Detalle tres ..">
                                @error('detail_four')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_five">Detalle cuatro *</label>
                                <input wire:model="detail_five" type="text" class="form-control" id="detail_five"
                                    placeholder="Detalle cuatro ..">
                                @error('detail_five')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_six">Detalle Cinco </label>
                                <input wire:model="detail_six" type="text" class="form-control" id="detail_six"
                                    placeholder="Detalle Cinco ..">
                                @error('detail_six')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="detail_seven">Detalle seis </label>
                                <input wire:model="detail_seven" type="text" class="form-control" id="detail_seven"
                                    placeholder="Detalle seis ..">
                                @error('detail_seven')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('set-subscription-modes-create', event => {
            cuteAlert({
                type: "success",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        })
    </script>
</div>
