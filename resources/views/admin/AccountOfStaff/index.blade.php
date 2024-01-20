@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
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
                      <th>Password</th>
                      <th>Created_at</th>
                      <th>Role</th>
                      <th>Action</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- {{ csrf_field() }} --}}

                    @foreach ($users as $user)
                    {{-- @if($user->role != 1) --}}
                      <tr style="text-align: center">
                        {{-- {{dd($user)}} --}}
                        {{-- <td>{{ ($page - 1) * $itemPerPage + $index + 1 }}</td> --}}
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>0{{$user->phone}}</td>
                        <td>**************</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{($user->role == 1) ? "Admin" : (($user->role == 0) ? "User" : "Leader")}}</td>
                        <td>
                          <a class="btn btn-success" href="{{ route('admin.create.detail', ['id' => $user->id]) }}">Detail</a>
                        </td>
                        <td>
                          <form action="{{ route('admin.user.destroy', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                        
                      </tr>
                      
                      
                      {{-- @endif --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
@endsection
