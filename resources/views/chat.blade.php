@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Chatroom: {!! $room->name !!}
                        <span id="room_id" style="display: none">{{ $room->id }}</span>
                        <span class="badge pull-right">@{{ usersInRoom.length }}</span>
                    </div>

                    <chat-log :messages="messages" v-on="{ messagedeleted: removeMessage, loadingmore: loadingMore} "></chat-log>
                    <chat-composer v-on:messagesent="addMessage"></chat-composer>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher("f5f8045ab09bc508496e", {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('room_{{ $room->id }}');
        channel.bind('my-event', function (data) {
            alert(data.message);
        });
    </script>
    @endsection
