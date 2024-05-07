@extends('admin.layout.master')

@section('content')
<style>
     .container {
        display: flex;
        justify-content: flex-end;
    }

    .form-group {
        margin-bottom: 0;
    }

    .btn {
        margin-left: 10px;

    }

    .btn-primary {
        background-color: #007bff; /* Màu nền của nút */
        border: none; /* Loại bỏ viền */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Màu nền của nút khi di chuột qua */
    }
</style>
    <h1 style="margin-left:20px">Danh sách lịch làm việc</h1>

    <form action="{{ route('shifts.index') }}" method="GET" class="mb-3" style="padding: 30px">
        @if(Auth::user()->isAdmin())
        <a href="{{ route('shifts.create') }}" class="btn btn-primary mb-3">Thêm Lịch Làm Việc</a>
        @endif
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Tìm kiếm..." name="search" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm Kiếm</button>
        </div>
        <div class="input-group" style="margin-top:8px">
            <th>
                Sắp xếp lịch:
                <a href="{{ route('shifts.index', ['sort' => 'user_id', 'order' => 'asc']) }} "style="margin-right: 10px; margin-left:10px">Latest ↑</a>
                <a href="{{ route('shifts.index', ['sort' => 'user_id', 'order' => 'desc']) }}">Oldest ↓</a>
            </th>
        </div>
    </form>
    @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên nhân viên</th>
                <th>Ca Làm Việc</th>
                <th>Ngày</th>
                <th>Thời Gian Bắt Đầu</th>
                <th>Thời Gian Kết Thúc</th>
                @if(Auth::user()->isAdmin())
                <th>Thao Tác</th>
                <th>Thao tác</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $index => $schedule)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $schedule->user->name }}</td>
                    <td>{{ $schedule->shift->name }}</td>
                    <td>{{$schedule->date}}</td>
                    <td>{{ $schedule->shift->start_time }}</td>
                    <td>{{ $schedule->shift->end_time }}</td>
                    @if(Auth::user()->isAdmin())
                        <td>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('shifts.destroy', ['id' => $schedule->id]) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                            </form>
                        
                        </td>
                        <td>
                            
                            @if($schedule->trashed())
                                <form action="{{ route('shifts.schedule.restore', ['id' => $schedule->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                                </form>
                                <form action="{{ route('shifts.schedule.force.delete', ['id' => $schedule->id]) }}" method="post" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn không?')">Xóa vĩnh viễn</button>
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
    <div class="card-footer clearfix">
        
        {{ $schedules->links() }}
      </div>

    
      <div class="container">
        @if(!Auth::user()->isAdmin())
            <form method="POST" action="{{ route('checkin') }}">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Check-in</button>
                </div>
            </form>
            <form method="POST" action="{{ route('checkout') }}">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Check-out</button>
                </div>
            </form>
        @endif
    </div>
    
    
@endsection
@section('js-custom')
  <script>
    // $(document).ready(function(){
    //   let table = new DataTable('#table-product-category');
    // });
  </script>
@endsection
