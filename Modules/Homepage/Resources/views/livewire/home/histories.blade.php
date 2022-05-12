<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active">{{ __('labels.Histories') }}</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Listado</h4>
                        <p class="text-70">{{ __('labels.Success Histories') }}</p>
                        @can('configuraciones_modulos_nuevo')
                            <a href="{{ route('academic_courses_create') }}" type="button"
                                class="btn btn-primary">Nuevo</a>
                        @endcan
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <!-- Wrapper -->
                        <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                            <!-- Search -->
                            <div class="search-form search-form--light mb-3">
                                <input wire:keydown.enter="getSearch" wire:model.defer="search" type="text"
                                    class="form-control search" placeholder="Search" value="">
                                <button class="btn" type="button" role="button"><i
                                        class="material-icons">search</i></button>
                            </div>
                            <!-- Table -->
                            <table class="table">
                                <tbody class="">










                                    <div class="row">
                                    @foreach ($histories as $key => $history)

                                            <div class="col-sm-6 col-md-4 col-lg-4">

                                                <div class="card card--elevated card-course overlay js-overlay mdk-reveal js-mdk-reveal "
                                                    data-partial-height="40" data-toggle="popover" data-trigger="click">


                                                    <a href="course.html" class="js-image" data-position="center">
                                                        <img src="{{ env('APP_URL') }}/{{ $history->image_path }}" alt="course" height="150">
                                                        <span class="overlay__content">
                                                            <span
                                                                class="overlay__action d-flex flex-column text-center">
                                                                <i class="material-icons">play_circle_outline</i>
                                                                <small>Preview course</small>
                                                            </span>
                                                        </span>
                                                    </a>

                                                    <span
                                                        class="corner-ribbon corner-ribbon--default-right-top corner-ribbon--shadow bg-accent text-white">{{ $history->university }}</span>

                                                    <div class="mdk-reveal__content">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="flex">
                                                                    <a class="card-title" href="course.html">{{$history->title}}</a>
                                                                    <small
                                                                        class="text-50 font-weight-bold mb-4pt">{{ __('labels.Institution') }}: {{ $history->university }}</small>
                                                                </div>

                                                            </div>
                                                            <div class="d-flex">
                                                                <small class="text-50">{{ $history->year }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="popoverContainer d-none">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img src="{{ env('APP_URL') }}/{{ $history->image_path }}"
                                                                width="40" height="40" alt="Image"
                                                                class="rounded">
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="card-title mb-0">{{ $history->title }}
                                                            </div>
                                                            <p class="lh-1 mb-0">
                                                                <span class="text-black-50 small">{{ __('labels.Author') }}</span>
                                                                <span
                                                                    class="text-black-50 small font-weight-bold">{{$history->author}}</span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <p class="my-16pt text-black-70">{{$history->thesis_title}}</p>

                                                    <div class="mb-16pt">
                                                        @livewire('homepage::home.details', ['history_id' => $history->id])
                                                    </div>

                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="d-flex align-items-center mb-4pt">
                                                                <span
                                                                    class="material-icons icon-16pt text-black-50 mr-4pt"><i class="fa fa-calendar-alt"></i></span>
                                                                <p class="flex text-black-50 lh-1 mb-0"><small>{{ $history->month }} {{ $history->year }}</small></p>
                                                            </div>

                                                            <div class="d-flex align-items-center">
                                                                <span
                                                                    class="material-icons icon-16pt text-black-50 mr-4pt"><i class="fa fa-user-graduate"></i></span>
                                                                <p class="flex text-black-50 lh-1 mb-0">
                                                                    <small>{{ $history->career }}</small></p>
                                                            </div>

                                                            <div class="d-flex align-items-center">
                                                                <span
                                                                    class="material-icons icon-16pt text-black-50 mr-4pt"><i class="fa fa-university"></i></span>
                                                                <p class="flex text-black-50 lh-1 mb-0">
                                                                    <small>{{ $history->university }}</small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col text-right">
                                                            <a href="course.html" class="btn btn-primary">{{__('labels.Edit')}}</a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                    @endforeach











                                </div>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="3">
                                            <div class="d-flex flex-row-reverse">
                                                  {{ $histories->links() }}
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
        window.addEventListener('aca-course-delete', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        })
    </script>
</div>
