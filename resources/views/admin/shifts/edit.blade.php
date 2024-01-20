@extends('admin.layout.master')

@section('content')
    <div class="container">
        <h1>Sửa Lịch Làm Việc</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shifts.update', $schedule->id) }}" method="POST">
            @csrf
            {{-- @method('PUT') --}}

            <div class="form-group">
                <label for="user_id">Nhân Viên:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $schedule->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="shift_id">Ca Làm Việc:</label>
                <select name="shift_id" id="shift_id" class="form-control">
                    @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ $shift->id == $schedule->shift_id ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Ngày:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $schedule->date }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="{{ route('shifts.index') }}" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
@endsection
