<div class="card ">
    <h5>Registrarme</h5>
    <p>¿Ya estás registrado? <a href="{{ route('ly-login') }}">Iniciar sesión </a></p>
    <form wire:submit.prevent="save" class="signin-form">
        <div class="form-login">
            <label for="email"><strong>Correo electrónico</strong></label>
            <input wire:model="email" id="email" type="email" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-login">
            <label for="password"><strong>Contraseña</strong></label>
            <input wire:model="password" id="password" type="password" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-select ">
            <label><strong>&nbsp;País:</strong></label>
            <select wire:model="country_id" name="pais" id="" style="padding-top: 5px;">
                @if (count($countries) > 0)
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->description }}</option>
                    @endforeach
                @endif
            </select>
            @error('country_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group btn-cent">
            <button type="submit" class="form-control btn btn-primary submit ">Registrarme</button>
        </div>
    </form>
</div>
