@extends('admin.pages.header')
@section('content')
     <!-- DataTales Example -->
     <div class="card shadow mb-4" style="max-width: 5550px" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin nhân viên:</h6>
        </div>
        <div class="card-body" style="max-width: 5550px">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width: 1250px" cellspacing="0">
                    <thead>
                        <tr style="text-align: center">
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          {{-- <th>UserType</th> --}}
                          <th>Created_at</th>
                          <th>Updated_at</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody> 
                        @foreach ($users as $row)                       
                          <tr style="text-align: center">
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>0{{$row->phone}}</td>
                            {{-- <td>{{ isset($_GET[$row->role]) ? 'Admin' : 'Client' }}</td> --}}

                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>
                              <a class="btn btn-success" href="{{ route('admin.create.detail', ['id' => $row->id]) }}">Detail</a>
                            </td>
                            <td>
                              <form action="{{ route('admin.user.destroy', ['id' => $row->id]) }}" method="post">
                                @csrf
                                <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-danger">Delete</button>
                              </form>
                            </td>
                            {{-- <td>
                              <a class="btn btn-primary" href="{{ route('admin.product_category.detail', ['id' => $productCategory->id]) }}">Detail</a>
                              <form action="{{ route('admin.product_category.destroy', ['id' => $productCategory->id]) }}" method="post">
                                  @csrf
                                  <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-danger">Delete</button>
                              </form>
                              @if($productCategory->trashed())
                              <form action="{{ route('admin.product_category.restore', ['id' => $productCategory->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                              </form>
                              <form action="{{ route('admin.product_category.force.delete', ['id' => $productCategory->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">Force Delete</button>
                              </form>    
                              @endif
                            </td> --}}
                          </tr>
                        @endforeach
                     
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