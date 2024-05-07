{{-- @extends('admin.layout.master')

@section('content')
    <div class="container">
        <h1>Check-in</h1>
        
        @if(Session::has('success_message'))
            <div id="successMessage" class="alert alert-success">
                {{ Session::get('success_message') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('checkin') }}">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Check-in</button>
            </div>
        </form>
    </div>
@endsection --}}
