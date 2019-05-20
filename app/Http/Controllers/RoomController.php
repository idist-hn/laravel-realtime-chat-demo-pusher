<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $listRoom = Room::get();
        return view('room', ['listRoom' => $listRoom]);
    }

    public function addRoom()
    {
        return view('addRoom');
    }

    public function addRoomPost(Request $request)
    {
        $name = $request->name;
        DB::table('rooms')->insert(
            [
                'name' => $name,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]
        );
        return redirect(route('room'));
    }
}
