@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Chỉnh sửa thông tin nhân viên</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                  @method('PATCH')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Họ và tên:</label>
                      <input value="{{ old('name') ?? $product->name }}" type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        @error('name')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                      
                    </div>
                    <div class="form-group">
                      <label for="price">Lương:</label>
                      <input value="{{ old('price') ?? $product->price }}" type="number" name="price" class="form-control" id="price" placeholder="Enter price">
                        @error('price')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="short_description">Giới thiệu ngắn:</label>
                      <textarea id="short_description" class="form-control" name="short_description">{{ old('short_description') ?? $product->short_description }}</textarea>
                        @error('short_description')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="description">Tổng quan:</label>
                      <textarea id="description" class="form-control" name="description">{{ old('description') ?? $product->description }}</textarea>
                        @error('description')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                      <label for="image_url">Hình ảnh:</label>
                      <input type="file" name="image_url" class="form-control" id="image_url">
                        @error('image_url')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" name="status" id="status">
                          <option value="">---Please Select---</option>
                          <option {{ old('status') ?? $product->status == '0' ? 'selected' : '' }} value="0">Show</option>
                          <option {{ old('status') ?? $product->status == '1' ? 'selected' : '' }} value="1">Hide</option>
                      </select>
                        @error('status')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="product_category_id">Chức vụ:</label>
                      <select class="form-control" name="product_category_id" id="product_category_id">
                          <option value="">---Hãy chọn chức vụ---</option>
                          @foreach ($productCategories as $productCategory)
                            <option {{ old('product_category_id') ?? $product->product_category_id == $productCategory->id ? 'selected' : '' }} value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>  
                          @endforeach
                      </select>
                        @error('product_category_id')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
                  @csrf
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
</div>
@endsection

@section('js-custom')
  <script type="text/javascript">
    $(document).ready(function(){
      ClassicEditor
        .create( document.querySelector( '#description' ), {
          ckfinder: {
              uploadUrl: '{{route('admin.product.image.upload').'?_token='.csrf_token()}}',
          }
        } )
        .catch( error => {
            console.error( error );
        } );

      ClassicEditor
        .create( document.querySelector( '#short_description' ), {
          ckfinder: {
              uploadUrl: '{{route('admin.product.image.upload').'?_token='.csrf_token()}}',
          }
        } )
        .catch( error => {
            console.error( error );
        } );
    });
  </script>
@endsection