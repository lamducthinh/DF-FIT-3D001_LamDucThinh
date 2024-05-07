@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h2>Chỉnh sửa tài khoản:</h2>
            </div>
            <form method="POST" action="{{route('admin.create.update',['id'=>$users->id])}}">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input value="{{$users->name}}" type="text" class="form-control" id="name" name="name">
              </div>

              <div class="form-group">
                <label for="email">Email:</label>
                <input value="{{$users->email}}" type="email" class="form-control" id="email" name="email">
              </div>

              <div class="form-group">
                <label for="tel">Số điện thoại:</label>
                <input value="{{$users->phone}}" type="tel" class="form-control" id="phone" name="phone">
              </div>

              <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input value="{{$users->password}}" type="password" class="form-control" id="password" name="password">
              </div>

              <div class="form-group" style="margin-bottom: 15px">
                <label for="role">Quyền:</label>
                <select class="form-control" id="role" name="role" >
                    <option value="1" {{ ($users->role === 1) ? 'selected' : '' }}>Admin</option>
                    <option value="0" {{ ($users->role === 0) ? 'selected' : '' }}>User</option>
                </select>
            </div>

              <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Lấy giá trị của ô Họ và tên
    var nameInput = document.getElementById('name').value;

    // Đặt sự kiện khi trang được tải
    window.onload = function() {
      // Gán giá trị của ô Họ và tên vào ô Email, Số điện thoại và Mật khẩu
      document.getElementById('email').value = '';
      document.getElementById('phone').value = '';
      document.getElementById('password').value = '';
      document.getElementById('role').value = '';
    };
  });
</script>

@endsection
