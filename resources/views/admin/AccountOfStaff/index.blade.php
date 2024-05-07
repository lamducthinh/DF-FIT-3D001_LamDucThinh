@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">


  <div class="container-fluid" >
    <div class="row">
      <div class="col-md-12">
        <div class="card" >
          
          <form action="{{ route('admin.index.accout') }}" method="GET" style="margin-top: 10px;margin-left: 20px">
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ $search }}">
              </div>
              
              <div class="col-md-3">
                <select name="sortDirection" class="form-control" >
                  <option value="asc" @if($sortDirection == 'asc') selected @endif>Cũ nhất</option>
                  <option value="desc" @if($sortDirection == 'desc') selected @endif>Mới nhất</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Tìm kiếm</button>
              <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary"><a style="color: white" href="{{route('admin.createAcc')}}">Thêm tài khoản nhân viên</a></button>
              </div>
            </div>
          </form>
          <div class="card-body" >
            <table class="table table-bordered" id="table-product-category" style="border: 1px solid white" >
              <thead>
                <tr style="text-align: center">
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Created_at</th>
                  <th>Role</th>
                  <th>Action</th>
                  <th>Action</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- {{ csrf_field() }} --}}

                @foreach ($users as $user)
                  <tr style="text-align: center; text-decoration: {{ $user->trashed() ? 'line-through' : 'none' }}">
                    {{-- {{dd($user)}} --}}
                    {{-- <td>{{ ($page - 1) * $itemPerPage + $index + 1 }}</td> --}}
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>0{{$user->phone}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{($user->role == 1) ? "Admin" : (($user->role == 0) ? "User" : "Leader")}}</td>
                    <td>
                      <a class="btn btn-success" href="{{ route('admin.create.detail', ['id' => $user->id]) }}">Detail</a>
                    </td>
                    <td>
                      <form action="{{ route('admin.user.destroy', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @if($user->id !== auth()->id())
                          <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-danger">Delete</button>
                        @endif
                      </form>
                    </td>
                    <td>
                      @if($user->trashed())
                        <form action="{{ route('admin.createAcc.restore', ['id' => $user->id]) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.createAcc.force-delete', ['id' => $user->id]) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-warning">Xóa vĩnh viễn</button>
                        </form>
                      @else
                        <p>Hiện không có thao tác</p>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          </div>
        </div>
    </div>
  </div></div>
@endsection
