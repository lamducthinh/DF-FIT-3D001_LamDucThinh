@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        @if (session('msg'))
          <div class="alert alert-success" role="alert">
            {{ session('msg') }}
          </div>
        @endif

        <div class="row mb-2">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách chức vụ</h3>
                <br>
                <form action="{{ route('admin.product_category') }}" method="GET">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="slug">Keyword</label>
                        <input value="{{ request()->get('keyword') }}" type="text" name="keyword" class="form-control" id="slug" placeholder="Enter keyword">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="sortBy">Sort</label>
                        <select name="sort" class="form-control" id="sortBy">
                          <option value="">--- Please Select ---</option>
                          <option {{ request()->get('sort') === 'latest' ? 'selected' : '' }} value="latest">Latest</option>
                          <option {{ request()->get('sort') === 'oldest' ? 'selected' : '' }} value="oldest">Oldest</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                    @if(Auth::user()->isAdmin())
                    <button class="btn btn-primary"> <a href="{{route('admin.product_category.create')}}" style="color: whitesmoke">Thêm chức vụ</a></button>
                    @endif
                  </div>
                  
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- {{ dd($productCategories) }} --}}
                <table class="table table-bordered" id="table-product-category">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Slug</th>
                      @if(Auth::user()->isAdmin())
                      <th>Created At</th>
                      
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($productCategories as $index => $productCategogy)
                      <tr>
                        {{-- <td>{{ ($page - 1) * $itemPerPage + $index + 1 }}</td> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $productCategogy->name}}</td>
                        <td>{{ $productCategogy->slug }}</td>
                        @if(Auth::user()->isAdmin())
                        <td>{{ $productCategogy->created_at }}</td>
                        
                        <td>
                          
                          <a class="btn btn-sm btn-primary" href="{{ route('admin.product_category.detail', ['id' => $productCategogy->id]) }}">Detail</a>
                          <form action="{{ route('admin.product_category.destroy', ['id' => $productCategogy->id]) }}" method="post">
                              @csrf
                              <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-sm btn-danger">Delete</button>
                          </form>

                          @if($productCategogy->trashed())
                          <form action="{{ route('admin.product_category.restore', ['id' => $productCategogy->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                          </form>
                          <form action="{{ route('admin.product_category.force.delete', ['id' => $productCategogy->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">Force Delete</button>
                          </form>    
                          @endif
                        
                        </td>
                        @endif
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4">No data</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{-- <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item" ><a class="page-link" href="#">&laquo;</a></li> --}}
                    {{-- @for ($i = 1; $i <= $totalPage; $i++)
                      <li class="page-item"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>  
                    @endfor --}}
                  {{-- <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul> --}}
                {{ $productCategories->links() }}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('js-custom')
  <script>
    // $(document).ready(function(){
    //   let table = new DataTable('#table-product-category');
    // });
  </script>
@endsection