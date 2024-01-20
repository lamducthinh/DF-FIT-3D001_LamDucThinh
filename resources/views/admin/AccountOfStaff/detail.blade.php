@extends('admin.layout.master')

@section('content')

    <h2>Register</h2>
    <form method="POST" action="{{route('admin.create.update',['id'=>$users->id])}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input value="{{$users->name}}" type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input value="{{$users->email}}" type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
          <label for="tel">Phone number:</label>
          <input value="{{$users->phone}}" type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input value="{{$users->password}}" type="password" class="form-control" id="password" name="password" readonly>
        </div>
        <div class="form-group" style="margin-bottom: 15px">
            <label for="cars">Role:</label>
            <input value="{{$users->role}}" type="text" class="form-control" id="role" name="role">
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Update</button>
        </div>
        
      </div>
    </form>
  
@endsection
