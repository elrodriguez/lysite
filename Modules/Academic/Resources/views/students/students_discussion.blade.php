<x-master>
    <style>
        [dir=ltr] .bg-orange{
          background: #ff9152;
        }
    </style>
    <x-slot name="jumbotron">
        <div class="border-bottom-white py-32pt bg-orange" >
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="{{ url('assets/images/illustration/student/128/white.svg') }}" width="104" class="mr-md-32pt mb-32pt mb-md-0" alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h2 class="text-white mb-0">{{ auth()->user()->name }}</h2>
                    <p class="lead text-white-50 d-flex align-items-center">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('user_edit_account') }}" class="btn btn-outline-white">Editar cuenta</a>
            </div>
        </div>
    </x-slot>
    <div class="navbar navbar-expand-sm navbar-dark-white p-sm-0 bg-orange ">
        <div class="container page__container">
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse" data-target="#navbar-submenu2">
                <i class="fa fa-bars"></i>
            </button>
            @livewire('nav.nav-global')
        </div>
    </div>
    @livewire('academic::students.students-discussion',[$course_id, $section_id, $content_id,$question_id])
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
</x-master>
