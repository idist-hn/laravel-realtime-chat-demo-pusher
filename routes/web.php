<?php

use App\Events\MessagePosted;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
})->name("test")->middleware('auth');

Route::get('/messages/{room_id}', function ($room_id) {

    $count= App\Message::with('user')->where('room_id',$room_id)->count();

    return App\Message::with('user')
        ->where('room_id',$room_id)
        ->limit(10)
        ->offset($count -10)
        ->get();
})->name("messages")->middleware('auth');

Route::get('/messages-more/{room_id}/{page}', function ($room_id,$page) {

    $count= App\Message::with('user')->where('room_id',$room_id)->count();

    return App\Message::with('user')
        ->where('room_id',$room_id)
        ->limit(10*$page)
        ->offset($count -10*$page)
        ->get();
})->name("messages-more")->middleware('auth');

Route::post('/messages', function () {
    // Store the new message
    $user = Auth::user();
    $message = $user->messages()->create([
        'message' => request()->get('message'),
        'room_id' => request()->get('room_id')
    ]);
    $room = $message->room()->where('id',request()->get('room_id'))->first();

    // Announce that a new message has been posted
    broadcast(new MessagePosted($message, $user, $room))->toOthers();

    return ['status' => 'OK'];
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/room','RoomController@getIndex')->name('room');
Route::get('/room/add', 'RoomController@addRoom')->name('add_room_get');
Route::post('/room/add', 'RoomController@addRoomPost')->name('add_room_post');
Route::get('/room/chat/{id}','ChatController@getIndex')->name('chat_room');
Route::get('/message/delete/{room_id}/{id}','ChatController@removeMessage')->name('removeMessage');