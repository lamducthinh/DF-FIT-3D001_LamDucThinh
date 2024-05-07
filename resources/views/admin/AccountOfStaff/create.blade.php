@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h2>Thêm tài khoản nhân viên:</h2>
                <form method="POST" action="{{route('admin.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Họ và tên:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                      <label for="tel">Số điện thoại:</label>
                      <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px">
                      <label for="role">Chức vụ:</label>
                      <select class="form-control" id="role" name="role">
                          <option value="1">Admin</option>
                          <option value="0">User</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


@endsection
<script>
  document.getElementById('role').addEventListener('change', function() {
      var roleSelect = document.getElementById('role');
      var roleValue = roleSelect.options[roleSelect.selectedIndex].value;
      var roleInput = document.getElementById('role_input');
      
      if (roleValue === '1') {
          roleInput.value = 'admin';
      } else if (roleValue === '0') {
          roleInput.value = 'người dùng';
      }
  });
</script>