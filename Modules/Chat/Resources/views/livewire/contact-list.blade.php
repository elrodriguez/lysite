<div class="nav-item dropdown dropdown-notifications dropdown-menu-sm-full">
    <button id="user-list-chat" class="nav-link btn-flush dropdown-toggle " type="button" data-toggle="dropdown"
        data-dropdown-disable-document-scroll data-caret="false">
        <i class="material-icons ">group</i>
    </button>

    @if(!$is_instructor)

    <div class="dropdown-menu dropdown-menu-right">
        <div data-perfect-scrollbar class="position-relative">
            <div class="dropdown-header"><strong>Contactos</strong></div>
            <div class="list-group list-group-flush mb-0">
                @if(count($instructors) > 0)
                @foreach($instructors as $instructor)
                <a wire:click="$emit('showChatInstructor',{{ $instructor->id }})" href="javascript:void(0);"
                    class="list-group-item list-group-item-action unread ">
                    <span class="d-flex align-items-center mb-1">
                        <small class="text-black-50">{{ $instructor->is_online ? 'En línea' : 'Desconectado' }}</small>
                        @if($instructor->is_online)
                        <span class="ml-auto unread-indicator bg-success"></span>
                        @endif
                    </span>
                    <span class="d-flex">
                        <span class="avatar avatar-xs mr-2">
                            @if($instructor->avatar)
                            <img src="{{ url('storage/'.$instructor->avatar) }}" alt="people"
                                class="avatar-img rounded-circle" width="26px">
                            @else
                            <img src="{{ ui_avatars_url($instructor->full_name,26,'none') }}" alt="people"
                                class="avatar-img rounded-circle">
                            @endif
                        </span>
                        <span id="user{{ $instructor->id }}" class="flex d-flex flex-column ">
                            <strong>{{ $instructor->full_name }}</strong>
                            <span class="text-black-70">{{ $instructor->email }}</span>
                        </span>
                    </span>
                </a>
                @endforeach
                @endif
                @if(count($students) > 0)
                @foreach($students as $student)
                <a wire:click="$emit('showChatStudent',{{ $student->id }})" href="javascript:void(0);"
                    class="list-group-item list-group-item-action unread ">
                    <span class="d-flex align-items-center mb-1">
                        <small class="text-black-50">{{ $student->is_online ? 'En línea' : 'Desconectado' }}</small>
                        @if($student->is_online)
                        <span class="ml-auto unread-indicator bg-success"></span>
                        @endif
                    </span>
                    <span class="d-flex">
                        <span class="avatar avatar-xs mr-2">
                            @if($student->avatar)
                            <img src="{{ url('storage/'.$student->avatar) }}" alt="people"
                                class="avatar-img rounded-circle" width="26px">
                            @else
                            <img src="{{ ui_avatars_url($student->full_name,26,'none') }}" alt="people"
                                class="avatar-img rounded-circle">
                            @endif
                        </span>
                        <span id="user{{ $student->id }}" class="flex d-flex flex-column ">
                            <strong>{{ $student->full_name }}</strong>
                            <span class="text-black-70">{{ $student->email }}</span>
                        </span>
                    </span>
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @else

    <!-- ----------------------------------------------------------------------------------------------------------------------------------------------
    --------------------------------------------------------------------------- INSTRUCTORES -------------------------------------------------------- !-->

    <div class="dropdown-menu dropdown-menu-right" style="width:650px">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card chat-app overflow-auto">
                        <div id="plist" class="people-list overflow-auto">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <ul class="list-unstyled chat-list mt-2 mb-0">
                                @if(count($instructors) > 0)
                                @foreach($instructors as $instructor)

                                <li class="clearfix">
                                    <a wire:click="$emit('showChatInstructor',{{ $instructor->id }})" href="javascript:void(0);">
                                    @if($instructor->avatar)
                                    <img src="{{ url('storage/'.$instructor->avatar) }}" alt="avatar">
                                    @else
                                    <img src="{{ ui_avatars_url($instructor->full_name,26,'none') }}" alt="avatar">
                                    @endif
                                    <div class="about">
                                        <div class="name">Instructor: {{ $instructor->full_name }}</div>
                                        @if ($instructor->is_online)
                                        <div class="status"> <i class="fa fa-circle online"></i> {{
                                            $instructor->chat_last_activity }}</div>
                                        @else
                                        <div class="status"> <i class="fa fa-circle offline"></i> {{
                                            $instructor->chat_last_activity }}</div>
                                        @endif
                                    </div>
                                </a>
                                </li>

                                @endforeach
                                @endif

                                @if(count($students) > 0)
                                @foreach($students as $student)

                                <li class="clearfix">
                                    <a wire:click="$emit('showChatStudent',{{ $student->id }})" href="javascript:void(0);">
                                    @if($student->avatar)
                                    <img src="{{ url('storage/'.$student->avatar) }}" alt="avatar">
                                    @else
                                    <img src="{{ ui_avatars_url($student->full_name,26,'none') }}" alt="avatar">
                                    @endif
                                    <div class="about">
                                        <div class="name">{{ $student->full_name }}</div>
                                        @if ($student->is_online)
                                        <div class="status"> <i class="fa fa-circle online"></i> {{
                                            substr($student->chat_last_activity,0 ,-8) }}</div>
                                        @else
                                        <div class="status"> <i class="fa fa-circle offline"></i> {{
                                            substr($student->chat_last_activity,0 ,-8) }}</div>
                                        @endif
                                    </div>
                                    </a>
                                </li>

                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="chat sticky-top">
                            <div class="chat-header clearfix">

                            </div>
                            <div class="chat-history">
                                <ul class="m-b-0">
                                    <li class="clearfix">
                                        <div class="message-data text-right">
                                            <span class="message-data-time">10:10 AM, Today</span>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                        </div>
                                        <div class="message other-message float-right"> Hi Aiden, how are you? How is
                                            the project coming along? </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time">10:12 AM, Today</span>
                                        </div>
                                        <div class="message my-message">Are we meeting today?</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time">10:15 AM, Today</span>
                                        </div>
                                        <div class="message my-message">Project has been already finished and I have
                                            results to show you.</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat-message clearfix">
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-send"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter text here...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            body {
                background-color: #f4f7f6;
                margin-top: 20px;
            }

            .card {
                background: #fff;
                transition: .5s;
                border: 0;
                margin-bottom: 30px;
                border-radius: .55rem;
                position: relative;
                width: 100%;
                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
            }

            .chat-app .people-list {
                width: 280px;
                position: absolute;
                left: 0;
                top: 0;
                padding: 20px;
                z-index: 7
            }

            .chat-app .chat {
                margin-left: 280px;
                border-left: 1px solid #eaeaea
            }

            .people-list {
                -moz-transition: .5s;
                -o-transition: .5s;
                -webkit-transition: .5s;
                transition: .5s
            }

            .people-list .chat-list li {
                padding: 10px 15px;
                list-style: none;
                border-radius: 3px
            }

            .people-list .chat-list li:hover {
                background: #efefef;
                cursor: pointer
            }

            .people-list .chat-list li.active {
                background: #efefef
            }

            .people-list .chat-list li .name {
                font-size: 15px
            }

            .people-list .chat-list img {
                width: 45px;
                border-radius: 50%
            }

            .people-list img {
                float: left;
                border-radius: 50%
            }

            .people-list .about {
                float: left;
                padding-left: 8px
            }

            .people-list .status {
                color: #999;
                font-size: 13px
            }

            .chat .chat-header {
                padding: 15px 20px;
                border-bottom: 2px solid #f4f7f6
            }

            .chat .chat-header img {
                float: left;
                border-radius: 40px;
                width: 40px
            }

            .chat .chat-header .chat-about {
                float: left;
                padding-left: 10px
            }

            .chat .chat-history {
                padding: 20px;
                border-bottom: 2px solid #fff
            }

            .chat .chat-history ul {
                padding: 0
            }

            .chat .chat-history ul li {
                list-style: none;
                margin-bottom: 30px
            }

            .chat .chat-history ul li:last-child {
                margin-bottom: 0px
            }

            .chat .chat-history .message-data {
                margin-bottom: 15px
            }

            .chat .chat-history .message-data img {
                border-radius: 40px;
                width: 40px
            }

            .chat .chat-history .message-data-time {
                color: #434651;
                padding-left: 6px
            }

            .chat .chat-history .message {
                color: #444;
                padding: 18px 20px;
                line-height: 26px;
                font-size: 16px;
                border-radius: 7px;
                display: inline-block;
                position: relative
            }

            .chat .chat-history .message:after {
                bottom: 100%;
                left: 7%;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
                border-bottom-color: #fff;
                border-width: 10px;
                margin-left: -10px
            }

            .chat .chat-history .my-message {
                background: #efefef
            }

            .chat .chat-history .my-message:after {
                bottom: 100%;
                left: 30px;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
                border-bottom-color: #efefef;
                border-width: 10px;
                margin-left: -10px
            }

            .chat .chat-history .other-message {
                background: #e8f1f3;
                text-align: right
            }

            .chat .chat-history .other-message:after {
                border-bottom-color: #e8f1f3;
                left: 93%
            }

            .chat .chat-message {
                padding: 20px
            }

            .online,
            .offline,
            .me {
                margin-right: 2px;
                font-size: 8px;
                vertical-align: middle
            }

            .online {
                color: #86c541
            }

            .offline {
                color: #e47297
            }

            .me {
                color: #1d8ecd
            }

            .float-right {
                float: right
            }

            .clearfix:after {
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0
            }

            @media only screen and (max-width: 767px) {
                .chat-app .people-list {
                    height: 465px;
                    width: 100%;
                    overflow-x: auto;
                    background: #fff;
                    left: -400px;
                    display: none
                }

                .chat-app .people-list.open {
                    left: 0
                }

                .chat-app .chat {
                    margin: 0
                }

                .chat-app .chat .chat-header {
                    border-radius: 0.55rem 0.55rem 0 0
                }

                .chat-app .chat-history {
                    height: 300px;
                    overflow-x: auto
                }
            }

            @media only screen and (min-width: 768px) and (max-width: 992px) {
                .chat-app .chat-list {
                    height: 650px;
                    overflow-x: auto
                }

                .chat-app .chat-history {
                    height: 600px;
                    overflow-x: auto
                }
            }

            @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
                .chat-app .chat-list {
                    height: 480px;
                    overflow-x: auto
                }

                .chat-app .chat-history {
                    height: calc(100vh - 350px);
                    overflow-x: auto
                }
            }
        </style>
    </div>
    @endif


</div>
