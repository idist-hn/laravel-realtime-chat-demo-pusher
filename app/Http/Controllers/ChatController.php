<?php

namespace App\Http\Controllers;

use App\Events\DeleteMessage;
use App\Message;
use App\Room;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex($id)
    {


        $room = DB::table('rooms')->where('id', $id)->first();
        if (!isset($room->id)) {

        };
        return view('chat', ['room' => $room]);
    }

    public function removeMessage($room_id,$id)
    {
        $message = Message::where('id',$id)->delete();
        $room = Room::where('id',$room_id)->first();

        broadcast(new DeleteMessage($room))->toOthers();
        return ['remove message ok'];
    }
}
