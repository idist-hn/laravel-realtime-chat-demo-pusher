@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Room</div>

                    <div class="panel-body">
                        <form action="{{ route('add_room_post') }}" class="" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nhập tên phòng..." class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Thêm phòng">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
