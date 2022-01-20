<div class="nav-item dropdown dropdown-notifications dropdown-menu-sm-full">
    <button id="user-list-chat" class="nav-link btn-flush dropdown-toggle " type="button" data-toggle="dropdown" data-dropdown-disable-document-scroll data-caret="false">
        <i class="material-icons ">group</i>

    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <div data-perfect-scrollbar class="position-relative">
            <div class="dropdown-header"><strong>Contactos</strong></div>
            <div class="list-group list-group-flush mb-0">
                @foreach($instructors as $instructor)
                    <a wire:click="$emit('showChatInstructor',{{ $instructor->id }})" href="javascript:void(0);" class="list-group-item list-group-item-action unread ">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-black-50">{{ $instructor->is_online ? 'En línea' : 'Desconectado' }}</small>
                            @if($instructor->is_online)
                            <span class="ml-auto unread-indicator bg-success"></span>
                            @endif
                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                @if($instructor->avatar)
                                <img src="{{ url('storage/'.$instructor->avatar) }}" alt="people" class="avatar-img rounded-circle" width="26px">
                                @else
                                <img src="{{ ui_avatars_url($instructor->full_name,26,'none') }}" alt="people" class="avatar-img rounded-circle">
                                @endif
                            </span>
                            <span id="user{{ $instructor->id }}" class="flex d-flex flex-column ">
                                <strong>{{ $instructor->full_name }}</strong>
                                <span class="text-black-70">{{ $instructor->email }}</span>
                            </span>
                        </span>
                    </a>
                @endforeach
                @foreach($students as $student)
                    <a wire:click="$emit('showChatStudent',{{ $student->id }})" href="javascript:void(0);" class="list-group-item list-group-item-action unread ">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-black-50">{{ $student->is_online ? 'En línea' : 'Desconectado' }}</small>
                            @if($student->is_online)
                            <span class="ml-auto unread-indicator bg-success"></span>
                            @endif
                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                @if($student->avatar)
                                <img src="{{ url('storage/'.$student->avatar) }}" alt="people" class="avatar-img rounded-circle" width="26px">
                                @else
                                <img src="{{ ui_avatars_url($student->full_name,26,'none') }}" alt="people" class="avatar-img rounded-circle">
                                @endif
                            </span>
                            <span id="user{{ $student->id }}" class="flex d-flex flex-column ">
                                <strong>{{ $student->full_name }}</strong>
                                <span class="text-black-70">{{ $student->email }}</span>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
