@extends('admin.layout.master')

@section('content')
<h2 style="margin-left: 20px">Đây là trang đề bạn nói lên yêu cầu của mình:</h2>

<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif  
    <div class="row justify-content-center" >
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Nêu ý kiến của bạn</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('submit-feedback') }}">
                        @csrf
                        <div class="form-group">
                            <label for="feedback">Ý kiến của bạn:</label>
                            <textarea class="form-control" name="feedback" id="feedback" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Gửi ý kiến</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm GIF vào góc dưới bên phải -->
    
</div>
@endsection
