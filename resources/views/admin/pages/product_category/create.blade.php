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
                  <h3 class="card-title">Product Category Create</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{-- {{ $errors ?? dd($errors->all()) }} --}}
                <form role="form" method="POST" action="{{ route('admin.product_category.store') }}">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Chức vụ: </label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        @error('name')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                      
                    </div>
                    <div class="form-group">
                      <label for="slug">Slug</label>
                      <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter slug">
                        @error('slug')
                          <span style="color: red">{{ $message }}</span>
                        @enderror
                      
                    </div>
                  </div>
                  <!-- /.card-body -->
                  @csrf
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
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
      $('#name').on('keyup', function(){
        var nameValue = $(this).val();
        // console.log(name);
        $.ajax({
          method: 'POST',//method
          url: '{{route('admin.product_category.slug')}}', //action
          data:{
            name: nameValue,
            _token: '{{ csrf_token() }}'
          },
          success:function(response){
            console.log(response);
            $('#slug').val(response.slug);
          }
        })
      });
    });
  </script>
@endsection