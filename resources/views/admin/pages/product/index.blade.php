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
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Thông tin nhân viên</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bảng nhân viên</h3>
                                <form action="{{ route('admin.product.index') }}" method="GET">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="slug">Từ khóa bạn muốn tìm kiếm:</label>
                                          <input value="{{ request()->get('keyword') }}" type="text" name="keyword" class="form-control" id="slug" placeholder="Enter keyword">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="sortBy">Sắp xếp</label>
                                          <select name="sort" class="form-control" id="sortBy">
                                            <option value="">--- Chọn thuộc tính ---</option>
                                            <option {{ request()->get('sort') === 'latest' ? 'selected' : '' }} value="latest">Trễ nhất</option>
                                            <option {{ request()->get('sort') === 'oldest' ? 'selected' : '' }} value="oldest">Sớm nhất</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    
                  
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Search</button>
                                      @if(Auth::user()->isAdmin())
                                      <button class="btn btn-primary"> <a href="{{route('admin.product.create')}}" style="color: whitesmoke">Thêm thông tin nhân viên </a></button>
                                      @endif
                                    </div>
                                    
                                  </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-product">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>#</th>
                                                <th>Tên</th>
                                                <th>Chức vụ</th>
                                                @if(Auth::user()->isAdmin())
                                                <th>Lương</th>
                                                <th>Created At</th>
                                                @endif
                                                
                                                <th>Hình ảnh</th>
                                                @if(Auth::user()->isAdmin())
                                               

                                                <th>Thao tác</th>
                                                <th>Thao tác</th>

                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $index => $product)
                                                <tr style="text-align: center;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ !is_null($product->productCategory) ? $product->productCategory->name : "" }}</td>
                                                    @if(Auth::user()->isAdmin())
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->created_at }}</td>
                                                    @endif
                                                    
                                                    <td><img class="product__details__pic__item--large"
                                                            src="{{ asset('images').'/'.$product->image_url }}" alt=""
                                                            style="width:80px"></td>
                                                    @if(Auth::user()->isAdmin())
                                                 
                                                    

                                                    <td style="width:350px">
                                                      <div class="btn-group" role="group">
                                                          <a class="btn btn-sm btn-primary"
                                                              href="{{ route('admin.product.edit', ['product' => $product->id]) }}">
                                                              Detail
                                                          </a>
                                                          <a class="btn btn-sm btn-success" href="{{route('user.profile',['id' => $product->id])}}">
                                                              Thông tin đầy đủ
                                                          </a>
                                                          <form action="{{ route('admin.product.destroy', ['product' => $product->id]) }}" method="post">
                                                              @csrf
                                                              @method('delete')
                                                              <button onclick="return confirm('Are you sure ?');" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                          </form>
                                                          <td style="display: flex">

                                                          @if($product->trashed())
                                                              <form action="{{ route('admin.product.restore', ['id' => $product->id]) }}" method="POST">
                                                                  @csrf
                                                                  <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                                                              </form>
                                                              <form action="{{ route('admin.product.force.delete', ['id' => $product->id]) }}" method="POST">
                                                                  @csrf
                                                                  <button type="submit" class="btn btn-sm btn-warning">Xóa vĩnh viễn</button>
                                                              </form>
                                                            @else
                                                            <p>Hiện không có thao tác</p>
                                                          @endif
                                                          </td>
                                                      </div>
                                                  </td>    
                                                  @endif 
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">No data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{-- Pagination or other footer content --}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!---->

@endsection

@section('js-custom')
    <script>
        $(document).ready(function() {
            let table = new DataTable('#table-product');
        });
    </script>
@endsection
