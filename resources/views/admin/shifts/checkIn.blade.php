@extends('admin.layout.master')

@section('content')
    <h1 style="margin-left:20px">Danh sách check-in</h1>

    <!-- Search form -->
    <div class="container" style="margin-bottom: 20px;">
        <form action="{{ route('users.checkin') }}" method="GET">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="name" placeholder="Tìm kiếm theo tên nhân viên">
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                      <select name="sort" class="form-control" id="sortBy">
                        <option value="">--- Chọn thuộc tính ---</option>
                        <option {{ request()->get('sort') === 'latest' ? 'selected' : '' }} value="latest">Trễ nhất</option>
                        <option {{ request()->get('sort') === 'oldest' ? 'selected' : '' }} value="oldest">Sớm nhất</option>
                      </select>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Check-in Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkIns as $checkIn)
                    <tr>
                        <td>{{ $checkIn->id }}</td>
                        <td>{{ $checkIn->user->name }}</td>
                        <td>{{ $checkIn->check_in_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
