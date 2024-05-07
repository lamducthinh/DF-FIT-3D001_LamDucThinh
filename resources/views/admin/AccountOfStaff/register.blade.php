@extends('admin.pages.header')
@section('content')
     <!-- DataTales Example -->
     {{-- <div class="card shadow mb-4" style="max-width: 5550px" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin nhân viên:</h6>
        </div>
        <div class="card-body" style="max-width: 5550px">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width: 1250px" cellspacing="0">
                    <thead> --}}
                        {{-- <tr style="text-align: center">
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th> --}}
                          {{-- <th>UserType</th> --}}
                          {{-- <th>Created_at</th>
                          <th>Updated_at</th> --}}
                          {{-- <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th> --}}
                        {{-- </tr>
                      </thead>
                      <tbody>  --}}
                        {{-- @foreach ($users as $row)                        --}}
                          {{-- <tr style="text-align: center">
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>0{{$row->phone}}</td>
                            <td> @if($row->role == 1)
                                      Admin
                                  @else
                                      Client
                                  @endif
                            </td> --}}

                            {{-- <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td> --}}
                            {{-- @if(Auth::user()->isAdmin())
                            
                            <td>
                              <a class="btn btn-success" href="{{ route('admin.create.detail', ['id' => $row->id]) }}">Detail</a>
                            </td>
                            <td>
                              <form action="{{ route('admin.user.destroy', ['id' => $row->id]) }}" method="post">
                                @csrf
                                <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-danger">Delete</button>
                              </form>
                            </td>
                            <td>
                              
                              @if($row->trashed())
                              <form action="{{ route('admin.user.restore', ['id' => $row->id]) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                              </form>
                              <form action="{{ route('admin.user.force-delete', ['id' => $row->id]) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-warning">Xóa vĩnh viễn</button>
                              </form>
                              @else
                                  <p>Hiện không có thao tác</p>
                              @endif
                            </td>
                          @endif
                          </tr>
                        @endforeach
                      --}}
                          {{-- <tr>
                            <td>
                              No data
                            </td>
                          </tr> --}}
         
                       
                      </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection