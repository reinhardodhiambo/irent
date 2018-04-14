<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="true" >
                        <img src="{{ auth()->user()->avatar }}" alt="">{{ auth()->user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out pull-right"></i> {{ __('views.backend.section.header.menu_0') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">{{count(\App\Notification::get_notifications())}}</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach(\App\Notification::get_notifications() as $notification)
                        <li>
                            <a>
                                {{--<span class="image"><img src="images/img.jpg" alt="Profile Image"></span>--}}
                                <span>
                          <span>{{$notification->user_name}}</span>
                          {{--<span class="time">{{$notification->update_at}}</span>--}}
                        </span>
                                <span class="message">
                          {{$notification->message}}
                        </span>
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <div class="text-center">
                                <a href="{{ route('admin.notifications') }}">
                                    <strong>See All Notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>