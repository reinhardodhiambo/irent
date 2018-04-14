@extends('admin.layouts.admin')

@section('content')

    <div class="chat_container align-left">
        <div class="chat">
            <div class="chat-header clearfix">

                <div class="chat-about">
                    <div class="chat-with">Apartment: {{$apartment_name}}</div>
                    <div class="chat-num-messages">already {{count($chats)}} messages</div>
                </div>
                <i class="fa fa-comment-o"></i>
            </div> <!-- end chat-header -->

            <div class="chat-history">
                <ul>
                    @foreach($chats as $chat)
                        @if($chat->user_id==auth()->user()->id)
                            <li class="clearfix">
                                <div class="message-data align-right">
                                    <span class="message-data-time" >{{$chat->created_at}}</span> &nbsp; &nbsp;
                                    <span class="message-data-name" >{{$chat->user_name}}</span> <i class="fa fa-circle me"></i>

                                </div>
                                <div class="message other-message float-right">
                                   {{$chat->message}}
                                </div>
                            </li>
                            @else
                            <li>
                                <div class="message-data">
                                    <span class="message-data-name"><i class="fa fa-circle online"></i>{{$chat->user_name}}</span>
                                    <span class="message-data-time">{{$chat->created_at}}</span>
                                </div>
                                <div class="message my-message">
                                    {{$chat->message}}
                                </div>
                            </li>
                            @endif
                    @endforeach
                    <li>
                        <i class="fa fa-circle online"></i>
                        <i class="fa fa-circle online" style="color: #AED2A6"></i>
                        <i class="fa fa-circle online" style="color:#DAE9DA"></i>
                    </li>

                </ul>

            </div> <!-- end chat-history -->

            <div class="chat-message clearfix">
                {{ Form::open(['url' => 'admin/chat/'.$apartment_id.'/new','method'=>'post']) }}
                <textarea name="message" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>

                <button type="submit">Send</button>
                {{ Form::close() }}

            </div> <!-- end chat-message -->

        </div> <!-- end chat -->

    </div> <!-- end container -->

    <script id="message-template" type="text/x-handlebars-template">
        <li class="clearfix">
            <div class="message-data align-right">
                <span class="message-data-time" >{{}}, Today</span> &nbsp; &nbsp;
                <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
            </div>
            <div class="message other-message float-right">

            </div>
        </li>
    </script>

    <script id="message-response-template" type="text/x-handlebars-template">
        <li>
            <div class="message-data">
                <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                <span class="message-data-time">, Today</span>
            </div>
            <div class="message my-message">

            </div>
        </li>
    </script>

@endsection