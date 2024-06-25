<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME', 'Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('setting_suscripcion_usuarios') }}">Suscribir Usuarios</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </div>
    <div class="container page__container" wire.ignore>
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <!-- Search -->
                    <div class="search-form search-form--light mb-3">
                        <input wire:keydown.enter="getSearch" wire:model.defer="search" type="text"
                            class="form-control search" placeholder="Search">
                        <button class="btn" type="button" role="button"><i
                                class="material-icons">search</i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Formulario de registro</h4>
                        <p class="text-70">todos los campos que tienen * son obligatorios para el registro</p>
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Usuario</th>
                                    <th>Tipo de Suscripción</th>
                                    <th class="text-center">Suscribir</th>
                                </tr>
                            </thead>
                            <tbody class="list" wire:ignore.self>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                                        <td class="name align-middle" title="{{ $user->names }}">{{ $user->full_name }}
                                        </td>
                                        <td class="name align-middle">
                                            <select name="type_subscription_id">
                                                <option value="">SELECCIONAR</option>
                                                @foreach ($type_subscriptions as $type_sub)
                                                    <option wire:click="changeSubcription({{ $type_sub->id }})"
                                                        value="{{ $type_sub->id }}">
                                                        {{ $type_sub->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="name align-middle">
                                            <button id="btn-{{ $key }}" type="button"
                                                wire:click="subscribingUser({{ $user->user_id }})">
                                                Suscribir
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="3">
                                        <div class="d-flex flex-row-reverse">
                                            {{ $users->links() }}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
</div>
