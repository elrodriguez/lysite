<div>
    <div class="container-section-1360p pc-screen">
        <div class="row">
            <div class="col-md-8 box-plane-login">
                <div class="row box-plane-content-login">
                    @if (count($modos) > 0)
                        @foreach ($modos as $modo)
                            <div class="col-md-4">
                                <div class="box-plane-card-login">
                                    <h2 style="text-align: center;">{{ $modo->name }}</h2>
                                    <ul>
                                        <li>{{ $modo->detail_two }}</li>
                                        <li>{{ $modo->detail_three }}</li>
                                        <li>{{ $modo->detail_four }}</li>
                                        <li>{{ $modo->detail_five }}</li>
                                    </ul>
                                    @if ($modo->price > 0)
                                        <a href="{{ route('unirme_page', $modo->id) }}"
                                            class="form-control btn btn-orange submit">Unirse</a>
                                    @else
                                        <a href="{{ route('register') }}"
                                            class="form-control btn btn-secondary submit">Registrado</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-4 box-plane-sesion">
                <div class="row box-plane-content-sesion">
                    <div class="col md-12">
                        <div class="box-plane-card-sesion">
                            <h1 class="mb-0" >Iniciar Sesión</h1>
                            <p class="mt-0" style="font-size: 22px;" >¿Usuario nuevo? 
                                <a href="{{ route('register') }}">Registrarme</a>
                            </p>
                            <br>
                            <form class="signin-form">
                                @csrf
                                <div class="form-login">
                                    <label for="email"><strong>Correo electrónico</strong></label>
                                    <input wire:model="email" id="email" type="email" name="email" required>
                                    @error('email')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-login">
                                    <label for="password"><strong>Contraseña</strong></label>
                                    <input wire:model="password" wire:keydown.enter="login" id="password" name="password"
                                        type="password" required>
                                    <span style="right: 35px;" toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if (session()->has('message'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="form-group-c btn-cent-c">
                                    <button wire:click="login" type="button"
                                        class="form-control btn btn-orange submit ">Iniciar
                                        Sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-section-1360p movil-screen">
        <div class="row">
            <div class="col-md-4 box-plane-sesion">
                <div class="row box-plane-content-sesion">
                    <div class="col md-12">
                        <div class="box-plane-card-sesion">
                            <h1 class="mb-0" >Iniciar Sesión</h1>
                            <p class="mt-0" style="font-size: 22px;" >¿Usuario nuevo? 
                                <a href="{{ route('register') }}">Registrarme</a>
                            </p>
                            <br>
                            <form class="signin-form">
                                @csrf
                                <div class="form-login">
                                    <label for="email"><strong>Correo electrónico</strong></label>
                                    <input wire:model="email" id="email" type="email" name="email" required>
                                    @error('email')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-login">
                                    <label for="password"><strong>Contraseña</strong></label>
                                    <input wire:model="password" wire:keydown.enter="login" id="password" name="password"
                                        type="password" required>
                                    <span style="right: 35px;" toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if (session()->has('message'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="form-group-c btn-cent-c">
                                    <button wire:click="login" type="button"
                                        class="form-control btn btn-orange submit ">Iniciar
                                        Sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 box-plane-login">
                <div class="row box-plane-content-login">
                    @if (count($modos) > 0)
                        @foreach ($modos as $modo)
                            <div class="col-md-4">
                                <div class="box-plane-card-login">
                                    <h2 style="text-align: center;">{{ $modo->name }}</h2>
                                    <ul>
                                        <li>{{ $modo->detail_two }}</li>
                                        <li>{{ $modo->detail_three }}</li>
                                        <li>{{ $modo->detail_four }}</li>
                                        <li>{{ $modo->detail_five }}</li>
                                    </ul>
                                    @if ($modo->price > 0)
                                        <a href="{{ route('unirme_page', $modo->id) }}"
                                            class="form-control btn btn-orange submit">Unirse</a>
                                    @else
                                        <a href="{{ route('register') }}"
                                            class="form-control btn btn-secondary submit">Registrado</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>