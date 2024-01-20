@extends('admin.layout.master')

@section('content')

    <h2>Thêm tài khoản nhân viên:</h2>
    <form method="POST" action="{{route('admin.store')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
          <label for="tel">Phone number:</label>
          <input type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group" style="margin-bottom: 15px">
          <label for="cars">Role:</label>
          <input type="text" class="form-control" id="role" name="role">
      </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      </div>
    </form>

@endsection
