<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary">
            <div class="py-32pt">
                <div class="container">
                    <h1 class="text-white mb-8pt">Modulos</h1>
                    <span class="text-white">Editar</span>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="navbar navbar-expand-sm navbar-dark-white bg-gradient-primary p-sm-0 ">
        <div class="container page__container">
            <!-- Navbar toggler -->
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse" data-target="#navbar-submenu2">
                <span class="material-icons">people_outline</span>
            </button>
            @livewire('nav.nav-admin')
        </div>
    </div>
    @livewire('setting::modules.modules-edit',['module_id' => $id])
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>