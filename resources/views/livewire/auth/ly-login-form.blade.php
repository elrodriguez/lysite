<div class="container-section-1440p">
    <div class="pc-screen">
        <div class="row">
            <div class="col-md-9 box-plane-login">
                <div class="row box-plane-content-login">
                    @if (count($modos) > 0)
                        @foreach ($modos as $modo)
                            <div class="col-md-3">
                                <div class="box-plane-card-login">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="mb-0" style="text-align: center;">
                                                {{ $modo->name }}
                                            </h2>
                                            <p class="mt-0 mb-0  text-center"
                                                style="color: #000; font-size: 21px;">
                                                <strong>S/ {{ $modo->price ?? 'GRATIS' }}</strong>
                                                <strong>ó</strong>
                                            </p>
                                            <p class="mt-0 mb-0  text-center"
                                                style="color: #000; font-size: 18px;">
                                                <strong>$USD {{ $modo->dollar_price ?? 'GRATIS' }}</strong>
                                            </p>
                                            <p class="mt-0 mb-0 text-center"
                                                style="color: #ff9152; font-size: 18px;">
                                                <strong>/{{ $modo->detail_one }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul style="height: 220px; font-size: 15px; text-align:left;">
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
                                </div>
                            </div>
                            <!--
                            <div class="col-md-3">
                                <div class="box-plane-card-login">
                                    <h2 style="text-align: center;">{{ $modo->name }}</h2>
                                    <h3 style="text-align: center;">S/ {{ $modo->price }}</h3>
                                    <h3 style="text-align: center;">$USD {{ $modo->dollar_price }}</h3>
                                    <ul style="height: 220px;">
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
                            -->
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-3 box-plane-sesion">
                <div class="row box-plane-content-sesion">
                    <div class="col md-12">
                        <div class="box-plane-card-sesion">
                            <h1 class="mb-0" style="text-align:center;">Iniciar Sesión</h1>
                            <p class="mt-0" style="font-size: 18px; text-align:center;">¿Usuario nuevo?
                                <a href="{{ route('register') }}" style="color: #0059ff;">Registrarme</a>
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
                                    <input wire:model="password" wire:keydown.enter="login" id="password"
                                        name="password" type="password" required>
                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                    <span style="right: 10px;" toggle="#password"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
    <div class="movil-screen">
        <div class="row">
            <div class="col-md-4 box-plane-sesion">
                <div class="row box-plane-content-sesion">
                    <div class="col md-12">
                        <div class="box-plane-card-sesion">
                            <h1 class="mb-0">Iniciar Sesión</h1>
                            <p class="mt-0" style="font-size: 22px;">¿Usuario nuevo?
                                <a href="{{ route('register') }}" style="color: #0059ff;">Registrarme</a>
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
                                    <input wire:model="password" wire:keydown.enter="login" id="password"
                                        name="password" type="password" required>
                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                    <span style="right: 35px;" toggle="#password"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
