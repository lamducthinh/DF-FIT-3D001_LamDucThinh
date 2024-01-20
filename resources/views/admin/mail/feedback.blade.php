@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<p>Đã nhận được ý kiến mới từ nhân viên: {{ Auth::user()->name }}</p>
<p>{{ $feedback }}</p>
