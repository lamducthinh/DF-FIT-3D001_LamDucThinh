@extends('admin.layout.master')

@section('content')
    <div class="container">
        <h1>Tạo Mới Lịch Làm Việc</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shifts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">Nhân Viên:</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">Chọn nhân viên</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
              

            <div class="form-group">
                <label for="shift_id">Ca Làm Việc:</label>
                <select name="shift_id" id="shift_id" class="form-control">
                    <option value="">Lựa chọn ca làm việc</option>

                    @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}" data-start-time="{{ $shift->start_time }}" data-end-time="{{ $shift->end_time }}">{{ $shift->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Ngày:</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="start_time">Thời Gian Bắt Đầu:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required disabled>
            </div>

            <div class="form-group">
                <label for="end_time">Thời Gian Kết Thúc:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required disabled>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Mới</button>
            <a href="{{ route('shifts.index') }}" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>

    <script>
        // Thêm sự kiện change cho trường ca làm việc
        document.getElementById('shift_id').addEventListener('change', function () {
            // Lấy thời gian bắt đầu và kết thúc từ thuộc tính data của option được chọn
            var selectedOption = this.options[this.selectedIndex];
            var startTime = selectedOption.getAttribute('data-start-time');
            var endTime = selectedOption.getAttribute('data-end-time');

            // Đặt giá trị của trường thời gian bắt đầu và kết thúc
            document.getElementById('start_time').value = startTime;
            document.getElementById('end_time').value = endTime;
        });
    </script>

    
    {{-- @section('js-custom')
    <script>
        $('#search').on('input', function () {
            var searchTerm = $(this).val();

            if (searchTerm.length >= 30) { // Chỉ gửi yêu cầu tìm kiếm khi có ít nhất 3 ký tự
                $.ajax({
                    method: 'GET',
                    url: '{{ route('users.search') }}',
                    data: {
                        search: searchTerm
                    },
                    success: function(response) {
                        var searchResults = $('#searchResults');
                        searchResults.empty(); 

                        
                        if (response.length > 0) {
                            response.forEach(function(user) {
                                searchResults.append('<div>' + user.name + '</div>');
                            });
                        } else {
                            searchResults.append('<div>Không tìm thấy kết quả.</div>');
                        }
                    }
                });
            } else {
                $('#searchResults').empty(); // Xóa kết quả nếu ô tìm kiếm trống
            }
        });
    </script>
    @endsection --}}

@endsection
