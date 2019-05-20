@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow: hidden;">
                        Chatroom
                        <a href="{{ route('add_room_get') }}" class="btn btn-success pull-right">
                            Add
                        </a>
                    </div>
                    <div class="panel-body row">
                        @foreach($listRoom as $room)
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <div class="chat-room">
                                    <a href="{{ route('chat_room',['id'=>$room->id]) }}">
                                        <img src="{{ asset('images/room_chat.png') }}" alt="" class="room_thumbnail">
                                        {{ $room->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection